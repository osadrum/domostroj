<?php

class GalleryCategoryController extends AdminController
{
    public function actionView($id)

	{
        $model=$this->loadModel($id);

        $criteria = new CDbCriteria();
        $criteria->condition = '_category=:category';
        $criteria->params = array(':category'=>$id);

        $images=new CActiveDataProvider('GalleryImages', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'images' => $images,
		));
	}

	public function actionCreate()
	{
		$model=new GalleryCategory;

		if(isset($_POST['GalleryCategory']))
		{
			$model->attributes=$_POST['GalleryCategory'];

            if ($model->_parent)
            {
                $parent = GalleryCategory::model()->findByPk($model->_parent);
                if ($parent !== null)
                    $model->appendTo($parent);
            }

            if ($model->saveNode())
            {
                Yii::app()->user->setFlash('success', "Альбом «{$model->title}» успешно создан.");
                $this->redirect(array('view','id'=>$model->id));
            }

		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['GalleryCategory']))
		{

			$model->attributes=$_POST['GalleryCategory'];

            if ((int) $model->_parent !== (int) $model->_parent_id)
            {
                if (empty($model->_parent))
                    $result = $model->moveAsRoot();
                else
                {
                    $parent = Category::model()->findByPk($model->_parent);
                    if ($parent !== null)
                        $result = $model->moveAsFirst($parent);
                }
            }

            if ($model->saveNode())
            {
                Yii::app()->user->setFlash('success', "Альбом «{$model->title}» успешно создан.");
                $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->deleteNode();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GalleryCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new GalleryCategory('search');
		$model->unsetAttributes();
		if(isset($_GET['GalleryCategory']))
			$model->attributes=$_GET['GalleryCategory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionImageDelete() {
        $image = GalleryImages::model()->findByPk($_POST['id']);
        if ($image->delete()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function actionImagePublish() {
        $image = GalleryImages::model()->findByPk($_POST['id']);
        $image->is_published = $_POST['publish'];
        if ($image->save()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

	public function loadModel($id)
	{
		$model=GalleryCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

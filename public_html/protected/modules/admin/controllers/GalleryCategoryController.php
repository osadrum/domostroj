<?php

class GalleryCategoryController extends AdminController
{
    public $defaultAction = 'admin';
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new GalleryCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

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

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->deleteNode();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('GalleryCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new GalleryCategory('search');
		$model->unsetAttributes();  // clear any default values
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

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=GalleryCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gallery-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

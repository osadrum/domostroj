<?php

class ProjectController extends AdminController
{
    public function actionView($id)

    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    public function actionImage($id)

    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $images=new CActiveDataProvider('ProjectImage', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

        $this->render('image',array(
            'model'=>$this->loadModel($id),
            'images' => $images,
        ));
    }

    public function actionImageOptionEdit() {
        $image = ProjectImage::model()->findByPk($_POST['id']);

        $image->title = $_POST['title'];
        $image->sort = $_POST['sort'];
        if ($image->save()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function actionLayout($id)

    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $layout=new CActiveDataProvider('Layout', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

        $this->render('layout',array(
            'model'=>$this->loadModel($id),
            'layout' => $layout,
        ));
    }

    public function actionGrade($id)

    {
        $criteria = new CDbCriteria();
        $criteria->condition = '_project=:project';
        $criteria->params = array(':project'=>$id);

        $grade=new CActiveDataProvider('Grade', array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>48,
            ),
        ));

        $this->render('grade',array(
            'model'=>$this->loadModel($id),
            'grade' => $grade,
        ));
    }

	public function actionCreate()
	{
		$model=new Project;
        $image = new ProjectImage();
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
                $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
			'image'=>$image,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['Project']))
		{
			$model->attributes=$_POST['Project'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionProjectImage($project_id)
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder = Yii::getPathOfAlias('webroot').Yii::app()->params['imagePath'];
        $originalFolder = $folder.'original/';

        if (!file_exists($originalFolder))
            mkdir($originalFolder, 0775, true);

        $allowedExtensions = Yii::app()->params['imageTypes'];
        $sizeLimit = Yii::app()->params['sizeLimit'];
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($originalFolder);

        if ($result['success']) {
            $arrName = explode(".", $result['filename']);
            $ext = end($arrName);
            $newName = FileHelper::getRandomFileName($originalFolder, $result['filename']);

            rename($originalFolder.$result['filename'],$originalFolder.$newName.'.'.$ext);

            foreach (Yii::app()->params['imageSizeGallery'] as $path => $size) {
                $resizeImage = Yii::app()->image->load($originalFolder.$newName.'.'.$ext);
                $resizeImage->resize($size[0], $size[1])->quality(Yii::app()->params['imageQuality']);
                if (!file_exists($folder.$path))
                    mkdir($folder.$path, 0775, true);
                $resizeImage->save($folder.$path.'/'.$newName.'.'.$ext);
            }

            $image = new ProjectImage();
            $image->image = $newName.'.'.$ext;
            $image->_project = $project_id;
            $image->is_published = 1;
            if ($image->save()) {
                echo CJSON::encode(array(
                    'success' => true,
                    'filename' => $newName.'.'.$ext
                ));
            }
        }
    }

    public function actionImageDelete() {
        $image = ProjectImage::model()->findByPk($_POST['id']);
        if ($image->delete()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

    public function actionImagePublish() {
        $image = ProjectImage::model()->findByPk($_POST['id']);
        $image->is_published = $_POST['publish'];
        if ($image->save()) {
            echo 'ok';
        } else {
            echo 'no';
        }
    }

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionAdmin()
	{
		$model=new Project('search');
		$model->unsetAttributes();
		if(isset($_GET['Project']))
			$model->attributes=$_GET['Project'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=Project::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='project-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

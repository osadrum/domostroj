<?php

class CatConstructTypeController extends AdminController
{

	public function actionCreate()
	{
		$model=new CatConstructType;

		if(isset($_POST['CatConstructType']))
		{
			$model->attributes=$_POST['CatConstructType'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['CatConstructType']))
		{
			$model->attributes=$_POST['CatConstructType'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionAdmin()
	{
		$model=new CatConstructType('search');
		$model->unsetAttributes();
		if(isset($_GET['CatConstructType']))
			$model->attributes=$_GET['CatConstructType'];
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=CatConstructType::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cat-construct-type-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

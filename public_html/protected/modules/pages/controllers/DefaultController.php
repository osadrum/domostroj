<?php

class DefaultController extends Controller {

	public function actionView($id)
	{
		$page = $this->loadModel($id);

		$this->render('view', array(
			'page' => $page,
		));
	}

	public function loadModel($id)
	{
		$model = Page::model()->published()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'Запрашиваемая страница не существует.');
		return $model;
	}

}
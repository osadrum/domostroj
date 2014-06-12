<?php

class SettingsController extends AdminController
{
    public function actionIndex()
    {
        $settings = new Settings('search');

        $settings->unsetAttributes();  // clear any default values
        if(isset($_GET['Settings'])) {
            $settings->attributes=$_GET['Settings'];
            Yii::app()->user->setState('SettingsSearchParams', $_GET['Settings']);
        } else {
            $searchParams = Yii::app()->user->getState('SettingsSearchParams');

            if (isset($searchParams)) {
                $settings->attributes = $searchParams;
            }
        };

        $this->render('index',array('settings'=>$settings));
    }

    public function actionUpdate($id) {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Settings']))
        {
            $model->attributes=$_POST['Settings'];
            if($model->save()) {
                Yii::app()->cache->set($model->name,$model->value);
                Yii::app()->user->setFlash('success', "Успешно сохранено.");
                $this->redirect(array('/admin/settings'));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    public function loadModel($id)
    {
        $model=Settings::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}
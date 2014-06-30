<?php

class SiteController extends Controller
{
    public $layout='//layouts/main';
    public $pageIcon = "";



	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->layout='//layouts/home';
        $this->showSlider = true;

		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    public function actionAjaxFeedback()
    {
        if(!empty($_POST['Feedback'])){

        }
    }

    public function actionAjaxCallback()
    {
        $error = 0;
        if (isset($_POST['name']) && isset($_POST['phone'])) {

            $message = 'Обратный звонок '.$_POST['name'].' тел:'.$_POST['phone'];

            if (Settings::getCacheValue('callback') == 0) {
                if (!Email::sendMail('admin', 'Заказ обратного звонка', $message)) {
                    $error++;
                }
            } else if (Settings::getCacheValue('callback') == 1) {
                if (!Sms::send('admin', $message)) {
                    $error++;
                }
            } else if (Settings::getCacheValue('callback') == 2) {
                if (!Email::sendMail('admin', 'Заказ обратного звонка', $message)) {
                    $error++;
                }
                if (!Sms::send('admin', $message)) {
                    $error++;
                }
            }
        } else {
            $error++;
        }

        echo CJSON::encode(array(
            'status' => ($error==0)?'ok':'error'
        ));
    }

    public function actionReviewAll()
    {
        $this->layout='//layouts/column2';

        $criteria = new CDbCriteria();
        $criteria->addCondition('is_published=1');
        $review = Review::model()->findAll($criteria);

        $this->render('reviewAll',
            array('review'=>$review));

    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

        $model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Role::getHomePage());
        }
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
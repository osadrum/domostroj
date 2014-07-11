<?php

class ContactsController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
    }
    /**
     * Displays the contact page
     */
    public function actionIndex()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $subject = 'Сообщение из контактной формы - '.$model->subject;
                $message = 'Имя: '.$model->name.
                            '<br>Телефон: '.$model->phone.
                            '<br>Email: '.$model->email.
                            '<br>Тема сообщения: '.$model->subject.
                            '<br>Текст сообщения: '.$model->body;
                if (!Email::sendMail('admin',$subject, $message)) {
                    Yii::app()->user->setFlash('warning','При отправке произошла ошибка');
                } else {
                    Yii::app()->user->setFlash('success','Сообщение успешно отправлено!');
                    LogForms::write(LogForms::TYPE_CONTACT, LogForms::NOTICE_EMAIL,$model->phone, $model->email, $message);
                    if (Settings::getCacheValue('contact-sms') == 1) {
                        if (Sms::send('admin', 'Вам отправлено письмо из контактной формы'))
                            LogForms::write(LogForms::TYPE_CONTACT, LogForms::NOTICE_SMS,$model->phone, $model->email, 'Уведомление об отправке сообщения из контактной формы: '. $message);
                    }
                }
                $this->refresh();
            }
        }
        $this->render('index',array('model'=>$model));
    }

}
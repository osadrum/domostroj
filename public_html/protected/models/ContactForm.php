<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
    public $phone;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email,  subject, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
            array('phone', 'safe'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name'=>'Имя',
            'email'=>'Email',
            'subject'=>'Тема сообщения',
            'body'=>'Текст сообщения',
            'phone'=>'Телефон',
            'verifyCode'=>'Verification Code',
        );
    }

}
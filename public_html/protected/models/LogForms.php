<?php

/**
 * This is the model class for table "{{log_forms}}".
 *
 * The followings are the available columns in table '{{log_forms}}':
 * @property integer $id
 * @property integer $form
 * @property integer $notice
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $ip
 * @property string $url
 * @property string $datetime
 */
class LogForms extends CActiveRecord
{
    const TYPE_CONTACT = 1;
    const TYPE_CALL_BACK = 2;

    const NOTICE_EMAIL = 1;
    const NOTICE_SMS = 2;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{log_forms}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form, notice', 'numerical', 'integerOnly'=>true),
			array('phone', 'length', 'max'=>16),
			array('email', 'length', 'max'=>50),
			array('ip', 'length', 'max'=>20),
			array('url', 'length', 'max'=>150),
			array('message, datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, form, notice, phone, email, message, ip, url, datetime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'form' => 'Form',
			'notice' => 'Notice',
			'phone' => 'Phone',
			'email' => 'Email',
			'message' => 'Message',
			'ip' => 'Ip',
			'url' => 'Url',
			'datetime' => 'Datetime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('form',$this->form);
		$criteria->compare('notice',$this->notice);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('datetime',$this->datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LogForms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function write($form,$notice, $phone='',$email='',$message='')
    {
        $log = new LogForms();
        $log->notice = $notice;
        $log->form = $form;
        $log->phone = str_replace(array('-', '+', '(', ')', ' '), '', $phone);;
        $log->email = $email;
        $log->message = $message;
        $log->url = Yii::app()->request->getUrlReferrer();
        $log->ip = Yii::app()->request->getUserHostAddress();
        $log->datetime = date('Y-m-d h:i:s');
        if ($log->save())
            return true;
        else
            return false;
    }

}

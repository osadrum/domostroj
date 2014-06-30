<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property integer $id
 * @property string $type
 * @property string $section
 * @property string $name
 * @property string $value
 * @property string $title
 * @property string $date_update
 */
class Settings extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, section, name, value, title', 'required'),
			array('type', 'length', 'max'=>50),
			array('section, name', 'length', 'max'=>100),
			array('title', 'length', 'max'=>255),
			array('date_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, section, name, value, title, date_update', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'section' => 'Настройки',
			'name' => 'Name',
			'value' => 'Значение',
			'title' => 'Название',
			'date_update' => 'Date Update',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('date_update',$this->date_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getSectionsList()
    {
        $sections = Yii::app()->db->createCommand()
            ->select('section')
            ->from(self::model()->tableName())
            ->group('section')
            ->queryAll();

        $sectionsList = array();

        foreach ($sections as $section) {
            $sectionsList[$section['section']] = $section['section'];
        }

        return $sectionsList;
    }

    public static function getCacheValue($name) {

        $value = Yii::app()->cache->get($name);

        if($value===false || $value===null) {
            $value = Settings::model()->find(array('select'=>'value', 'condition'=>'name=:name', 'params'=>array(':name'=>$name)))->value;
            Yii::app()->cache->set($name,$value);
        }
        return $value;
    }

    public function getValue()
    {
        $value = '';
        if ($this->type == 'bool') {
            if ($this->value == 0) {
                $value = 'Нет';
            } else if ($this->value == 1) {
                $value = 'Да';
            }
        } else if ($this->type == 'send') {
            if ($this->value == 0) {
                $value = 'Email';
            } else if ($this->value == 1) {
                $value = 'SMS';
            } else if ($this->value == 2) {
                $value = 'SMS и Email';
            }
        } else {
            $value = substr($this->value, 0, 70);
        }

        return $value;
    }
}

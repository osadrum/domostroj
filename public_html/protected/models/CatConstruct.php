<?php

/**
 * This is the model class for table "{{cat_construct}}".
 *
 * The followings are the available columns in table '{{cat_construct}}':
 * @property integer $id
 * @property integer $_type
 * @property string $image
 * @property string $description
 *
 * The followings are the available model relations:
 * @property CatConstructType $type
 * @property Grade[] $tblGrades
 */
class CatConstruct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{cat_construct}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('_type', 'required'),
			array('_type', 'numerical', 'integerOnly'=>true),
			array('image', 'length', 'max'=>127),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, _type, image, description', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'CatConstructType', '_type'),
			'tblGrades' => array(self::MANY_MANY, 'Grade', '{{grade_construct}}(_construct, _grade)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'_type' => 'Type',
			'image' => 'Image',
			'description' => 'Description',
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
		$criteria->compare('_type',$this->_type);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CatConstruct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

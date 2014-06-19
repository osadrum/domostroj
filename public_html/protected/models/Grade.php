<?php

/**
 * This is the model class for table "{{grade}}".
 *
 * The followings are the available columns in table '{{grade}}':
 * @property integer $id
 * @property integer $_project
 * @property integer $_type
 * @property string $price
 *
 * The followings are the available model relations:
 * @property CatGradeType $type
 * @property Project $project
 * @property CatConstruct[] $tblCatConstructs
 */
class Grade extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{grade}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('_project, _type', 'required'),
			array('_project, _type', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, _project, _type, price', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'CatGradeType', '_type'),
			'project' => array(self::BELONGS_TO, 'Project', '_project'),
			'tblCatConstructs' => array(self::MANY_MANY, 'CatConstruct', '{{grade_construct}}(_grade, _construct)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'_project' => 'Project',
			'_type' => 'Type',
			'price' => 'Price',
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
		$criteria->compare('_project',$this->_project);
		$criteria->compare('_type',$this->_type);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

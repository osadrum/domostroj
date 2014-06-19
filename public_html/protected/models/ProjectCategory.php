<?php

/**
 * This is the model class for table "{{project_category}}".
 *
 * The followings are the available columns in table '{{project_category}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $image
 * @property integer $is_published
 * @property integer $_parent
 *
 * The followings are the available model relations:
 * @property Project[] $projects
 * @property ProjectCategory $parent
 * @property ProjectCategory[] $projectCategories
 */
class ProjectCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project_category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, meta_title, meta_description, meta_keywords', 'required'),
			array('is_published, _parent', 'numerical', 'integerOnly'=>true),
			array('title, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
			array('image', 'length', 'max'=>127),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, meta_title, meta_description, meta_keywords, image, is_published, _parent', 'safe', 'on'=>'search'),
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
			'projects' => array(self::HAS_MANY, 'Project', '_category'),
			'parent' => array(self::BELONGS_TO, 'ProjectCategory', '_parent'),
			'projectCategories' => array(self::HAS_MANY, 'ProjectCategory', '_parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'image' => 'Image',
			'is_published' => 'Is Published',
			'_parent' => 'Parent',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('_parent',$this->_parent);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "{{gallery_images}}".
 *
 * The followings are the available columns in table '{{gallery_images}}':
 * @property integer $id
 * @property integer $is_published
 * @property string $title
 * @property string $image
 * @property integer $_category
 *
 * The followings are the available model relations:
 * @property GalleryCategory $category
 */
class GalleryImages extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gallery_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_published, _category', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('image', 'length', 'max'=>127),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, is_published, title, image, _category', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'GalleryCategory', '_category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'is_published' => 'Is Published',
			'title' => 'Title',
			'image' => 'Image',
			'_category' => 'Category',
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
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('_category',$this->_category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GalleryImages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function image($size = 'original')
    {
        return Yii::getPathOfAlias('webroot').Yii::app()->params['imagePath'].$size.'/'.$this->image;
    }

    public function imageDelete()
    {
        if ($this->image) {
            if (file_exists($this->image('original')))
                unlink($this->image('original', ''));
            foreach (Yii::app()->params['imageSizeGallery'] as $path => $size) {
                if (file_exists($this->image($path)))
                    unlink($this->image($path));
            }
        }
    }

    public function beforeDelete()
    {
        $this->imageDelete();
        return parent::beforeDelete();
    }
}

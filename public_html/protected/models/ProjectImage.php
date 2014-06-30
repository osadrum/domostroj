<?php

/**
 * This is the model class for table "{{project_image}}".
 *
 * The followings are the available columns in table '{{project_image}}':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property integer $sort
 * @property integer $is_published
 * @property integer $_project
 *
 * The followings are the available model relations:
 * @property Project $project
 */
class ProjectImage extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sort, is_published, _project', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('image', 'length', 'max'=>127),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, image, sort, is_published, _project', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', '_project'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Наименование',
			'image' => 'Изображение',
			'sort' => 'Сортировка',
			'is_published' => 'Опубликовано',
			'_project' => 'Проект',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('_project',$this->_project);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
            foreach (Yii::app()->params['imageSizeProject'] as $path => $size) {
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

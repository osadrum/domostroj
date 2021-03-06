<?php

/**
 * This is the model class for table "{{review}}".
 *
 * The followings are the available columns in table '{{review}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $document
 * @property integer $is_published
 */
class Review extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{review}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('is_published', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('image, document', 'length', 'max'=>127),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, image, document, is_published', 'safe', 'on'=>'search'),
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
			'title' => 'Заголовок',
			'description' => 'Описание',
			'image' => 'Изображение',
			'document' => 'Документ',
            'is_published' => 'Опубликовано',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('is_published',$this->is_published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function fileDelete()
    {
        if ($this->document) {
            $folder =Yii::getPathOfAlias('webroot') . Yii::app()->params["docPath"];
            unlink($folder . $this->document);
        }
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
            foreach (Yii::app()->params['imageSizeSlider'] as $path => $size) {
                if (file_exists($this->image($path)))
                    unlink($this->image($path));
            }
        }
    }

    public function beforeDelete()
    {
        $this->fileDelete();
        $this->imageDelete();
        return parent::beforeDelete();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getReviewDocLink($model){
        $arr = explode('.',$model->document);
        return CHtml::link('<i class="fa fa-save"></i>',
        Yii::app()->getRequest()->getHostInfo().Yii::app()->params["docPath"].$model->document,array("download"=>'отзыв_'. $model->id .'.'. $arr[1]));
    }
}

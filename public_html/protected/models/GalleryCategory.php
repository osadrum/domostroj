<?php

/**
 * This is the model class for table "{{gallery_category}}".
 *
 * The followings are the available columns in table '{{gallery_category}}':
 * @property integer $id
 * @property integer $is_published
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property string $level
 * @property string $_parent
 *
 * The followings are the available model relations:
 * @property GalleryImages[] $galleryImages
 */
class GalleryCategory extends ActiveRecord
{

    public $_parent_id;
    public $showTreeHtml;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{gallery_category}}';
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
			array('title, description, meta_description, meta_keywords', 'length', 'max'=>255),
			array('image', 'length', 'max'=>127),
            array('root, lft, rgt, level', 'length', 'max'=>10),
            array('_parent', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, is_published, title, description, image, meta_description, meta_keywords, _parent', 'safe', 'on'=>'search'),
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
			'galleryImages' => array(self::HAS_MANY, 'GalleryImages', '_category'),
            'countImages' => array(self::STAT, 'GalleryImages', '_category'),
		);
	}

    public function defaultScope()
    {
        return array(
            'order' => 'root, lft',
        );
    }

    public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 'is_published = 1',
            ),
        );
    }

    public function behaviors()
    {
        return array(
            'nestedSetBehavior' => array(
                'class' => 'ext.nested-set.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'rootAttribute' => 'root',
                'hasManyRoots' => true,
            ),
        );
    }

    public function beforeSave()
    {
        if ($this->_parent == null) {
            $this->_parent = 0;
        }
        return parent::beforeSave();
    }

    protected function afterFind()
    {
        parent::afterFind();

        $this->_parent_id = $this->_parent;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'is_published' => 'Опубликовано',
			'title' => 'Название',
            'description' => 'Описание',
			'image' => 'Изображение',
			'meta_description' => 'META Описание',
			'meta_keywords' => 'META Ключевые слова',
            'countImages' => 'Фотографии',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            '_parent' => 'Родительская категория',
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
        $criteria->compare('description',$this->description,true);
    	$criteria->compare('image',$this->image,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
        $criteria->compare('root',$this->root,true);
        $criteria->compare('lft',$this->lft,true);
        $criteria->compare('rgt',$this->rgt,true);
        $criteria->compare('level',$this->level,true);
        $criteria->compare('_parent',$this->_parent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GalleryCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getCategoryList($nodeType=true, $published=false)
    {
        $output = array();
        if ($published) {
            $nodes = self::model()->published()->findAll();
        } else {
            $nodes = self::model()->findAll();
        }

        if ($nodeType) {
            foreach ($nodes as $node)
                $output[$node->id] = str_repeat('  ', $node->level - 1) . $node->title;
        } else {
            $output = array();
            foreach ($nodes as $node) {
                $output[$node->_parent][$node->id] = $node->title;
            }
        }

        return $output;
    }

    private function showTree($tree, $pid=0)
    {
        foreach ($tree as $id=>$root) {
            if($id!=$pid)continue;
            if(count($root)) {
                foreach($root as $key => $title)
                {
                    if(count($tree[$key])) {
                        $this->showTreeHtml .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-category">'.CHtml::link($title, Yii::app()->createabsoluteUrl('/catalog/default/', array('subCategory'=>$key)));
                        $this->showTreeHtml .= '<ul>';
                        self::ShowTree($tree,$key);
                        $this->showTreeHtml .= '</ul>';
                    } else {
                        $this->showTreeHtml .= '<li class="menu-item menu-item-type-taxonomy menu-item-object-category">'.CHtml::link($title, Yii::app()->createabsoluteUrl('/catalog/default/', array('category'=>$key)));
                    }
                }
            }
        }
    }

    public function tree($tree, $pid=0) {
        $this->showTree($tree, $pid);
        return $this->showTreeHtml;
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
            foreach (Yii::app()->params['imageSizeCategory'] as $path => $size) {
                if (file_exists($this->image($path)))
                    unlink($this->image($path));
            }
        }
    }

    public function beforeDelete()
    {

        $images = GalleryImages::model()->findAllByAttributes(array('_category'=>$this->id));
        if ($images != null) {
            foreach ($images as $image) {
                $image->delete();
            }
        }

        $this->imageDelete();
        return parent::beforeDelete();
    }

   /* public function getTitle()
    {
        $attribute = 'title_' . Yii::app()->getLanguage();
        if ($this->{$attribute} == null) {
            $attribute = 'title_ru';
        }
        return $this->{$attribute};
    }

    public function setTitle($value)
    {
        $attribute = 'title_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }

    public function getDescription()
    {
        $attribute = 'description_' . Yii::app()->getLanguage();
        if ($this->{$attribute} == null) {
            $attribute = 'description_ru';
        }
        return $this->{$attribute};
    }

    public function setDescription($value)
    {
        $attribute = 'description_' . Yii::app()->getLanguage();
        $this->{$attribute} = $value;
    }*/

    public static function getCategoryTitleById($id=null)
    {
        if ($id == null) {
            return Yii::t('catalog', 'Главная категория');
        }

        $category = GalleryCategory::model()->findByPk($id);
        if ($category->_parent > 0) {
            $parent = GalleryCategory::model()->findByPk($category->_parent);
            return $parent->title . ' - '. $category->title;
        }
        return $category->title;
    }

    public static function isFolderOrAlbum($album_id)
    {

        $album = GalleryCategory::model()->findByPk($album_id);

        $child = Yii::app()->db->createCommand()
            ->select('id')
            ->from('{{gallery_category}}')
            ->where('_parent=:parent', array(':parent'=>$album_id))
            ->queryRow();

        if ($child != null) {
            return 'Категория';
        } else {
            return ($album->countImages > 0) ? CHtml::link($album->countImages." фото", Yii::app()->createUrl("/admin/galleryCategory/view", array("id"=>$album->id)), array("class"=>"btn btn-xs btn-two")) : CHtml::link("Добавить фото", Yii::app()->createUrl("/admin/galleryCategory/view", array("id"=>$album->id)), array("class"=>"btn btn-xs btn-four"));
        }
    }

    public static function issetChildren($album_id)
    {
        $child = Yii::app()->db->createCommand()
            ->select('id')
            ->from('{{gallery_category}}')
            ->where('_parent=:parent', array(':parent'=>$album_id))
            ->queryRow();

        if ($child != null) {
            return true;
        } else {
            return false;
        }
    }
}

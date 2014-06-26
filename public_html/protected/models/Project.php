<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $image
 * @property integer $sort
 * @property integer $is_published
 * @property integer $_category
 *
 * The followings are the available model relations:
 * @property Grade[] $grades
 * @property Layout[] $layouts
 * @property ProjectCategory $category
 * @property ProjectImage[] $projectImages
 * @property CatProjectOption[] $tblCatProjectOptions
 */
class Project extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{project}}';
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
			array('sort', 'default','value'=>0),
			array('sort, is_published, _category', 'numerical', 'integerOnly'=>true),
			array('title, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
			array('image', 'length', 'max'=>127),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, meta_title, meta_description, meta_keywords, image, sort, is_published, _category', 'safe', 'on'=>'search'),
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
			'grades' => array(self::HAS_MANY, 'Grade', '_project'),
			'layouts' => array(self::HAS_MANY, 'Layout', '_project'),
			'category' => array(self::BELONGS_TO, 'ProjectCategory', '_category'),
			'projectImages' => array(self::HAS_MANY, 'ProjectImage', '_project'),
			'countImages' => array(self::STAT, 'ProjectImage', '_project'),
			'projectOption' => array(self::MANY_MANY, 'CatProjectOption', '{{project_option}}(_project, _option)'),
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
			'description' => 'Описание',
			'meta_title' => 'Мета наименование',
			'meta_description' => 'Мета описание',
			'meta_keywords' => 'Ключевые слова',
            'countImages' => 'Доп. изображения',
            'layouts' => 'Планировка',
            'grades' => 'Комплектация',
            'projectOption' => 'Параметры',
            'image' => 'Изображение',
			'sort' => '№ п/п',
			'is_published' => 'Опубликовано',
			'_category' => 'Категория',
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
		$criteria->compare('sort',$this->sort);
		$criteria->compare('is_published',$this->is_published);
		$criteria->compare('_category',$this->_category);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function hasPhotoProject($project_id)
    {
        $project = self::model()->findByPk($project_id);

    }

    public static function projectSetting($project_id,$settings,$layout_id=null,$grade_id=null,$title=null)
    {
        $project = self::model()->findByPk($project_id);
        if ($layout_id != 0){
            $layoutOption = LayoutOption::model()->findAllByAttributes(array('_layout'=>$layout_id));
        }
        if ($grade_id != 0){
            $gradeConstruct = GradeConstruct::model()->findAllByAttributes(array('_grade'=>$grade_id));
        }
        if ($settings == 'image') {

            return CHtml::link('Редактировать',
                Yii::app()->createUrl("/admin/project/image", array("id"=>$project_id)),
                array("class"=>"btn btn-xs btn-two"));

        } elseif ($settings == 'layout') {
            if (count($project->layouts) > 0){
                if ($title == null){
                    $title = "Изменить";
                }
                $class = "btn btn-xs btn-two";
            } else {
                if ($title == null){
                    $title = "Добавить";
                }
                $class = "btn btn-xs btn-four";
            }
            return CHtml::link($title,
                Yii::app()->createUrl("/admin/project/layout", array("id"=>$project_id)),
                array("class"=>$class));

        } elseif ($settings == 'grade') {
            if (count($project->grades) > 0){
                if ($title == null){
                    $title = "Изменить";
                }
                $class = "btn btn-xs btn-two";
            } else {
                if ($title == null){
                    $title = "Добавить";
                }
                $class = "btn btn-xs btn-four";
            }
            return CHtml::link($title,
                Yii::app()->createUrl("/admin/project/grade", array("id"=>$project_id)),
                array("class"=>$class));

        } elseif ($settings == 'layoutOptions') {
            if (count($layoutOption) > 0){
                $class = "btn btn-xs btn-two layout_option";
                $projectLayoutOption = LayoutOption::model()->findAllByAttributes(array('_layout'=>$layout_id));
                $layoutOptionTypeList = '<table class="table_construct">';
                foreach ($projectLayoutOption as $layout){
                    $layoutOptionTypeList .= '<tr><td>'.$layout->catLayoutOption->title . '</td>  ';
                    $layoutOptionTypeList .= '<td>' . $layout->value . ' <td>кв.м.</td></td>';
                    $layoutOptionTypeList .= '<td>'.CHtml::link('<i class="fa fa-pencil"></i>','#',
                            array('data-option-id'=>$layout->catLayoutOption->id,
                                'data-layout-id'=>$layout_id,'class'=>'edit_option',
                                'data-id'=>$layout->id,'class'=>'edit_option',
                            )) . '  ';
                    $layoutOptionTypeList .=  CHtml::link('<i class="fa fa-trash-o"></i>','#',
                            array('data-id'=>$layout->id,
                                'class'=>'del_option')) . '</td></tr>';
                }
                $layoutOptionTypeList .='</table>';
            } else {
                $class = "btn btn-xs btn-four layout_option";
            }
            return CHtml::link('Добавить помещение',
                Yii::app()->createUrl("/admin/project/ajaxLayoutOption"),
                array("class"=>$class, 'data-layout-id'=>$layout_id)) . '</br>' . $layoutOptionTypeList;

        } elseif ($settings == 'gradeConstructs') {
            if (count($gradeConstruct) > 0){
                $class = "btn btn-xs btn-two grade_construct";
                $gradeConstruct = GradeConstruct::model()->findAllByAttributes(array('_grade'=>$grade_id));
                $gradeConstructTypeList = '<table class="table_construct">';
                foreach ($gradeConstruct as $construct){
                    $gradeConstructTypeList .= '<tr><td>'.$construct->catConstruct->type->title . '</td>  ';
                    $gradeConstructTypeList .= '<td>'.CHtml::link('<i class="fa fa-pencil"></i>','#',
                        array('data-construct-id'=>$construct->catConstruct->id,
                            'data-constructType-id'=>$construct->catConstruct->_type,
                            'data-grade-id'=>$grade_id,'class'=>'edit_construct')) . '  ';
                    $gradeConstructTypeList .=  CHtml::link('<i class="fa fa-trash-o"></i>','#',
                        array('data-construct-id'=>$construct->catConstruct->id,
                            'data-grade-id'=>$grade_id,
                            'class'=>'del_construct')) . '</td></tr>';
                }
                $gradeConstructTypeList .='</table>';
            } else {
                $class = "btn btn-xs btn-four grade_construct";
            }
            return CHtml::link('Добавить конструктив',
                Yii::app()->createUrl("/admin/project/ajaxGradeConstructType"),
                array("class"=>$class, 'data-grade-id'=>$grade_id)) . '</br>' . $gradeConstructTypeList;

        } elseif ($settings == 'projectOption') {
            if ($project->projectOption != null){
                if ($title == null){
                    $title = 'Изменить';
                }
                $class = "btn btn-xs btn-two project_option";

            } else {
                if ($title == null){
                    $title = 'Добавить';
                }
                $class = "btn btn-xs btn-two project_option";
            }
            return CHtml::link($title,
                Yii::app()->createUrl("/admin/project/ajaxProjectOption"),
                array("class"=>$class, 'data-project-id'=>$project_id));
        }
    }

    public static function hasOption($model,$option){
        if ($option == 'image'){
            $data = $model->projectImages;
        } elseif ($option == 'layout'){
            $data = $model->layouts;
        } elseif ($option == 'grade'){
            $data = $model->layouts;
        } elseif ($option == 'projectOption'){
            $data = $model->layouts;
        }
        if (!empty($data)){
            return '<i class="fa fa-check"></i>';
        } else {
            return '<i class="fa fa-circle-o"></i>';
        }

    }

}

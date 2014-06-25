<?php

/**
 * This is the model class for table "{{grade_construct}}".
 *
 * The followings are the available columns in table '{{grade_construct}}':
 * @property integer $_grade
 * @property integer $_construct
 */
class GradeConstruct extends ActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{grade_construct}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('_grade, _construct', 'required'),
			array('_grade, _construct', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('_grade, _construct', 'safe', 'on'=>'search'),
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
            'catConstruct' => array(self::BELONGS_TO, 'CatConstruct', '_construct'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'_grade' => 'Комплектация',
			'_construct' => 'Конструктив',
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

		$criteria->compare('_grade',$this->_grade);
		$criteria->compare('_construct',$this->_construct);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GradeConstruct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static  function getListConstruct($grade_id){

        $gradeConstruct = GradeConstruct::model()->findAllByAttributes(array('_grade'=>$grade_id));
        $selectedTypesArray = array();
        foreach ($gradeConstruct as $construct){
            $selectedTypesArray[$construct->catConstruct->_type] = $construct->catConstruct->type->title;
        }
        $types = CatConstructType::model()->findAll();
        $typesArray = [];
        foreach ($types as $type){
            $typesArray[$type->id] =  $type->title;
        }

        return array_diff_key($typesArray,$selectedTypesArray);
    }

}

<?php
class ActiveRecord extends CActiveRecord
{
    const PUBLISHED = 1;
    const NO_PUBLUSHED = 0;

    public static function getIsPublishedTitleList() {
        return array(
            0 => 'Не опубликовано',
            1 => 'Опубликовано'
        );
    }

    public static function getIsPublishedTitle($id) {
        $list = self::getIsPublishedTitleList();
        return $list[$id];
    }

    public static function getImageLink($image, $size='small') {
        return Yii::app()->getRequest()->getHostInfo().'/upload/images/'.$size.'/'.$image;
    }

    public static function getListType($class){
        $types = $class::model()->findAll();
        $typesArray = [];
        foreach ($types as $type){
            $typesArray[$type->id] =  $type->title;
        }
        return $typesArray;
    }

    public static function getTitleType($class,$id){
        return $class::model()->findByPk($id)->title;
    }

}
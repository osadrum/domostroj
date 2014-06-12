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

}
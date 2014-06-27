<?php
class Statics
{
    public static function getImageLink($image, $size='small', $subFolder=null)
    {
        if ($subFolder != null) {
            return Yii::app()->getRequest()->getHostInfo().'/upload/images/'.$subFolder.'/'.$size.'/'.$image;
        }
        return Yii::app()->getRequest()->getHostInfo().'/upload/images/'.$size.'/'.$image;
    }

    public static function getImageLinkById($model, $id, $size='small', $subFolder=null)
    {
        $image = $model::model()->findByPk($id)->image;

        if ($image == null) {
            return Yii::app()->assetManager->publish(
                Yii::getPathOfAlias('webroot.themes.kuppersberg.assets'),
                false,
                -1,
                YII_DEBUG
            ).'/images/no_image.jpg';
        }

        if ($subFolder != null) {
            return Yii::app()->getRequest()->getHostInfo().'/upload/images/'.$subFolder.'/'.$size.'/'.$image;
        }
        return Yii::app()->getRequest()->getHostInfo().'/upload/images/'.$size.'/'.$image;
    }
}
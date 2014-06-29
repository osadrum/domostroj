<?php

class WorksController extends Controller
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_published=1';


        $dataProvider=new CActiveDataProvider('GalleryCategory', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('index',array('works'=>$dataProvider));
    }
}
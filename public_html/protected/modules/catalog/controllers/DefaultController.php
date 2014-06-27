<?php

class DefaultController extends Controller
{
    public function actionIndex($category=null)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_published=1';
        if ($category != null) {
            $criteria->addCondition('_category=:category_id');
            $criteria->params = array(':category_id'=>$category);
        }

        $dataProvider=new CActiveDataProvider('Project', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
        ));
        $this->render('index',array('catalog'=>$dataProvider));
    }
}
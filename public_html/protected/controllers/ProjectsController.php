<?php

class ProjectsController extends Controller
{
    public function actionIndex($id=null)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'is_published=1';
        if ($id != null) {
            $criteria->addCondition('_category=:category_id');
            $criteria->params = array(':category_id'=>$id);
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
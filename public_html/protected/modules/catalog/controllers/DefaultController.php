<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->condition = 'is_published=1';

        if(isset($_POST['filter'])) {
            $filterParams = $_POST['filter'];
            Yii::app()->user->setState('filterParams', $filterParams);
        } else {
            $filterParams = Yii::app()->user->getState('filterParams');
            if (empty($filterParams)) {
                $filterParams = array();
            }
        };
        if (!empty($filterParams['category'])) {
            $criteria->addCondition('_category='.(int)$filterParams['category']);
        }
        if (!empty($filterParams['floor'])) {
            $criteria->addCondition('floor='.(int)$filterParams['floor']);
        }
        if (!empty($filterParams['minArea']) && !empty($filterParams['maxArea'])) {
            $criteria->addCondition('area >= '.(int)$filterParams['minArea'].' AND area <= '.(int)$filterParams['maxArea']);
        }
        if (!empty($filterParams['minPrice']) && !empty($filterParams['maxPrice'])) {
            $criteria->join = " INNER JOIN {{grade}} AS grd ON grd._project=t.id";
            $criteria->addCondition('grd.price >= '.(int)$filterParams['minPrice'].' AND grd.price <= '.(int)$filterParams['maxPrice']);
        }


        $dataProvider=new CActiveDataProvider('Project', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
        $this->render('index',array('catalog'=>$dataProvider));
    }
}
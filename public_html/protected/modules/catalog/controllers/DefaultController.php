<?php

class DefaultController extends Controller
{
    public function actionIndex($category=null)
    {
        $this->showFilter = true;

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

        $this->pageTitle = 'Каталог проектов';

        if ($category != null) {
            $criteria->addCondition('_category=:category');
            $criteria->params = array(':category'=>(int)$category);
            $cat = ProjectCategory::model()->findByPk((int)$category);
            $this->categoryProjects = $category;
            $this->pageTitle .= ' - '.$cat->title;
        } else {
            $criteria->addCondition('_category IS NOT NULL');
        }

        if (!empty($filterParams['floor'])) {
            $criteria->addCondition('floor='.(int)$filterParams['floor']);
        } else {
            $criteria->addCondition('floor > 0');
        }
        if (!empty($filterParams['minArea']) && !empty($filterParams['maxArea'])) {
            $criteria->addCondition('area >= '.(int)$filterParams['minArea'].' AND area <= '.(int)$filterParams['maxArea']);
        } else {
            $criteria->addCondition('area > 0');
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
        $this->render('index',array(
            'catalog'=>$dataProvider,
            'category' => $category,
        ));
    }
}
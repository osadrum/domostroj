<?php

class RandCategory extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, image';
        $criteria->condition = 'is_published = 1';
        $criteria->limit = '4';

        $category = ProjectCategory::model()->findAll($criteria);

        $this->render('view',array(
            'category' => $category
        ));
    }
}
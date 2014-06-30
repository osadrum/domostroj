<?php

class VerticalProjects extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, image';
        $criteria->condition = 'is_published = 1';
        $criteria->order = 'RAND()';
        $criteria->limit = 3;

        $projects = Project::model()->findAll($criteria);

        $this->render('view',array(
            'projects' => $projects
        ));
    }
}
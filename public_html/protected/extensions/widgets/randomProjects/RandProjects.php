<?php

class RandProjects extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'id, title, image';
        $criteria->condition = 'is_published = 1';
        $criteria->order = 'RAND()';
        $criteria->limit = Settings::getCacheValue('numProjects');

        $projects = Project::model()->findAll($criteria);

        $this->render('view',array(
            'projects' => $projects
        ));
    }
}
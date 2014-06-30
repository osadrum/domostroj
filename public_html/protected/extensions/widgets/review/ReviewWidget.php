<?php

class ReviewWidget extends CWidget
{
    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_published=1');
        $criteria->limit = Settings::getCacheValue('numReviews');
        $review = Review::model()->findAll($criteria);
        $this->render('reviewWidget',[
            'review'=>$review
        ]);
    }
}
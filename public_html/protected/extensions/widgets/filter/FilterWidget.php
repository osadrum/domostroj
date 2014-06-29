<?php

class FilterWidget extends CWidget
{
    public $category;

    public function run()
    {
        $filterParams = Yii::app()->user->getState('filterParams');

        $category = ($this->category != null)?$this->category:0;

        $minPrice = Grade::getMinPrice();
        $maxPrice = Grade::getMaxPrice();

        $minArea = Project::getMinArea();
        $maxArea = Project::getMaxArea();

        $minAreaValue = ($filterParams['minArea'] != null)?$filterParams['minArea']:$minArea;
        $maxAreaValue = ($filterParams['maxArea'] != null)?$filterParams['maxArea']:$maxArea;

        $minPriceValue = ($filterParams['minPrice'] != null)?$filterParams['minPrice']:$minPrice;
        $maxPriceValue = ($filterParams['maxPrice'] != null)?$filterParams['maxPrice']:$maxPrice;

        $floors = Project::getListAllFloors();

        $this->render('filterWidget',array(
            'filterParams' => $filterParams,
            'minPrice' => (int)$minPrice,
            'maxPrice' => (int)$maxPrice,
            'minArea' => (int)$minArea,
            'maxArea' => (int)$maxArea,
            'minAreaValue' => (int)$minAreaValue,
            'maxAreaValue' => (int)$maxAreaValue,
            'minPriceValue' => (int)$minPriceValue,
            'maxPriceValue' => (int)$maxPriceValue,
            'floors' => $floors,
            'category' => $category
        ));
    }
}
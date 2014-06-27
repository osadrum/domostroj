<?php

class SliderWidget extends CWidget
{
    public function run()
    {
        $slider = Slider::model()->findAll();

        $this->render('sliderWidget',[
            'slider'=>$slider
        ]);
    }
}
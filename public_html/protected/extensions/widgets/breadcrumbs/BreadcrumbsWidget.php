<?php
Yii::import('zii.widgets.CBreadcrumbs');

class BreadcrumbsWidget extends CBreadcrumbs {

    public $tagName='ul';
    public $htmlOptions=array('class'=>'link-location');
    public $encodeLabel=true;
    public $homeLink;
    public $links=array();
    public $activeLinkTemplate='<li><a href="{url}">{label}</a></li>';
    public $inactiveLinkTemplate='<li class="active">{label}</li>';
    public $separator='';

    public function run()
    {
        if(empty($this->links))
            return;

        echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
        $links=array();
        if($this->homeLink===null)
            $links[]=CHtml::link(Yii::t('zii','Home'),Yii::app()->homeUrl);
        elseif($this->homeLink!==false)
            $links[]=$this->homeLink;
        foreach($this->links as $label=>$url)
        {
            if(is_string($label) || is_array($url))
                $links[]=strtr($this->activeLinkTemplate,array(
                    '{url}'=>CHtml::normalizeUrl($url),
                    '{label}'=>$this->encodeLabel ? CHtml::encode($label) : $label,
                ));
            else
                $links[]=str_replace('{label}',$this->encodeLabel ? CHtml::encode($url) : $url,$this->inactiveLinkTemplate);
        }
        echo implode($this->separator,$links);
        echo CHtml::closeTag($this->tagName);
    }
}
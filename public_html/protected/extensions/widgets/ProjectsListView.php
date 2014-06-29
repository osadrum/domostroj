<?php

Yii::import('zii.widgets.CListView');

class ProjectsListView extends CListView
{
    private $_assetsUrl = null;
    /**
     * Renders the data item list.
     */
    public function renderItems()
    {
        $data=$this->dataProvider->getData();
        if(($n=count($data))>0)
        {
            $owner=$this->getOwner();
            $viewFile=$owner->getViewFile($this->itemView);
            $j=0;
            foreach($data as $i=>$item)
            {
                $data=$this->viewData;
                $data['index']=$i;
                $data['data']=$item;
                $data['widget']=$this;
                $owner->renderFile($viewFile,$data);
                if($j++ < $n-1) {
                    echo $this->separator;
                }
            }
        }
        else
            $this->renderEmptyText();
    }

    public function registerClientScript()
    {
        $id=$this->getId();

        if($this->ajaxUpdate===false)
            $ajaxUpdate=array();
        else
            $ajaxUpdate=array_unique(preg_split('/\s*,\s*/',$this->ajaxUpdate.','.$id,-1,PREG_SPLIT_NO_EMPTY));
        $options=array(
            'ajaxUpdate'=>$ajaxUpdate,
            'ajaxVar'=>$this->ajaxVar,
            'pagerClass'=>$this->pagerCssClass,
            'loadingClass'=>$this->loadingCssClass,
            'sorterClass'=>$this->sorterCssClass,
            'enableHistory'=>$this->enableHistory
        );
        if($this->ajaxUrl!==null)
            $options['url']=CHtml::normalizeUrl($this->ajaxUrl);
        if($this->ajaxType!==null)
            $options['ajaxType']=strtoupper($this->ajaxType);
        if($this->updateSelector!==null)
            $options['updateSelector']=$this->updateSelector;
        foreach(array('beforeAjaxUpdate', 'afterAjaxUpdate', 'ajaxUpdateError') as $event)
        {
            if($this->$event!==null)
            {
                if($this->$event instanceof CJavaScriptExpression)
                    $options[$event]=$this->$event;
                else
                    $options[$event]=new CJavaScriptExpression($this->$event);
            }
        }

        $options=CJavaScript::encode($options);
        $cs=Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCoreScript('bbq');
        if($this->enableHistory)
            $cs->registerCoreScript('history');
        $cs->registerScriptFile($this->getAssetsUrl().'/js/jquery.yiilistviewCustom.js',CClientScript::POS_END);
        $cs->registerScript(__CLASS__.'#'.$id,"jQuery('#$id').yiiListView($options);");
    }

    public function getAssetsUrl()
    {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else
        {
            $assetsPath = Yii::getPathOfAlias('bootstrap.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}

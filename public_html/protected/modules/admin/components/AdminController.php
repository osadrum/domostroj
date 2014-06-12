<?php

class AdminController extends CController
{
    public $layout='//layouts/admin_column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu=array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs=array();
    public $pageTitle;
    public $pageIcon = "";
    public $metaKeywords;
    public $metaDescription;

    public $menuItems;
   // private $_assetsBase = null;

    public function init(){
        Yii::app()->getClientScript()->registerCoreScript('jquery');

        $this->menuItems = array(
            array('label' => 'Галерея',
                'url' => array('/admin/galleryCategory'),
                'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                'icon' => 'fa fa-picture-o',
            ),
            array('label' => 'Настройки',
                'url' => array('/admin/settings'),
                'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                'icon' => 'fa fa-cogs',
            ),
        );
    }

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('admin'),
            ),
           /* array('allow',
                'actions'=>array('profile'),
                'roles'=>array('service'),
            ),*/
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /*public function getAssetsBase()
    {
        if ($this->_assetsBase === null) {

            $this->_assetsBase = Yii::app()->assetManager->publish(
                Yii::getPathOfAlias('webroot.themes.domostroj.assets'),
                false,
                -1,
                YII_DEBUG
            );
        }

        return $this->_assetsBase;
    }*/

}
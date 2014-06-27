<?php

class AdminController extends Controller
{
    public $pageIcon = "";

    public $layout='//layouts/admin_column2';

    public $defaultAction = 'admin';
    public function init(){
        $this->leftMenuAdmin = array(
            array('label' => 'Проекты',
                'url' => array('/admin/project'),
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'project' : false,
                'icon' => 'fa fa-home',
            ),
            array('label' => 'Галерея',
                'url' => array('/admin/galleryCategory'),
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'galleryCategory' : false,
                'icon' => 'fa fa-picture-o',
            ),
            array('label' => 'Страницы',
                'url' => array('/admin/pages'),
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'pages' : false,
                'icon' => 'fa fa-file-o',
            ),
            array('label' => 'Слайдер',
                'url' => array('/admin/slider'),
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'pages' : false,
                'icon' => 'fa fa-desktop',
            ),
            array('label' => 'Справочники',
                'url' => '/admin/default/catalog',
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'catalog' : false,
                'icon' => 'fa fa-book',
            ),
            array('label' => 'Настройки',
                'url' => array('/admin/settings'),
                'active' => isset($this->module) ? $this->module->id === 'admin' && $this->id === 'settings' : false,
                'icon' => 'fa fa-cogs',
            ),
        );
        parent::init();
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
}
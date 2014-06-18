<?php

class AdminController extends Controller
{
    public $pageIcon = "";

    public $layout='//layouts/admin_column2';

    public function init(){
        $this->leftMenuAdmin = array(
            array('label' => 'Страницы',
                'url' => array('/admin/pages'),
                'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                'icon' => 'fa fa-file-o',
            ),
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
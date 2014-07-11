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
                'active' =>  ($this->id === 'project') ? true : false,
                'icon' => 'fa fa-home',
            ),
            array('label' => 'Наши работы',
                'url' => array('/admin/galleryCategory'),
                'active' => ($this->id === 'galleryCategory') ? true : false,
                'icon' => 'fa fa-picture-o',
            ),
            array('label' => 'Страницы',
                'url' => array('/admin/pages'),
                'active' => ($this->id === 'pages') ? true : false,
                'icon' => 'fa fa-file-o',
            ),
            array('label' => 'Слайдер',
                'url' => array('/admin/slider'),
                'active' => ($this->id === 'slider') ? true : false,
                'icon' => 'fa fa-desktop',
            ),
            array('label' => 'Отзывы',
                'url' => array('/admin/review'),
                'active' => ($this->id === 'review') ? true : false,
                'icon' => 'fa fa-comments-o',
            ),
            array('label' => 'Справочники',
                'url' => '/admin/default/catalog',
                'icon' => 'fa fa-book',
            ),
            array('label' => 'Настройки',
                'url' => array('/admin/settings'),
                'active' => ($this->id === 'settings') ? true : false,
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
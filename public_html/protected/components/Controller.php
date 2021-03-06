<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $menuItems=array();
	public $leftMenuAdmin=array();
	public $menuItemsAdmin=array();
    private $_assetsUrl = null;
    public $breadcrumbs = array();

    public $metaTitle;
    public $metaDescription;
    public $metaKeywords;
    public $pageIcon;
    public $categoryProjects;

    public $showFilter = false;
    public $showSlider = false;
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */

    public function init()
    {
        $this->pageTitle = Settings::getCacheValue('siteName');
        $this->metaKeywords = Settings::getCacheValue('metaKeywords');
        $this->metaDescription = Settings::getCacheValue('metaDescription');

        Yii::app()->getClientScript()->registerCoreScript('jquery', CClientScript::POS_END);
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/global-style.css');
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/css/style.css');
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/hover-dropdown/bootstrap-hover-dropdown.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/masonry/masonry.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/page-scroller/jquery.ui.totop.min.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/mixitup/jquery.mixitup.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/mixitup/jquery.mixitup.init.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/fancybox/jquery.fancybox.pack.js?v=2.1.5', CClientScript::POS_END);
        //Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/easy-pie-chart/jquery.easypiechart.js');
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/waypoints/waypoints.min.js', CClientScript::POS_END);
        //Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/sticky/jquery.sticky.js');
        Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/jquery.wp.custom.js', CClientScript::POS_END);
       // Yii::app()->clientScript->registerScriptFile($this->getAssetsUrl() . '/js/jquery.wp.switcher.js');

        $this->menuItems[] = array('label' => 'Главная',
            'url' => Yii::app()->homeUrl,
            'active' => ($this->id === 'site') ? true : false,
        );

        $pageMenu = new PageTree();
        $pagesMenu = $pageMenu->menu();

        if (!empty($pagesMenu)) {
            $this->menuItems = array_merge($this->menuItems, $pagesMenu);
        }

        $projectCategory = ProjectCategory::model()->published()->findAll();
        if ($projectCategory != null) {
            $projectItems = array();
            foreach ($projectCategory as $cat) {
                $projectItems[] = array(
                    'label' => $cat->title,
                    'url' => array('/catalog/default', 'category' => $cat->id),
                );
            }
            $this->menuItems[] = array('label' => 'Проекты', 'url' => array('/catalog'), 'linkOptions'=> array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'data-hover'=>"dropdown", 'onclick'=>"location.href='".Yii::app()->createUrl('/catalog')."'",
                'data-close-others'=>"true"), 'active' => ($this->module->id === 'catalog') ? true : false,  'items' => $projectItems);
        }

        $this->menuItems[] = array('label' => 'Наши работы',
            'url' => array('/works'),
            'active' => ($this->id === 'works') ? true : false,
        );

        $this->menuItems[] = array('label' => 'Контакты',
            'url' => array('/contacts'),
            'active' => ($this->id === 'contacts') ? true : false,
        );

        if (isset(Yii::app()->user->role)) {
            if (Yii::app()->user->role == 'admin'){
                $this->menuItems[] = array('label' => 'Профиль',
                        'url' => array('/admin/default/profile'),
                        //'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                );
                $this->menuItems[] = array('label' => 'Выход',
                        'url' => array('/site/logout'),
                        //'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                );
            }
        }

        parent::init();
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
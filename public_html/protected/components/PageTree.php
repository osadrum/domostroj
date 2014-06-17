<?php

class PageTree
{
    private $menu = array();

	public function menu()
	{
		$pages = Page::model()->findAll();
		$level = 0;

		foreach ($pages as $n => $page)
		{
            if ($page->level == $level) {
                $this->menu[] = array(
                    'label' => $page->page_title,
                    'url' => array('/pages/default/view', 'id' => $page->id),
                    //'active' => false,
                );
            }


            array('label' => 'Страницы',
                'url' => '#',
                //'icon' => 'fa fa-list',
                'linkOptions'=>array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'data-hover'=>"dropdown",
                    'data-close-others'=>"true"),
                'items' => array(
                    array('label' => 'Модели',
                        'url' => array('/admin/products'),
                        'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                        'icon' => 'fa fa-calendar',
                    ),
                    array('label' => 'Категории',
                        'url' => array('/admin/category'),
                        'active' => isset($this->module) ? $this->module->id === 'pages' && $this->id === 'admin' : false,
                        'icon' => 'fa fa-calendar',
                    ),
                )
            );


			if ($page->level == $level)
				echo CHtml::closeTag('li') . "\n";
			else if ($page->level>$level)
				echo CHtml::openTag('ul') . "\n";
			else
			{
				echo CHtml::closeTag('li') . "\n";

				for ($i = $level - $page->level; $i; $i--)
				{
					echo CHtml::closeTag('ul') . "\n";
					echo CHtml::closeTag('li') . "\n";
				}
			}

			echo CHtml::openTag('li');
			echo CHtml::link($page->page_title, array('/pages/default/view', 'id' => $page->id));
			$level = $page->level;
		}

		for ($i = $level; $i; $i--)
		{
			echo CHtml::closeTag('li') . "\n";
			echo CHtml::closeTag('ul') . "\n";
		}
	}

}
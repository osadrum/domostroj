<?php

class PageTree
{
    private $menu = array();

	public function menu()
	{
		$pages = Page::model()->findAll();

		foreach ($pages as $n => $page)
		{
            if (array_key_exists($page->_parent_id, $this->menu)) {
                $this->menu[$page->_parent_id]['items'][$page->id] = array(
                    'label' => $page->page_title,
                    'url' => array('/pages/default/view', 'id' => $page->id),
                );
                $this->menu[$page->_parent_id]['url'] = '#';
                $this->menu[$page->_parent_id]['linkOptions'] = array('class'=>"dropdown-toggle", 'data-toggle'=>"dropdown", 'data-hover'=>"dropdown",
                    'data-close-others'=>"true");
                continue;
            }
            $this->menu[$page->id] = array(
                'label' => $page->page_title,
                'url' => array('/pages/default/view', 'id' => $page->id),
            );
        }
        return $this->menu;
	}
}
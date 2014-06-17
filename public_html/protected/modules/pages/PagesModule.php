<?php

class PagesModule extends CWebModule {

	/**
	 * @var string идентификатор, по которому доступна закешированная карта путей
	 */
	public $cacheId = 'pagesPathsMap';

	public function init()
	{
		if (Yii::app()->cache->get($this->cacheId) === false)
			$this->updatePathsMap();

		$this->setImport(array(
			'pages.models.*',
			'pages.components.*',
		));
	}

	/**
	 * Возвращает карту путей из кеша.
	 * @return mixed
	 */
	public function getPathsMap()
	{
		$pathsMap = Yii::app()->cache->get($this->cacheId);
		return $pathsMap === false ? $this->generatePathsMap() : $pathsMap;
	}

	/**
	 * Сохраняет в кеш актуальную на момент вызова карту путей.
	 * @return void
	 */
	public function updatePathsMap()
	{
		Yii::app()->cache->set($this->cacheId, $this->generatePathsMap());
	}

	/**
	 * Генерация карты страниц.
	 * Используется при разборе и создании URL.
	 * @return array ID узла => путь до узла
	 */
	public function generatePathsMap()
	{
		$nodes = Yii::app()->db->createCommand()
			->select('id, level, slug')
			->from('{{pages}}')
			->order('root, lft')
			->queryAll();

		$pathsMap = array();
		$depths = array();

		foreach ($nodes as $node)
		{
			if ($node['level'] > 1)
				$path = $depths[$node['level'] - 1];
			else
				$path = '';

			$path .= $node['slug'];
			$depths[$node['level']] = $path . '/';
			$pathsMap[$node['id']] = $path;
		}

		return $pathsMap;
	}

}

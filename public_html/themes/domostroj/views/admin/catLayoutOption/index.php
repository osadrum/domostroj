<?php
$this->breadcrumbs=array(
	'Cat Layout Options',
);

$this->menu=array(
	array('label'=>'Create CatLayoutOption','url'=>array('create')),
	array('label'=>'Manage CatLayoutOption','url'=>array('admin')),
);
?>

<h1>Cat Layout Options</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

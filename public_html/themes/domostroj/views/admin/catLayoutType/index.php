<?php
$this->breadcrumbs=array(
	'Cat Layout Types',
);

$this->menu=array(
	array('label'=>'Create CatLayoutType','url'=>array('create')),
	array('label'=>'Manage CatLayoutType','url'=>array('admin')),
);
?>

<h1>Cat Layout Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

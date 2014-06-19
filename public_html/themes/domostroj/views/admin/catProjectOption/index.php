<?php
$this->breadcrumbs=array(
	'Cat Project Options',
);

$this->menu=array(
	array('label'=>'Create CatProjectOption','url'=>array('create')),
	array('label'=>'Manage CatProjectOption','url'=>array('admin')),
);
?>

<h1>Cat Project Options</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

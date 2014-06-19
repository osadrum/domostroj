<?php
$this->breadcrumbs=array(
	'Cat Grade Types',
);

$this->menu=array(
	array('label'=>'Create CatGradeType','url'=>array('create')),
	array('label'=>'Manage CatGradeType','url'=>array('admin')),
);
?>

<h1>Cat Grade Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

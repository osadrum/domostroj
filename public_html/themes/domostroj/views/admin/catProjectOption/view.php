<?php
$this->breadcrumbs=array(
	'Cat Project Options'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CatProjectOption','url'=>array('index')),
	array('label'=>'Create CatProjectOption','url'=>array('create')),
	array('label'=>'Update CatProjectOption','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CatProjectOption','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatProjectOption','url'=>array('admin')),
);
?>

<h1>View CatProjectOption #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>

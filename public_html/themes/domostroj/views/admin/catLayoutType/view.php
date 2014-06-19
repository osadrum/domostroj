<?php
$this->breadcrumbs=array(
	'Cat Layout Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CatLayoutType','url'=>array('index')),
	array('label'=>'Create CatLayoutType','url'=>array('create')),
	array('label'=>'Update CatLayoutType','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CatLayoutType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatLayoutType','url'=>array('admin')),
);
?>

<h1>View CatLayoutType #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>

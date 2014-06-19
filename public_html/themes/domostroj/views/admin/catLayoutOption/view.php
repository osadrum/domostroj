<?php
$this->breadcrumbs=array(
	'Cat Layout Options'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CatLayoutOption','url'=>array('index')),
	array('label'=>'Create CatLayoutOption','url'=>array('create')),
	array('label'=>'Update CatLayoutOption','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CatLayoutOption','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatLayoutOption','url'=>array('admin')),
);
?>

<h1>View CatLayoutOption #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>

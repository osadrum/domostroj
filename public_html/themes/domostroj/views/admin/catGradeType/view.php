<?php
$this->breadcrumbs=array(
	'Cat Grade Types'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CatGradeType','url'=>array('index')),
	array('label'=>'Create CatGradeType','url'=>array('create')),
	array('label'=>'Update CatGradeType','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CatGradeType','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatGradeType','url'=>array('admin')),
);
?>

<h1>View CatGradeType #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>

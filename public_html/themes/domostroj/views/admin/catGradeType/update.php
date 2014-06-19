<?php
$this->breadcrumbs=array(
	'Cat Grade Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatGradeType','url'=>array('index')),
	array('label'=>'Create CatGradeType','url'=>array('create')),
	array('label'=>'View CatGradeType','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CatGradeType','url'=>array('admin')),
);
?>

<h1>Update CatGradeType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
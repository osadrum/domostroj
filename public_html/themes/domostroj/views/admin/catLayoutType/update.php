<?php
$this->breadcrumbs=array(
	'Cat Layout Types'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatLayoutType','url'=>array('index')),
	array('label'=>'Create CatLayoutType','url'=>array('create')),
	array('label'=>'View CatLayoutType','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CatLayoutType','url'=>array('admin')),
);
?>

<h1>Update CatLayoutType <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
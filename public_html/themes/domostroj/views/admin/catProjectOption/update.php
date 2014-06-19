<?php
$this->breadcrumbs=array(
	'Cat Project Options'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatProjectOption','url'=>array('index')),
	array('label'=>'Create CatProjectOption','url'=>array('create')),
	array('label'=>'View CatProjectOption','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CatProjectOption','url'=>array('admin')),
);
?>

<h1>Update CatProjectOption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
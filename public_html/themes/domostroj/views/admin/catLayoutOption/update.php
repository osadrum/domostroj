<?php
$this->breadcrumbs=array(
	'Cat Layout Options'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatLayoutOption','url'=>array('index')),
	array('label'=>'Create CatLayoutOption','url'=>array('create')),
	array('label'=>'View CatLayoutOption','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CatLayoutOption','url'=>array('admin')),
);
?>

<h1>Update CatLayoutOption <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
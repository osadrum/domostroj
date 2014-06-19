<?php
$this->breadcrumbs=array(
	'Cat Layout Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatLayoutOption','url'=>array('index')),
	array('label'=>'Manage CatLayoutOption','url'=>array('admin')),
);
?>

<h1>Create CatLayoutOption</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
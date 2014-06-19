<?php
$this->breadcrumbs=array(
	'Cat Layout Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatLayoutType','url'=>array('index')),
	array('label'=>'Manage CatLayoutType','url'=>array('admin')),
);
?>

<h1>Create CatLayoutType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
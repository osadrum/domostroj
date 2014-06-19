<?php
$this->breadcrumbs=array(
	'Cat Project Options'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatProjectOption','url'=>array('index')),
	array('label'=>'Manage CatProjectOption','url'=>array('admin')),
);
?>

<h1>Create CatProjectOption</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
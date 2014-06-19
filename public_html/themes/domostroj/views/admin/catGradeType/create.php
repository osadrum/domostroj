<?php
$this->breadcrumbs=array(
	'Cat Grade Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatGradeType','url'=>array('index')),
	array('label'=>'Manage CatGradeType','url'=>array('admin')),
);
?>

<h1>Create CatGradeType</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
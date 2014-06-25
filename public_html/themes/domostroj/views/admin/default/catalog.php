<?php
$this->pageTitle = 'Справочники';
$this->breadcrumbs=array(
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<?php echo CHtml::link('Конструктивы', Yii::app()->createUrl('/admin/catConstructType'), array('class' => 'btn btn-xs btn-four')) ?>
&nbsp
<?php echo CHtml::link('Виды конструктивов', Yii::app()->createUrl('/admin/catConstruct'), array('class' => 'btn btn-xs btn-four')) ?>
&nbsp
<?php echo CHtml::link('Уровни', Yii::app()->createUrl('/admin/catLayoutType'), array('class' => 'btn btn-xs btn-four')) ?>
&nbsp
<?php echo CHtml::link('Помещения', Yii::app()->createUrl('/admin/catLayoutOption'), array('class' => 'btn btn-xs btn-four')) ?>
&nbsp
<?php echo CHtml::link('Виды комплектаций', Yii::app()->createUrl('/admin/catGradeType'), array('class' => 'btn btn-xs btn-four')) ?>
&nbsp
<?php echo CHtml::link('Парамеры проектов', Yii::app()->createUrl('/admin/catProjectOption'), array('class' => 'btn btn-xs btn-four')) ?>

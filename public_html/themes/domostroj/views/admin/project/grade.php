<?php
$this->pageTitle = 'Комплектация проекта';
$this->breadcrumbs = array(
    'Проекты' => array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('<span class="fa fa-arrow-left"></span> перейти к списку проектов', Yii::app()->createUrl('/admin/project'), array('class' => 'btn btn-xs btn-two')) ?>
<?php echo CHtml::link('<span class="fa fa-home"></span> свойства проекта', Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'grade-grid',
            'dataProvider' => $grade,
            'template' => '{items} {pager}',
            //'filter' => $grade,
            'columns' => array(
                '_project',
                '_type',
                'price',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} &nbsp{delete}',
                )
            ),
        )); ?>
    </div>
    <!-- /.row (nested) -->
</div>
<!-- /.panel-body -->




<?php
$this->pageTitle = 'Справочник видов комплектаций';
$this->breadcrumbs=array(
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<?php echo CHtml::link('Добавить вид комплектаций', Yii::app()->createUrl('/admin/catGradeType/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'cat-construct-types-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                'title',
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 10%;text-align:center;vertical-align:middle'),
                    'template' => '{update} &nbsp{delete}',
                )
            ),
        )); ?>
    </div>
    <!-- /.row (nested) -->
</div>
<!-- /.panel-body -->




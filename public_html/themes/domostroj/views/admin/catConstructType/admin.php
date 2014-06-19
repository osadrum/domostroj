<?php
$this->breadcrumbs=array(
	'Cat Construct Types'=>array('index'),
	'Manage',
);
$this->pageTitle = 'Справочник типов конструктивов';
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<?php echo CHtml::link('Добавить типа конструктив', Yii::app()->createUrl('/admin/catConstructType/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'news-category-grid',
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




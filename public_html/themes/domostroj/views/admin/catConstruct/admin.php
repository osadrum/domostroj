<?php
$this->pageTitle = 'Справочник конструктивов';
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<?php echo CHtml::link('Добавить конструктив', Yii::app()->createUrl('/admin/catConstruct/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'news-category-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => '_type',

                    /*'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 70%'
                    ),*/
                    'value' => '$data->_type',
                ),
                array(
                    'name' => 'image',
                   /* 'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 10%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'type' => 'raw',
                    'filter' => '',*/
                    'value' => '$data->image',
                ),
                array(
                    'name' => 'description',
                   /* 'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 45%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => GalleryCategory::getCategoryList(),*/
                    'value' => '$data->description',
                ),
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




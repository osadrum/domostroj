<?php
$this->pageTitle = 'Категории проектов';
$this->breadcrumbs=array(
    'Проекты' => array('/admin/project/admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('<span class="fa fa-arrow-left"></span> Назад', Yii::app()->createUrl('/admin/project'), array('class' => 'btn btn-xs btn-three')) ?>

<?php echo CHtml::link('Добавить категорию проектов', Yii::app()->createUrl('/admin/projectCategory/create'), array('class' => 'btn btn-xs btn-two')) ?>
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
                    'name' => '_parent',
                    'filter' => ActiveRecord::getListType(get_class($model)),
                    'value' => 'ActiveRecord::getTitleType(get_class($data),$data->_parent)',
                ),
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),
                array(
                    'name' => 'is_published',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => ActiveRecord::getIsPublishedTitleList(),
                    'type' => 'raw',
                    'value' => 'ActiveRecord::getIsPublishedTitle($data->is_published)',
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




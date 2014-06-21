<?php
$this->pageTitle = 'Планировка проекта "' . $model->title . '"';
$this->breadcrumbs = array(
    'Проекты' => array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('<span class="fa fa-arrow-left"></span> Перейти к списку проектов',
    Yii::app()->createUrl('/admin/project'), array('class' => 'btn btn-xs btn-two')) ?>

<?php echo CHtml::link('Добавить уровень','#',
    array('class' => 'btn btn-xs btn-two add_layout', 'data-title'=>$model->id)) ?>

<?php echo CHtml::link('<span class="fa fa-home"></span> Cвойства проекта', Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'project-image-grid',
            'dataProvider' => $layout,
            'template' => '{items} {pager}',
            //'filter' => $image,
            'columns' => array(
                array(
                    'name' => '_type',
                    'filter' => ActiveRecord::getListType('CatLayoutType'),
                    'value' => 'ActiveRecord::getTitleType("CatLayoutType",$data->_type)',
                ),
                array(
                    'name' => 'floor',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'value' => '($data->floor == null) ? "-" : $data->floor',
                ),
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),
                array(
                    'name' => 'tblCatLayoutOptions',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::projectSettings($data->_project,layoutOptions)'
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} &nbsp{delete}',
                )
            ),
        )); ?>
    </div>
    <!-- /.row (nested) -->
</div>

<?php $this->renderPartial('_layout_modal',array('layoutModel'=>$layoutModel,'model'=>$model))?>

<script>
    $('.add_layout').on('click', function() {
        $('#image-title-input').val($(this).attr('data-title'));
        $('#image-sort-input').val($(this).attr('data-sort'));
        $('#image-id-input').val($(this).attr('data-id'));
        $('#modal').modal('toggle');
    });

</script>

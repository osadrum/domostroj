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

<?php echo CHtml::link('Добавить элемент планировки','#',
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
                '_type',
                'floor',
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
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
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Название</h4>
            </div>
            <div class="modal-body" >
                <input type="text" name="title" id="image-title-input" value="">
                <input type="text" name="sort" id="image-sort-input" value="">
                <input type="hidden" name="title" id="image-id-input" value="">
                <a href="#" class="btn btn-success image-title-sent">Сохранить</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script>
    $('.add_layout').on('click', function() {
        $('#image-title-input').val($(this).attr('data-title'));
        $('#image-sort-input').val($(this).attr('data-sort'));
        $('#image-id-input').val($(this).attr('data-id'));
        $('#modal').modal('toggle');
    });

</script>

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

<?php echo CHtml::link('Добавить уровень',Yii::app()->createUrl("/admin/project/ajaxLayout"),
    array('class' => 'btn btn-xs btn-two add_layout', 'data-id'=>$model->id)) ?>

<?php echo CHtml::link('<span class="fa fa-home"></span> Cвойства проекта', Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'project-layout-grid',
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
                    'value' => 'Project::projectSetting($data->_project,layoutOptions,$data->id)'
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} &nbsp{delete}',
                    'buttons' => array(
                        'update' => array(
                            'label'=>'Редактировать уровень',
                            'url' => 'Yii::app()->createUrl("/admin/project/ajaxLayout/id/$data->id")',
                            'options' =>  array(
                                'class' => 'add_layout',
                                'data-id'=>'$data->_project')
                        ),
                        'delete' => array(
                            'label'=>'Удалить уровень',
                            'url' => 'Yii::app()->createUrl("/admin/project/layoutDelete/id/$data->id")',
                            'click'=>'function(){return confirm("Удалить уровень?");}'
                        )

                    )
                )
            ),
        )); ?>
    </div>
    <!-- /.row (nested) -->
</div>
    <?php $this->renderPartial('_layoutModal')?>
<script>
    $('.add_layout').on('click', function() {
        $('#modal').modal('toggle');
        $.ajax({
            url: $(this).attr('href'),
            data: {project_id:$(this).attr('data-id')},
            type: 'post',
            success: function(html) {
                $('.modal_layout_option').html(html);
            }
        });

        return false;
    });
    $('.layout_option').on('click', function() {
        $('#modal').modal('toggle');

        $.ajax({
            url: $(this).attr('href'),
            data: {layout_id:$(this).attr('data-layout-id')},
            type: 'post',
            success: function(html) {
                $('.modal_layout_option').html(html);
            }
        });

        return false;
    });

</script>

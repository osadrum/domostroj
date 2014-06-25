<?php
$this->pageTitle = 'Планировка проекта "' . $model->title . '"';
$this->breadcrumbs = array(
    'Проекты' => array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('<span class="fa fa-arrow-left"></span> Назад', Yii::app()->createUrl('/admin/project'),
    array('class' => 'btn btn-xs btn-three')) ?>

<?php echo CHtml::link('Добавить уровень',Yii::app()->createUrl("/admin/project/ajaxLayout"),
    array('class' => 'btn btn-xs btn-two add_layout', 'data-id'=>$model->id)) ?>

<?php echo CHtml::link('<span class="fa fa-home"></span> Cвойства проекта',
    Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)),
    array('class' => 'btn btn-xs btn-three')) ?>
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
                    'value' => 'ActiveRecord::getTitleType("CatLayoutType",$data->_type) . "  " .$data->floor',
                ),
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),
                array(
                    'name' => 'layoutOptions',
                    'htmlOptions' => array(
                        'style' => 'text-align: center; width:30%',
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::projectSetting($data->_project,layoutOptions,$data->id)'
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} &nbsp{delete}',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;width:7%',
                    ),
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
                $('.modal_option').html(html);
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
                $('.modal_option').html(html);
            }
        });

        return false;
    });

    $('.del_option').on('click', function() {
        if(confirm('Удалить помещение?')){
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxDelLayoutOption')?>',
                data: {option_id:$(this).attr('data-option-id'), layout_id:$(this).attr('data-layout-id')},
                type: 'post',
                success: function(html) {
                    if (html == 'ok') {
                        location.reload();
                    } else {
                        alert('При удалении произошла ошибка!');
                    }
                }
            });
        }
        return false;
    });

    $('.edit_option').on('click', function() {
        $('#modal').modal('toggle');
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxGradeConstruct')?>',
            data: {grade_id:$(this).attr('data-grade-id'), construct_id:$(this).attr('data-construct-id'), catConstructType:$(this).attr('data-constructType-id')},
            type: 'post',
            success: function(html) {
                $('.modal_option').html(html);
                $('.modal-dialog').animate({
                    'width':'800px'
                }, 200);
            }
        });

        return false;
    });

</script>

<?php
$this->pageTitle = 'Проекты';
$this->breadcrumbs=array(
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('Добавить проект', Yii::app()->createUrl('/admin/project/create'), array('class' => 'btn btn-xs btn-two')) ?>

<?php echo CHtml::link('Категории проектов', Yii::app()->createUrl('/admin/projectCategory'), array('class' => 'btn btn-xs btn-three')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'project-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                'title',
                array(
                    'name' => '_category',
                    'filter' => ActiveRecord::getListType('ProjectCategory'),
                    'value' => 'ActiveRecord::getTitleType("ProjectCategory",$data->_category)',
                ),
                /*array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),*/
                array(
                    'name' => 'countImages',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'html',
                    'value' => 'Project::hasOption($data,"image")'
                ),
                array(
                    'name' => 'layouts',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::hasOption($data,"layout")'
                ),
                array(
                    'name' => 'grades',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::hasOption($data,"grade")'
                ),
                array(
                    'name' => 'projectOption',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::hasOption($data,"projectOption")'
                ),
                array(
                    'name' => 'is_published',
                    'filter' => ActiveRecord::getIsPublishedTitleList(),
                    'value' => 'ActiveRecord::getIsPublishedTitle($data->is_published)',
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
<script>
    $('.project_option').on('click', function() {
        $('#modal').modal('toggle');

        $.ajax({
            url: $(this).attr('href'),
            data: {project_id:$(this).attr('data-project-id')},
            type: 'post',
            success: function(html) {
                $('.modal_option').html(html);
            }
        });

        return false;
    });

</script>




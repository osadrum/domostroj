<?php
$this->pageTitle = 'Комплектация проекта';
$this->breadcrumbs = array(
    'Проекты' => array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<?php echo CHtml::link('<span class="fa fa-arrow-left"></span> Назад',
    Yii::app()->createUrl('/admin/project'), array('class' => 'btn btn-xs btn-three')) ?>

<?php echo CHtml::link('Добавить комплектацию',Yii::app()->createUrl("/admin/project/ajaxGrade"),
    array('class' => 'btn btn-xs btn-two add_grade', 'data-id'=>$model->id)) ?>

<?php echo CHtml::link('<span class="fa fa-home"></span> свойства проекта',
    Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)),
    array('class' => 'btn btn-xs btn-three')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'grade-grid',
            'dataProvider' => $grade,
            'template' => '{items} {pager}',
            //'filter' => $grade,
            'columns' => array(
                array(
                    'name' => '_type',
                    'filter' => ActiveRecord::getListType('CatGradeType'),
                    'value' => 'ActiveRecord::getTitleType("CatGradeType",$data->_type)',
                ),
                'price',
                array(
                    'name' => 'gradeConstructs',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;width:25%',
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'Project::projectSetting($data->_project,gradeConstructs,null,$data->id)'
                ),
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} &nbsp{delete}',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;width:10%',
                    ),
                    'buttons' => array(
                        'update' => array(
                            'label'=>'Редактировать комплектацию',
                            'url' => 'Yii::app()->createUrl("/admin/project/ajaxGrade/id/$data->id")',
                            'options' =>  array(
                                'class' => 'add_grade',
                                'data-id'=>'$data->_project')
                        ),
                        'delete' => array(
                            'label'=>'Удалить комплектацию',
                            'url' => 'Yii::app()->createUrl("/admin/project/gradeDelete/id/$data->id")',
                            'click'=>'function(){return confirm("Удалить комплектацию?");}'
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
    $('.add_grade').on('click', function() {
        $('#modal').modal('toggle');
        $('.modal-dialog').animate({
            'width':'400px'
        }, 200);
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
    $('.grade_construct').on('click', function() {
        $('#modal').modal('toggle');

        $.ajax({
            url: $(this).attr('href'),
            data: {grade_id:$(this).attr('data-grade-id')},
            type: 'post',
            success: function(html) {
                $('.modal_option').html(html);
                $('.modal-dialog').animate({
                    'width':'400px'
                }, 200);
            }
        });

        return false;
    });

    $('.del_construct').on('click', function() {
        if(confirm('Удалить конструктив?')){
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxDelGradeConstruct')?>',
                data: {grade_id:$(this).attr('data-grade-id'), construct_id:$(this).attr('data-construct-id')},
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

    $('.edit_construct').on('click', function() {
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




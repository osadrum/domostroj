<?php
$this->pageTitle = 'Редактирование "' . $model->title . '"';
$this->breadcrumbs=array(
    'Проекты'=>array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Редактирование "<?php echo $model->title ?>"
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cog"></i> Основные параметры
                                </div>
                                <div class="panel-body">
                                    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <i class="fa fa-picture-o"></i> Дополнителные изображения
                                </div>
                                <div class="panel-body">
                                    <?php echo Project::projectSetting($model->id,'image') ?>
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php $this->widget('bootstrap.widgets.TbListView', array(
                                                'id' => 'listProjectImage',
                                                'dataProvider' => $projectImage,
                                                'template' => '{items}{pager}',
                                                'emptyText' => 'В альбоме нет фотографий.',
                                                'summaryText' => "{start}&mdash;{end} из {count}",
                                                'itemView' => '_projectImages',
                                                'pager' => array(
                                                    'class' => 'bootstrap.widgets.TbPager',
                                                    'header' => false,
                                                    'maxButtonCount' => 5,
                                                ),
                                            )); ?>
                                           <?php $this->widget('application.extensions.fancybox.EFancyBox', array(
                                            'target' => '.fancybox',
                                            'config' => array(),
                                            ));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-sitemap"></i> Планировка
                                </div>
                                <div class="panel-body">
                                    <?php echo CHtml::link('Добавить уровень',Yii::app()->createUrl("/admin/project/ajaxLayout"),
                                        array('class' => 'btn btn-xs btn-two add_layout', 'data-id'=>$model->id)) ?>                                    <div class="panel-body">
                                        <div class="row">
                                            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                                                'id' => 'project-layout-grid',
                                                'dataProvider' => $projectLayout,
                                                'template' => '{items} {pager}',
                                                //'filter' => $image,
                                                'columns' => array(
                                                    array(
                                                        'name' => '_type',
                                                        'headerHtmlOptions'=>array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'htmlOptions' => array(
                                                            'style' => 'text-align: center; width:20%',
                                                        ),
                                                        'filter' => ActiveRecord::getListType('CatLayoutType'),
                                                        'value' => 'ActiveRecord::getTitleType("CatLayoutType",$data->_type) . "  " .$data->floor',
                                                    ),
                                                   /* array(
                                                        'name' => 'image',
                                                        'type' => 'raw',
                                                        'filter' => '',
                                                        'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                                                    ),*/
                                                    array(
                                                        'name' => 'layoutOptions',
                                                        'headerHtmlOptions'=>array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'htmlOptions' => array(
                                                            'style' => 'text-align: center; width:40%',
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
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bars"></i> Комплектация
                                </div>
                                <div class="panel-body">
                                    <?php echo CHtml::link('Добавить комплектацию',Yii::app()->createUrl("/admin/project/ajaxGrade"),
                                        array('class' => 'btn btn-xs btn-two add_grade', 'data-id'=>$model->id)) ?>                                    <div class="panel-body">
                                        <div class="row">
                                            <?php $this->widget('bootstrap.widgets.TbGridView', array(
                                                'id' => 'grade-grid',
                                                'dataProvider' => $projectGrade,
                                                'template' => '{items} {pager}',
                                                //'filter' => $grade,
                                                'columns' => array(
                                                    array(
                                                        'name' => '_type',
                                                        'headerHtmlOptions'=>array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'htmlOptions' => array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'filter' => ActiveRecord::getListType('CatGradeType'),
                                                        'value' => 'ActiveRecord::getTitleType("CatGradeType",$data->_type)',
                                                    ),
                                                    array(
                                                        'name' => 'price',
                                                        'headerHtmlOptions'=>array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'htmlOptions' => array(
                                                            'style' => 'text-align: center;',
                                                        ),
                                                        'filter' => '',
                                                        'value' => '$data->price',
                                                    ),
                                                    array(
                                                        'name' => 'gradeConstructs',
                                                        'headerHtmlOptions'=>array(
                                                            'style' => 'text-align: center;',
                                                        ),
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
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-cogs"></i> Параметры проекта
                                </div>
                                <div class="panel-body">
                                    <?php echo Project::projectSetting($model->id,'projectOption',null,null,'Редактировать') ?>
                                    <div class="panel-body">
                                        <div class="row">
                                            <table class="table table-bordered">
                                                <thead style="font-weight:bold;text-align: center"><td>Параметр</td><td>Значение</td></thead>
                                                <?php foreach($projectOption as $option) {
                                                    echo '<tr>';
                                                    echo '<td style="text-align: center">'. $option->optionTitle->title .' </td>';
                                                    echo '<td style="text-align: center">'. $option->value .' </td>';
                                                    echo '<tr>';
                                                }?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        <!-- /.panel -->
        <!-- /.col-lg-12 -->
    </div>
<?php $this->renderPartial('_projectModal')?>

<script>
    $('.add_layout').on('click', function() {
        $('.modal_option').html('');
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
        $('.modal_option').html('');
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
                data: {id:$(this).attr('data-id')},
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
        $('.modal_option').html('');
        $('#modal').modal('toggle');
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxLayoutOption')?>',
            data: {id:$(this).attr('data-id'),layout_id:$(this).attr('data-layout-id'), option_id:$(this).attr('data-option-id')},
            type: 'post',
            success: function(html) {
                $('.modal_option').html(html);
            }
        });

        return false;
    });
    $('.project_option').on('click', function() {
        $('.modal_option').html('');
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


    $('.add_grade').on('click', function() {
        $('.modal_option').html('');
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
        $('.modal_option').html('');
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
        $('.modal_option').html('');
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

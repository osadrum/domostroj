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
        <?php echo CHtml::link('<span class="fa fa-arrow-left"></span> перейти к списку проектов', Yii::app()->createUrl('/admin/project'), array('class' => 'btn btn-xs btn-two')) ?>
        <?php echo CHtml::link('<span class="fa fa-picture-o"></span> Доп. изображения', Yii::app()->createUrl('/admin/project/photo', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
        <?php echo CHtml::link('<span class="fa fa-sitemap"></span> Планировка', Yii::app()->createUrl('/admin/project/layout', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
        <?php echo CHtml::link('<span class="fa fa-bars"></span> Комплектация', Yii::app()->createUrl('/admin/project/grade', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
    </div>
</div>
<div class="panel-body">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Редактирование "<?php echo $model->title ?>"
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <!-- /.col-lg-12 -->
    </div>
</div>
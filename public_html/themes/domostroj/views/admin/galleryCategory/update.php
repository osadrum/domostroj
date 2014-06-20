<?php
$this->pageTitle = 'Редактирование "' . $model->title . '"';
$this->breadcrumbs=array(
    'Список альбомов'=>array('admin'),
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-picture-o"></i> ';
?>
<div class="row">
    <div class="col-lg-12">
        <?php echo CHtml::link('<span class="fa fa-arrow-left"></span> перейти к списку альбомов', Yii::app()->createUrl('/admin/galleryCategory'), array('class' => 'btn btn-xs btn-two')) ?>
        <?php if (!GalleryCategory::issetChildren($model->id)) : ?>
            <?php echo CHtml::link('<span class="fa fa-picture-o"></span> Фотографии', Yii::app()->createUrl('/admin/galleryCategory/view', array('id' => $model->id)), array('class' => 'btn btn-xs btn-two')) ?>
        <?php endif; ?>
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
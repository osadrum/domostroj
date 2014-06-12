<?php
$this->pageTitle = 'Редактирование альбома';
$this->pageIcon = '<i class="fa fa-picture-o"></i> ';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <?php echo CHtml::link('<span class="fa fa-arrow-left"></span> перейти к списку альбомов', Yii::app()->createUrl('/admin/galleryCategory'), array('class'=>'btn btn-primary btn-xs')) ?>
            <?php if (!GalleryCategory::issetChildren($model->id)) : ?>
                <?php echo CHtml::link('<span class="fa fa-picture-o"></span> Фотографии', Yii::app()->createUrl('/admin/galleryCategory/view', array('id'=>$model->id)), array('class'=>'btn btn-primary btn-xs')) ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Редактирование альбома
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

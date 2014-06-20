<?php
$this->pageTitle = 'Панель управления';
$this->pageIcon = '<i class="fa fa-desctop"></i> ';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-home"></i>', Yii::app()->createUrl('/admin/project')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-picture-o"></i>', Yii::app()->createUrl('/admin/galleryCategory')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-file-o"></i>', Yii::app()->createUrl('/admin/pages')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-book"></i>', Yii::app()->createUrl('/admin/catalog')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-cogs"></i>', Yii::app()->createUrl('/admin/settings')) ?>
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
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script>
    $('.btn-quick').on('click', function () {
        location.href = $(this).attr('data-link');
    });
</script>
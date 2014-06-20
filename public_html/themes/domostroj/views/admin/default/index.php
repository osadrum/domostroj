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
                        <div class="col-lg-3">
                            <div class="w-box w-box-inverse">
                                <div class="thmb-img">
                                    <button type="button" class="btn btn-default btn-circle btn-xl btn-quick"
                                            data-toggle="tooltip" data-placement="bottom" title=""
                                            data-original-title="Проекты"
                                            data-link="<?php echo Yii::app()->createUrl('/admin/project') ?>"><i
                                            class="fa fa-home"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="w-box w-box-inverse">
                                <div class="thmb-img">
                                    <button type="button" class="btn btn-default btn-circle btn-xl btn-quick"
                                            data-toggle="tooltip"
                                            data-placement="bottom" title="" data-original-title="Галерея"
                                            data-link="<?php echo Yii::app()->createUrl('admin/galleryCategory') ?>"><i
                                            class="fa fa-picture-o"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="w-box w-box-inverse">
                                <div class="thmb-img">
                                    <button type="button" class="btn btn-default btn-circle btn-xl btn-quick"
                                            data-toggle="tooltip" data-placement="bottom" title=""
                                            data-original-title="Страницы"
                                            data-link="<?php echo Yii::app()->createUrl('/admin/pages') ?>"><i
                                            class="fa fa-file-o"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="w-box w-box-inverse">
                                <div class="thmb-img">
                                    <button type="button" class="btn btn-default btn-circle btn-xl btn-quick"
                                            data-toggle="tooltip"
                                            data-placement="bottom" title="" data-original-title="Справочники"
                                            data-link="<?php echo Yii::app()->createUrl('/admin/catalog') ?>"><i
                                            class="fa fa-book"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="w-box w-box-inverse">
                                <div class="thmb-img">
                                    <button type="button" class="btn btn-default btn-circle btn-xl btn-quick"
                                            data-toggle="tooltip"
                                            data-placement="bottom" title="" data-original-title="Настройки"
                                            data-link="<?php echo Yii::app()->createUrl('/admin/settings') ?>"><i
                                            class="fa fa-cogs"></i></button>
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
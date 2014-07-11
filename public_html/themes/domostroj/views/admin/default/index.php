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
                                    <?= CHtml::link('<i class="fa fa-desktop"></i>', Yii::app()->createUrl('/admin/slider')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="w-box inverse">
                                <div class="thmb-img">
                                    <?= CHtml::link('<i class="fa fa-comments-o"></i>', Yii::app()->createUrl('/admin/review')) ?>
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
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                СМС
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>Текущий баланс:</td>
                        <td><?php echo Sms::getBalance(); ?> <a href="http://sms.ru/pay.php">пополнить</a></td>
                    </tr>
                    <tr>
                        <td>Где используется</td>
                        <td><?php
                            $smsUsage = Sms::getUsageSms();
                            if (!empty($smsUsage)) {
                                echo implode('<br>',$smsUsage);
                            } else {
                                echo 'Функция не используется';
                            } ?></td>
                    </tr>
                </table>
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
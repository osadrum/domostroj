<?php
$this->pageTitle = 'Создание отзыва';
$this->breadcrumbs=array(
    'Отзывы'=>array('admin'),
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-comments-o"></i> ';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Создание отзыва
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

<?php
$this->pageTitle = 'Создание вида конструктивов';
$this->breadcrumbs=array(
    'Справочник конструктива'=>array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Создание вида конструктивов
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

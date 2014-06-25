<?php
$this->pageTitle = 'Редактирование "' . ActiveRecord::getTitleType("CatConstructType",$model->_type) . '"';
$this->breadcrumbs=array(
    'Справочник видов конструктивов'=>array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Редактирование "<?php echo ActiveRecord::getTitleType("CatConstructType",$model->_type) ?>"
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

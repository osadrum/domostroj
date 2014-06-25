<?php
$this->pageTitle = 'Справочник конструктивов';
$this->breadcrumbs=array(
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-book"></i> ';
?>
<?php echo CHtml::link('Добавить конструктив', Yii::app()->createUrl('/admin/catConstruct/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'news-category-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => '_type',
                    'filter' => ActiveRecord::getListType('CatConstructType'),
                    'value' => 'ActiveRecord::getTitleType("CatConstructType",$data->_type)',
                ),
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),

                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 10%;text-align:center;vertical-align:middle'),
                    'template' => '{update} &nbsp{delete}',
                )
            ),
        )); ?>
    </div>
    <!-- /.row (nested) -->
</div>
<!-- /.panel-body -->




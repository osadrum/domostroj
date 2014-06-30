<?php
$this->pageTitle = 'Отзывы';
$this->breadcrumbs=array(
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-comments-o"></i> ';
?>
<?php echo CHtml::link('Добавить отзыв', Yii::app()->createUrl('/admin/review/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'slider-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                'title',
                array(
                    'name' => 'image',
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),

                array(
                    'name' => 'is_published',
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => ActiveRecord::getIsPublishedTitleList(),
                    'type' => 'raw',
                    'value' => 'ActiveRecord::getIsPublishedTitle($data->is_published)',
                ),
                array(
                    'name' => 'document',
                    'type' => 'raw',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 7%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'value' => 'Review::getReviewDocLink($data)',
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



<?php
$this->pageTitle = 'Наши работы';
$this->breadcrumbs=array(
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-picture-o"></i> ';
?>
<?php echo CHtml::link('Добавить альбом', Yii::app()->createUrl('/admin/galleryCategory/create'), array('class' => 'btn btn-xs btn-two')) ?>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'news-category-grid',
            'dataProvider' => $model->search(),
            'template' => '{items} {pager}',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'title',

                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 70%'
                    ),
                    'value' => '$data->title',
                ),
               /* array(
                    'name' => 'image',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 10%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'type' => 'raw',
                    'filter' => '',
                    'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                ),*/
              /*  array(
                    'name' => '_parent',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 45%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => GalleryCategory::getCategoryList(),
                    'value' => 'GalleryCategory::getCategoryTitleById($data->_parent)',
                ),*/
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
                    'name' => 'countImages',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 10%'
                    ),
                    'htmlOptions' => array(
                        'style' => 'text-align: center;'
                    ),
                    'filter' => '',
                    'type' => 'raw',
                    'value' => 'GalleryCategory::isFolderOrAlbum($data->id)'
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




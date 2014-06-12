
<?php
$this->pageTitle = 'Список альбомов';
$this->pageIcon = '<i class="fa fa-picture-o"></i> ';

?>


<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo CHtml::link('Добавить альбом', Yii::app()->createUrl('/admin/galleryCategory/create'), array('class'=>'btn btn-primary btn-xs')) ?>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php $this->widget('bootstrap.widgets.TbGridView',array(
                'id'=>'news-category-grid',
                'dataProvider'=>$model->search(),
                'template' => '{items} {pager}',
                'filter'=>$model,
                'columns'=>array(
                    array(
                        'name' => 'title',

                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center;width: 70%'
                        ),
                        'value' => '$data->title',
                    ),
                    array(
                        'name' => 'image',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center;width: 10%'
                        ),
                        'htmlOptions'=>array(
                            'style' => 'text-align: center;'
                        ),
                        'type' => 'raw',
                        'filter' => '',
                        'value' => 'CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$data->image, "", array("style"=>"max-width: 150px"))',
                    ),
                    array(
                        'name' => '_parent',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center;width: 45%'
                        ),
                        'htmlOptions'=>array(
                            'style' => 'text-align: center;'
                        ),
                        'filter' => GalleryCategory::getCategoryList(),
                        'value' => 'GalleryCategory::getCategoryTitleById($data->_parent)',
                    ),
                    array(
                        'name' => 'is_published',
                        'filter' => GalleryCategory::getIsPublishedTitleList(),
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center;width: 20%'
                        ),
                        'htmlOptions'=>array(
                            'style' => 'text-align: center;'
                        ),
                        'value' => 'ActiveRecord::getIsPublishedTitle($data->is_published)',
                    ),
                    array(
                        'name' => 'countImages',
                        'headerHtmlOptions' => array(
                            'style' => 'text-align: center;width: 10%'
                        ),
                        'htmlOptions'=>array(
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
</div>




<div class="row">
    <?php $this->widget('ext.widgets.ProjectsListView', array(
    'dataProvider'=>$catalog,
    'itemView'=>'_view', // представление для одной записи
    'ajaxUpdate'=>true, // отключаем ajax поведение
    'emptyText'=> Yii::t('catalog', 'В данной категории нет проектов'),
    //'summaryText'=>"{start}&mdash;{end} из {count}",
    'template'=>'{items} <hr> {pager}',
    'htmlOptions' => array('class'=>'category'),
    'pager'=>array(
        'class'=>'CLinkPager',
        'header'=>false,
        'firstPageLabel' => '<<',
        'nextPageLabel' => '>',
        'prevPageLabel' => '<',
        'lastPageLabel' => '>>',
        'selectedPageCssClass' => 'active',
        //'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
        'htmlOptions'=>array('class'=>'pagination clr'),
    ),
)); ?>
</div>
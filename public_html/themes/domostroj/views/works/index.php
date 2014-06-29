<?php
$this->pageTitle = 'Наши проекты';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<div class="row">
    <div id="ulSorList">
        <?php $this->widget('bootstrap.widgets.TbListView', array(
            'id' => 'listProjects',
            'dataProvider'=>$works,
            'itemView'=>'_view', // представление для одной записи
            'ajaxUpdate'=>true, // отключаем ajax поведение
            'emptyText'=> Yii::t('gallery', 'В данном альбоме не работ нет проектов'),
            //'summaryText'=>"{start}&mdash;{end} из {count}",
            'template'=>'{items}{pager}',
            //'cssFile' => $this->getAssetsUrl().'/css/list-styles.css',
            'pagerCssClass' => 'pager clr',
           // 'htmlOptions' => array('class'=>'category'),
            'pager'=>array(
                'class'=>'CLinkPager',
                'header'=>false,
                'firstPageLabel' => '<<',
                'nextPageLabel' => '>',
                'prevPageLabel' => '<',
                'lastPageLabel' => '>>',
                'selectedPageCssClass' => 'active',
                //'cssFile'=>'/css/pager.css', // устанавливаем свой .css файл
                'htmlOptions'=>array('class'=>'pagination '),
            ),
        )); ?>
    </div>
</div>
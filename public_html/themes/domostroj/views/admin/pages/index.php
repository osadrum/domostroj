<?php
$this->pageTitle = 'Статические страницы';
$this->pageIcon = '<i class="fa fa-file-o"></i> ';
$this->breadcrumbs = array(
    $this->pageTitle,
);
Yii::app()->clientScript->registerCssFile('/libs/treetable/jquery.treeTable.css');
Yii::app()->clientScript->registerScriptFile('/libs/treetable/jquery.treeTable.js');
Yii::app()->clientScript->registerScript('treetable', "
$('.table').treeTable({
	expandable: true,
	initialState: 'expanded'
});
");
?>

<div class="btn-toolbar">
    <?php echo CHtml::link('Добавить страницу', array('create'), array('class' => 'btn btn-xs btn-two')) ?>
</div>
<div class="panel-body">
    <div class="row">
        <?php $this->widget('TbGridViewTree', array(
            'id' => 'page-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'template' => '{items} {pager}',
            'afterAjaxUpdate' => "js:function() {
$('.table').treeTable({
	expandable: true,
	initialState: 'expanded'
});
}",
            'columns' => array(
                array(
                    'name' => 'id',
                    'headerHtmlOptions' => array(
                        'width' => 50,
                    ),
                ),
                array(
                    'name' => 'page_title',
                ),
                array(
                    'name' => 'slug',
                    'headerHtmlOptions' => array(
                        'width' => 200,
                    ),
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
               /* array(
                    'class' => 'ext.jtogglecolumn.JToggleColumn',
                    'name' => 'is_published',
                    'filter' => array('0' => 'Нет', '1' => 'Да'),
                    'checkedButtonLabel' => 'Снять с публикации',
                    'uncheckedButtonLabel' => 'Опубликовать',
                    'headerHtmlOptions' => array('width' => 100),
                    'htmlOptions' => array('style' => 'text-align: center;'),
                ),*/
                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'template' => '{update} {delete}',
                ),
            ),
        )) ?>
    </div>
</div>
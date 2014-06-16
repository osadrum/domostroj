<?php
$this->pageTitle = Yii::t('settings', 'Управление настройками');
$this->pageIcon = '<i class="fa fa-cogs"></i> ';
?>
<div class="col-lg-12">
    <div class="row">
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'news-grid',
            'dataProvider' => $settings->search(),
            'template' => '{items} {pager}',
            'filter' => $settings,
            'columns' => array(
                array(
                    'name' => 'section',
                    'filter' => Settings::getSectionsList(),
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 30%'
                    ),
                    'value' => '$data->section',
                ),
                array(
                    'name' => 'title',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width:30%'
                    ),
                    'filter' => '',
                    'value' => '$data->title',
                ),
                array(
                    'name' => 'value',
                    'filter' => '',
                    'headerHtmlOptions' => array(
                        'style' => 'text-align: center;width: 30%'
                    ),
                    'value' => 'substr($data->value, 0, 70)',
                ),

                array(
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 10%;text-align:center;vertical-align:middle'),
                    'template' => '{update}',
                )
            ),
        )); ?>
    </div>
</div>


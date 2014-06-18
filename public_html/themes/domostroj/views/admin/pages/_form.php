<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'page-form',
    'inlineErrors' => false,
    'type' => 'horizontal',
)) ?>

<?= $form->errorSummary($model) ?>
<div class="form-group">

    <? $this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs',
        'tabs' => array(
            array(
                'label' => 'Страница',
                'content' => $this->renderPartial('_content', array('form' => $form, 'model' => $model), true),
                'active' => true
            ),
            array(
                'label' => 'SEO',
                'content' => $this->renderPartial('_seo', array('form' => $form, 'model' => $model), true),
            ),
        ),
    )) ?>
</div>
<div class="form-group">
    <? $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
    )) ?>
</div>

<? $this->endWidget() ?>

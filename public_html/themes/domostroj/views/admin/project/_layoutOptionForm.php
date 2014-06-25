<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'layout-option-form',
    'enableAjaxValidation' => false,
    'action' => array('layoutOptionSave')
)); ?>
<div class="form-group">

    <?php echo CHtml::hiddenField('layout_id', $layout_id); ?>
    <?php if (!empty($layoutOptionModel)) :?>
        <?php echo CHtml::hiddenField('id', $layoutOptionModel->id); ?>
    <?php endif;?>
    <?php echo CHtml::dropDownList('option_id',$layoutOptionModel->_option,
        ActiveRecord::getListType('CatLayoutOption'),
        array('id'=>'option_id','class'=>'form-control'))?>
</div>
<div class="form-group">
    <?php echo CHtml::textField('value',$layoutOptionModel->value,array('class'=>'form-control'));?>
</div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Сохранить',
        )); ?>
    </div>
<?php $this->endWidget(); ?>


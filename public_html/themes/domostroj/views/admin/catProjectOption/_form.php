<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cat-project-option-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="form-group">
    <?php echo $form->labelEx($model,'title',array()) ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'title'); ?>
</div><!-- /.form-group -->

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>

<?php $this->endWidget(); ?>

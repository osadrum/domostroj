<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'grade-form',
    'enableAjaxValidation' => false,
    'action' => array('project/gradeSave/id/' . $gradeModel->id)

)); ?>

<div class="form-group">
    <?php echo $form->labelEx($gradeModel, '_type', array()) ?>
    <?php echo $form->dropDownList($gradeModel, '_type', ActiveRecord::getListType('CatGradeType'), array('class' => 'form-control')); ?>
    <?php echo $form->error($gradeModel, '_type'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($gradeModel, 'price', array()) ?>
    <?php echo $form->textField($gradeModel, 'price', array('class' => 'form-control')); ?>
    <?php echo $form->error($gradeModel, 'price'); ?>
</div>

<div class="form-group">
    <?php echo $form->hiddenField($model, 'id', array('class' => 'form-control')); ?>
</div>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $gradeModel->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>

<?php $this->endWidget(); ?>

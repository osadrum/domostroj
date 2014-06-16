<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle='Авторизация';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
    <div class="w-section inverse">
        <div class="w-box sign-in-wr bg-5">

            <div class="form-header">
                <h2>Авторизация</h2>
            </div>
            <div class="form-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
                )); ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model,'username'); ?>
                    <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'username'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                        <?php echo $form->label($model,'rememberMe'); ?>
                        <?php echo $form->error($model,'rememberMe'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo CHtml::submitButton('Вход',array('class'=>'btn btn-two pull-right')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>
            </div><!-- form -->
        </div>
    </div>
</div>



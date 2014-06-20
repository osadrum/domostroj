<?php
$this->pageTitle = 'Редактирование "' .$model->title . '"' ;
$this->breadcrumbs=array(
    'Управление настройками' => array('index'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-cogs"></i>';
?>
<div class="col-lg-12">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Редактирование "<?php echo $model->title ?>"
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'news-form',
                            'enableAjaxValidation' => false,
                        )); ?>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'value', array()) ?>
                            <?php if ($model->type == 'text-redactor') : ?>
                                <?php $this->widget('application.extensions.ckeditor2.TheCKEditorWidget', array(
                                    'model' => $model, # Data-Model (form model)
                                    'attribute' => 'value', # Attribute in the Data-Model
                                    'height' => '200px',
                                    'width' => '100%',
                                    'config' => array(
                                        'filebrowserUploadUrl' => Yii::app()->createUrl('/admin/default/imgUpload'),
                                    ),
                                    'toolbarSet' => array(
                                        array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
                                        array('TextColor', 'BGColor'),
                                        array('Image', 'Youtube', 'Link', 'Unlink', 'Maximize', 'ShowBlocks'),
                                        array('Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo')
                                    ), # EXISTING(!) Toolbar (see: ckeditor.js)
                                    'ckeditor' => Yii::app()->basePath . '/../ckeditor/ckeditor.php',
                                    # Path to ckeditor.php
                                    'ckBasePath' => Yii::app()->baseUrl . '/ckeditor/',
                                    # Relative Path to the Editor (from Web-Root)
                                    'css' => Yii::app()->baseUrl . '/css/index.css',
                                    # Additional Parameters
                                )); ?>
                            <?php elseif ($model->type == 'text') : ?>
                                <?php echo $form->textField($model, 'value', array('class' => 'form-control')); ?>

                            <?php
                            elseif ($model->type == 'bool') : ?>
                                <?php echo $form->dropDownList($model, 'value', array(1 => 'Да', 0 => 'Нет'), array('class' => 'form-control')); ?>
                            <?php endif; ?>
                            <?php echo $form->error($model, 'value'); ?>

                        </div>
                        <!-- /.form-group -->


                        <div class="form-actions">
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'buttonType' => 'submit',
                                'type' => 'primary',
                                'label' => 'Сохранить',
                            )); ?>
                        </div>

                        <?php $this->endWidget(); ?>

                    </div>

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

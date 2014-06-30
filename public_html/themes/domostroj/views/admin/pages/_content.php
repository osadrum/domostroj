<?php
Yii::app()->clientScript->registerScriptFile('/libs/redactorjs/ru.js');
Yii::app()->clientScript->registerScriptFile('/libs/django-urlify/urlify.js');
Yii::app()->clientScript->registerScript('translit', "
$('#translit-btn').click(function() {
	$('#Page_slug').val(URLify($('#Page_page_title').val()));
});
");
?>

<?php echo $form->dropDownListRow($model, 'parent_id', $model->selectMainList(), array('class' => 'form-control', 'empty' => '')) ?>

<?php echo $form->textFieldRow($model, 'page_title', array('class' => 'form-control', 'maxlength' => 255)) ?>

<div class="control-group">
    <?= $form->labelEx($model, 'slug', array('class' => 'control-label', 'label' => 'Псевдоним')) ?>
    <div class="controls">
        <div class="input-append">
            <?= $form->textField($model, 'slug', array('class' => 'form-control', 'maxlength' => 127)) ?>
            <button class="btn btn-xs btn-two" type="button" id="translit-btn">Транслит</button>
        </div>
    </div>
</div>

<?php echo $form->checkBoxRow($model, 'is_published') ?>
<?php echo $form->checkBoxRow($model, 'is_showed_menu') ?>

<?php echo
$form->dropDownListRow($model, 'layout', array(
    'column1' => 'Одна колонка',
    'column2' => 'Две колонки',
), array('empty' => 'По умолчанию', 'class' => 'form-control')) ?>

<div class="control-group">
    <?php echo $form->labelEx($model, 'content', array('class' => 'control-label')) ?>


    <div class="controls">
        <?php $this->widget('application.extensions.ckeditor2.TheCKEditorWidget', array(
            'model' => $model, # Data-Model (form model)
            'attribute' => 'content', # Attribute in the Data-Model
            'height' => '200px',
            'width' => '100%',
            'config' => array(
                'filebrowserUploadUrl' => Yii::app()->createUrl('/admin/default/imgUpload'),
            ),
            'toolbarSet' => Yii::app()->params['CKEditorTool'], # EXISTING(!) Toolbar (see: ckeditor.js)
            'ckeditor' => Yii::app()->basePath . '/../ckeditor/ckeditor.php',
            # Path to ckeditor.php
            'ckBasePath' => Yii::app()->baseUrl . '/ckeditor/',
            # Relative Path to the Editor (from Web-Root)
            'css' => Yii::app()->baseUrl . '/css/index.css',
            # Additional Parameters
        )); ?>
    </div>
</div>
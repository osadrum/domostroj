<?
Yii::app()->clientScript->registerScriptFile('/libs/redactorjs/ru.js');
Yii::app()->clientScript->registerScriptFile('/libs/django-urlify/urlify.js');
Yii::app()->clientScript->registerScript('translit', "
$('#translit-btn').click(function() {
	$('#Page_slug').val(URLify($('#Page_page_title').val()));
});
");
?>

<?= $form->dropDownListRow($model, 'parent_id', $model->selectList(), array('class' => 'span6', 'empty' => '')) ?>

<?= $form->textFieldRow($model, 'page_title', array('class' => 'span6', 'maxlength' => 255)) ?>

<div class="control-group">
	<?= $form->labelEx($model, 'slug', array('class' => 'control-label', 'label' => 'Псевдоним')) ?>
	<div class="controls">
		<div class="input-append">
			<?= $form->textField($model, 'slug', array('class' => 'span5', 'maxlength' => 127)) ?><button class="btn" type="button" id="translit-btn">Транслит</button>
		</div>
	</div>
</div>

<?= $form->checkBoxRow($model, 'is_published') ?>

<?= $form->dropDownListRow($model, 'layout', array(
	'column1' => 'Одна колонка',
	'column2' => 'Две колонки',
), array('empty' => 'По умолчанию', 'class' => 'span3')) ?>

<div class="control-group">
	<?= $form->labelEx($model, 'content', array('class' => 'control-label')) ?>
	<div class="controls">
		<? $this->widget('ext.imperavi-redactor.ImperaviRedactorWidget', array(
			'model' => $model,
			'attribute' => 'content',
			'options' => array(
				'lang' => 'ru',
			),
		)) ?>
	</div>
</div>
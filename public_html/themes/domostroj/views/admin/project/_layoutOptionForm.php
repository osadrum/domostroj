<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'layout-option-form',
    'enableAjaxValidation' => false,
    'action' => array('layoutOptionSave')
)); ?>
<div class="form-group">

    <?php echo CHtml::hiddenField('layout_id', $layout_id); ?>
    <table class="table table-bordered">
        <?php foreach($catLayoutOption as $cat) {
            $checked = false;
            if (array_key_exists($cat->id, $layoutOptionModel)) {
                $checked = true;
            }
            echo '<tr>';
            echo '<td>'.CHtml::checkBox('Layout[option]['.$cat->id.']', $checked) .'  '.$cat->title.' </td>';
            echo '<td>'.CHtml::textField('Layout[value]['.$cat->id.']', $layoutOptionModel[$cat->id]);
            echo '  кв.м.</td>';
            echo '<tr>';
        }

        ?>
    </table>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => 'Сохранить',
        )); ?>
    </div>
<?php $this->endWidget(); ?>


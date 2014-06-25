<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'project-option-form',
    'enableAjaxValidation' => false,
    'action' => array('projectOptionSave')
)); ?>
<div class="form-group">

    <?php echo CHtml::hiddenField('project_id', $project_id); ?>
    <table class="table table-bordered">
        <?php foreach($catProjectOption as $cat) {
            $checked = false;
            if (array_key_exists($cat->id, $projectOptionModel)) {
                $checked = true;
            }
            if (!empty($projectOptionModel)){
                $value = $projectOptionModel[$cat->id];
            } else {
                $value = '';
            }
            echo '<tr>';
            echo '<td>'.CHtml::checkBox('Project[option]['.$cat->id.']', $checked) .'  '.$cat->title.' </td>';
            echo '<td>'.CHtml::textField('Project[value]['.$cat->id.']', $value);
            echo '</td>';
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


<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'grade-construct-form',
    'enableAjaxValidation' => false,
)); ?>
<div class="form-group">

    <?php echo CHtml::hiddenField('grade_id', $grade_id); ?>
    <?php echo CHtml::dropDownList('catConstructType','',
        GradeConstruct::getListConstruct($grade_id),
        array('id'=>'catConstructType','class'=>'form-control'))?>
</div>

<div class="form-actions">
    <?php echo CHtml::submitButton('Далее',array('class'=>'btn btn-primary next_step'))?>
</div>
<?php $this->endWidget(); ?>
<script>
    $(function() {
        $('.next_step').on('click', function() {
            var id = $('#catConstructType').val();

            if (id > 0) {
                $.ajax({
                    url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxGradeConstruct')?>',
                    data: $('#grade-construct-form').serialize(),
                    type: 'post',
                    success: function(html) {
                        $('.modal-dialog').animate({
                            'width':'800px'
                        }, 200, function() {
                            $('.modal_option').html(html);
                        });
                    }
                });
            }
            return false;
        });
    });
</script>

<?php foreach($catConstruct as $cat) : ?>
    <div data-id="<?= $cat->id ?>" class="construct">
        <div style="float:left" class="construct-image">
            <?= CHtml::image(Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."small/".$cat->image); ?>
        </div>

        <div style="float:left">
            <?= $cat->description ?>
        </div>
        <div style="clear:both;"></div>
    </div>
<?php endforeach; ?>
</br>
<?= CHtml::button('Сохранить', array('class'=>'btn btn-primary sendBtn'))?>

<script>
    $(function() {
        selectedConstruct();
        function selectedConstruct() {
            $('.modal_option').find('.construct[data-id='+ <?php echo $construct_old_id; ?> +']').addClass('selected');
        }


        $('.modal_option').on('click', '.construct', function() {
            $('.construct').removeClass('selected');
            $(this).addClass('selected');
            sendBtnView();
        });

        sendBtnView();

        function sendBtnView() {
            if ($('.construct').hasClass('selected')) {
                $('.sendBtn').show();
            } else {
                $('.sendBtn').hide();
            }
        }

        $('.modal_option').on('click', '.sendBtn', function(){
            var grade_id = <?php echo $grade_id; ?>;
            var construct_id = $('.modal_option').find('.selected').attr('data-id');

            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('admin/project/ajaxGradeConstructSave')?>',
                data: {grade_id: grade_id, construct_id: construct_id, construct_old_id: <?php echo $construct_old_id; ?>},
                type: 'post',
                success: function(html) {
                    if (html == 'ok') {
                        location.reload();
                    } else {
                        alert('При сохранении произошла ошибка!');
                    }
                }
            });
        });
    });

</script>
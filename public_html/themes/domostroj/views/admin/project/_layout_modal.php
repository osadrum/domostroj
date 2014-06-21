<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Создание элемента планировки</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'gallery-category-form',
                            'enableAjaxValidation' => false,
                        )); ?>

                        <div class="form-group">
                            <?php echo $form->labelEx($layoutModel, '_type', array()) ?>
                            <?php echo $form->dropDownList($layoutModel, '_type', ActiveRecord::getListType('CatLayoutType'), array('class' => 'form-control')); ?>
                            <?php echo $form->error($layoutModel, '_type'); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->hiddenField($model, 'id', array('class' => 'form-control')); ?>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($layoutModel, 'image', array()) ?>
                            <?php echo $form->hiddenField($layoutModel, 'image', array('class' => 'form-control')); ?>
                        </div>
                        <!-- /.form-group -->

                        <?php
                        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'uploadFile',
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/admin/file/imageUpload?type=imageSizeCategory'),
                                    'allowedExtensions' => Yii::app()->params['imageTypes'], //array("jpg","jpeg","gif","exe","mov" and etc...
                                    'sizeLimit' => Yii::app()->params['sizeLimit'], // maximum file size in bytes
                                    'minSizeLimit' => 1 * 1024,
                                    'auto' => false,
                                    'multiple' => false,
                                    'onComplete' => "js:function(id, fileName, responseJSON){ viewGetImage(responseJSON.filename); }",
                                    'messages' => array(
                                        'typeError' => "{file} has invalid extension. Only {extensions} are allowed.",
                                        'sizeError' => "{file} is too large, maximum file size is {sizeLimit}.",
                                        'minSizeError' => "{file} is too small, minimum file size is {minSizeLimit}.",
                                        'emptyError' => "{file} is empty, please select files again without it.",
                                        'onLeave' => "The files are being uploaded, if you leave now the upload will be cancelled."
                                    ),
                                    'showMessage' => "js:function(message){ alert(message); }"
                                )
                            ));
                        ?>
                        <?php echo $form->error($layoutModel, 'image'); ?>

                        <div class="image" style="margin-bottom: 20px">
                            <?php if ($layoutModel->image != null) : ?>
                                <img
                                    src="<?php echo Yii::app()->getRequest()->getHostInfo() . Yii::app()->params['imagePath'] ?>small/<?php echo $layoutModel->image ?>">
                                <br><a href="#" class="del_image" data-image-name="<?php echo $layoutModel->image ?>">Удалить
                                    фото</a>
                            <?php endif ?>
                        </div>

                        <div class="form-actions">
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'buttonType' => 'submit',
                                'type' => 'primary',
                                'label' => $layoutModel->isNewRecord ? 'Создать' : 'Сохранить',
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
    <!-- /.col-lg-12 -->
</div>
<script>
    <?php if ($layoutModel->image != null) : ?>
    hideUploadButton();
    <?php endif ?>

    function viewGetImage(image) {
        hideUploadButton();
        $('#Layout_image').val(image);
        $('.image').show().html('<img src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>small/' + image + '">' +
            '<br><a href="#" class="del_image" data-image-name="' + image + '">Удалить фото</a>');
    }

    function hideUploadButton() {
        $('.qq-upload-success').remove();
        $('#uploadFile').hide();
    }

    function showUploadButton() {
        $('#uploadFile').show();
        $('.image').hide().empty();
    }

    $('#gallery-category-form').on('click', '.del_image', function () {
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/file/imageDelete') ?>',
            dataType: 'json',
            type: 'post',
            data: {image: $(this).attr('data-image-name')},
            success: function (data) {
                if (data.errors == 0) {
                    showUploadButton();
                }
            }
        });
        return false;
    })
</script>

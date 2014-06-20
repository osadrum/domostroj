<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'cat-construct-form',
    'enableAjaxValidation'=>false,
)); ?>

<div class="form-group">
    <?php echo $form->labelEx($model,'_type',array()) ?>
    <?php echo $form->dropDownList($model,'_type',CatConstructType::getListType(),array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'_type'); ?>
</div><!-- /.form-group -->

<div class="form-group">
    <?php echo $form->labelEx($model,'image',array()) ?>
    <?php echo $form->hiddenField($model,'image',array('class'=>'form-control')); ?>
</div><!-- /.form-group -->

<?php
$this->widget('ext.EAjaxUpload.EAjaxUpload',
    array(
        'id'=>'uploadFile',
        'config'=>array(
            'action'=>Yii::app()->createUrl('/admin/file/imageUpload?type=imageSizeCategory'),
            'allowedExtensions'=>Yii::app()->params['imageTypes'],//array("jpg","jpeg","gif","exe","mov" and etc...
            'sizeLimit'=>Yii::app()->params['sizeLimit'],// maximum file size in bytes
            'minSizeLimit'=>1*1024,
            'auto'=>false,
            'multiple' => false,
            'onComplete'=>"js:function(id, fileName, responseJSON){ viewGetImage(responseJSON.filename); }",
            'messages'=>array(
                'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                'emptyError'=>"{file} is empty, please select files again without it.",
                'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
            ),
            'showMessage'=>"js:function(message){ alert(message); }"
        )
    ));
?>
<script>
    <?php if ($model->image != null) : ?>
    hideUploadButton();
    <?php endif ?>

    function viewGetImage(image) {
        hideUploadButton();
        $('#CatConstruct_image').val(image);
        $('.image').show().html('<img src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>small/'+image+'">' +
            '<br><a href="#" class="del_image" data-image-name="'+image+'">Удалить фото</a>');
    }

    function hideUploadButton() {
        $('.qq-upload-success').remove();
        $('#uploadFile').hide();
    }

    function showUploadButton() {
        $('#uploadFile').show();
        $('.image').hide().empty();
    }

    $('#cat-construct-form').on('click', '.del_image', function() {
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/file/imageDelete') ?>',
            dataType: 'json',
            type: 'post',
            data: {image: $(this).attr('data-image-name')},
            success: function(data) {
                if (data.errors == 0) {
                    showUploadButton();
                }
            }
        });
        return false;
    })
</script>
<?php echo $form->error($model,'image'); ?>

<div class="image" style="margin-bottom: 20px">
    <?php if ($model->image != null) : ?>
        <img src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>small/<?php echo $model->image ?>">
        <br><a href="#" class="del_image" data-image-name="<?php echo $model->image ?>">Удалить фото</a>
    <?php endif ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'description',array()) ?>
    <?php $this->widget('application.extensions.ckeditor2.TheCKEditorWidget',array(
        'model'=>$model,                # Data-Model (form model)
        'attribute'=>'description',         # Attribute in the Data-Model
        'height'=>'200px',
        'width'=>'100%',
        'config'=>array(
            'filebrowserUploadUrl' => Yii::app()->createUrl('/admin/default/imgUpload'),
        ),
        'toolbarSet'=>Yii::app()->params['CKEditorTool'],           # EXISTING(!) Toolbar (see: ckeditor.js)
        'ckeditor'=>Yii::app()->basePath.'/../ckeditor/ckeditor.php',
        # Path to ckeditor.php
        'ckBasePath'=>Yii::app()->baseUrl.'/ckeditor/',
        # Relative Path to the Editor (from Web-Root)
        'css' => Yii::app()->baseUrl.'/css/index.css',
        # Additional Parameters
    ) ); ?>
    <?php echo $form->error($model,'description'); ?>
</div><!-- /.form-group -->
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
    )); ?>
</div>
<?php $this->endWidget(); ?>


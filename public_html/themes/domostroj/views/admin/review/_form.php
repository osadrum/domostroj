<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'review-form',
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<div class="form-group">
    <?php echo $form->textFieldRow($model,'title',array('class'=>'form-control')); ?>
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
</div>

<div class="form-group">
    <?php echo $form->labelEx($model,'image',array()) ?>
    <?php echo $form->hiddenField($model,'image',array('class'=>'form-control')); ?>
</div><!-- /.form-group -->

<?php
$this->widget('ext.EAjaxUpload.EAjaxUpload',
    array(
        'id'=>'uploadFile',
        'config'=>array(
            'action'=>Yii::app()->createUrl('/admin/file/imageUpload?type=imageSizeReview'),
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

<?php echo $form->error($model,'image'); ?>

<div class="image" style="margin-bottom: 20px">
    <?php if ($model->image != null) : ?>
        <img src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>small/<?php echo $model->image ?>">
        <br><a href="#" class="del_image" data-image-name="<?php echo $model->image ?>">Удалить фото</a>
    <?php endif ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model,'document',array()) ?>
    <?php echo $form->hiddenField($model,'document',array('class'=>'form-control')); ?>
</div>

<?php
$this->widget('ext.EAjaxUpload.EAjaxUpload',
    array(
        'id'=>'uploadDoc',
        'config'=>array(
            'action'=>Yii::app()->createUrl('/admin/file/fileUpload'),
            'allowedExtensions'=>Yii::app()->params['docTypes'],
            'sizeLimit'=>Yii::app()->params['sizeLimit'],// maximum file size in bytes
            //'minSizeLimit'=>1*1024,
            'auto'=>false,
            'multiple' => false,
            'onComplete'=>"js:function(id, fileName, responseJSON){ viewGetFile(responseJSON.filename); getSize(responseJSON.size);  }",
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
<?php //var_dump(Yii::app()->getRequest()->getHostInfo() . Documents::getDocFolder($this->doc));die;?>


<?php echo $form->error($model,'document'); ?>
<div class="document" style="margin-bottom: 20px">

</div>


<div class="form-group">
    <?php echo $form->checkBoxRow($model, 'is_published') ?>
</div>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Сохранить',
    )); ?>
</div>

<?php $this->endWidget(); ?>
<script>
    <?php if ($model->document != null) : ?>
    hideDocUploadButton();
    <?php endif ?>

    function hideDocUploadButton() {
        $('.qq-upload-success').remove();
        $('#uploadDoc').hide();
    }

    function showDocUploadButton() {
        $('#uploadDoc').show();
        $('.file').hide().empty();
    }

    function getSize(size) {
        $('#Review_size').val(size);
    }

    function viewGetFile(file) {
        $('.qq-upload-success').remove();
        $('#uploadDoc').hide();
        $('#Review_document').val(file);
        $('.document').show().html('<a download='+file+' href="<?php echo Yii::app()->getRequest()->getHostInfo() . Yii::app()->params['docPath']?>'+file+'">Посмотреть документ</a>' +
            '<br><a href="#" class="del_file" data-file-name="'+file+'">Удалить документ</a>');
    }

    $('#review-form').on('click', '.del_file', function() {
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/file/fileDelete') ?>',
            dataType: 'json',
            type: 'POST',
            data: {file: $(this).attr('data-file-name')},
            success: function(data) {
                if (data.errors == 0) {
                    $('#uploadDoc').show();
                    $('.document').hide().empty();
                }
            }
        });
        return false;
    })

    <?php if ($model->image != null) : ?>
    hideUploadButton();
    <?php endif ?>

    function viewGetImage(image) {
        hideUploadButton();
        $('#Review_image').val(image);
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

    $('#review-form').on('click', '.del_image', function() {
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
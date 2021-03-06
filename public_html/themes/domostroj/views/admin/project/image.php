<?php
$this->pageTitle = 'Изображения "' . $model->title . '"';
$this->breadcrumbs = array(
    'Проекты' => array('admin'),
    $this->pageTitle
);
$this->pageIcon = '<i class="fa fa-home"></i> ';
?>
<div class="row">
    <div class="col-lg-12">
        <?php echo CHtml::link('<span class="fa fa-home"></span> Свойства проекта',
            Yii::app()->createUrl('/admin/project/update', array('id' => $model->id)),
            array('class' => 'btn btn-xs btn-three')) ?>
        <?php echo CHtml::link('<span class="fa fa-list"></span> Список проектов', Yii::app()->createUrl('/admin/project'),
            array('class' => 'btn btn-xs btn-three')) ?>

    </div>
</div>
<div class="panel-body">

    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Фотографии
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id' => 'addImages',
                                'config' => array(
                                    'action' => Yii::app()->createUrl('/admin/project/projectImage', array('project_id' => $model->id)),
                                    'allowedExtensions' => Yii::app()->params['imageTypes'], //array("jpg","jpeg","gif","exe","mov" and etc...
                                    'sizeLimit' => Yii::app()->params['sizeLimit'], // maximum file size in bytes
                                    'minSizeLimit' => 1 * 1024,
                                    'auto' => false,
                                    'multiple' => true,
                                    'onComplete' => "js:function(id, fileName, responseJSON){ ajaxListUpdate('listProjectImage'); }",
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

                        $this->widget('application.extensions.fancybox.EFancyBox', array(
                            'target' => '.fancybox',
                            'config' => array(),
                        ));
                        ?>


                        <?php $this->widget('bootstrap.widgets.TbListView', array(
                            'id' => 'listProjectImage',
                            'dataProvider' => $images,
                            'template' => '{items}{pager}',
                            'emptyText' => 'В альбоме нет фотографий.',
                            'summaryText' => "{start}&mdash;{end} из {count}",
                            'itemView' => '_viewImages',
                            'pager' => array(
                                'class' => 'bootstrap.widgets.TbPager',
                                'header' => false,
                                'maxButtonCount' => 5,
                            ),
                        )); ?>
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
<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Название</h4>
            </div>
            <div class="modal-body" >
                <input type="text" name="title" id="image-title-input" value="">
                <input type="text" name="sort" id="image-sort-input" value="">
                <input type="hidden" name="title" id="image-id-input" value="">
                <a href="#" class="btn btn-success image-title-sent">Сохранить</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>

    $('#listProjectImage').on('click', '.image_edit', function() {
        $('#image-title-input').val($(this).attr('data-title'));
        $('#image-sort-input').val($(this).attr('data-sort'));
        $('#image-id-input').val($(this).attr('data-id'));
        $('#modal').modal('toggle');
    });

    $('.image-title-sent').on('click', function() {
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/project/imageOptionEdit') ?>',
            data: {id: $('#image-id-input').val(), title: $('#image-title-input').val(), sort: $('#image-sort-input').val()},
            type: 'post',
            success: function(html) {
                if (html == 'ok') {
                    ajaxListUpdate('listProjectImage');
                    $('#modal').modal('hide');
                }
            }
        });
        return false;
    });

    $('#listProjectImage').on('click', '.image_delete', function () {
        if (confirm('Удалить?')) {
            var item = $(this).parents('.image_preview');
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/project/imageDelete') ?>',
                data: {id: $(this).attr('data-id')},
                type: 'post',
                success: function (html) {
                    if (html == 'ok') {
                        item.css("background-color", "red");
                        item.fadeOut(200, function () {
                            item.remove();
                        });
                    }
                }
            });
            return false;
        }
    });

    $('#listProjectImage').on('click', '.image_public', function () {
        var publish;
        var button = $(this).find('.fa');
        if (button.hasClass('fa-check-circle-o')) {
            publish = 0;
        } else {
            publish = 1;
        }

        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('/admin/project/imagePublish') ?>',
            data: {id: $(this).attr('data-id'), publish: publish},
            type: 'post',
            success: function (html) {
                if (html == 'ok') {
                    if (publish == 0) {
                        button.removeClass('fa-check-circle-o');
                        button.addClass('fa-circle-o');
                    } else {
                        button.removeClass('fa-circle-o');
                        button.addClass('fa-check-circle-o');
                    }
                }
            }
        });
        return false;

    })
    function ajaxListUpdate(listId){
        $("#"+listId).yiiListView.update(listId);
    }
</script>
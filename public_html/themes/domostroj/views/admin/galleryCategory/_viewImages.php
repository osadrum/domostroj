
    <div class="image_preview">
        <a class="fancybox" rel="gallery"  href="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>large/<?php echo $data->image ?>">
            <img src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>small/<?php echo $data->image ?>">
        </a>
        <div class="control-buttons">

            <span class="image_public" data-id="<?php echo $data->id ?>">
                <span class="fa fa-<?php echo ($data->is_published == 1) ? 'check-circle-o':'circle-o' ?>"></span>
            </span>
            <span class="image_delete" data-id="<?php echo $data->id ?>"><span class="fa fa-times-circle"></span></span>

        </div>
    </div>

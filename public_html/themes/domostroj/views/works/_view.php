<div class="col-lg-12">
    <h5><?php echo $data->description;?></h5>
</div>
<?php foreach($data->galleryImages as $images) :?>
    <div class="mix category_1 col-lg-4 col-md-4 col-sm-6" data-cat="1">
        <div class="w-box inverse">
            <div class="figure">
                <img alt="" src="<?php echo Statics::getImageLink($images->image) ?>" class="img-responsive">
                <div class="figcaption bg-2"></div>
                <div class="figcaption-btn">
                    <a rel="gallery<?php echo $data->id; ?>" href="<?php echo Statics::getImageLink($images->image, 'large') ?>" class="btn btn-xs btn-one theater"><i
                            class="fa fa-plus-circle"></i> Увеличить</a>
<!--                    <a href="#" class="btn btn-xs btn-one"><i class="fa fa-link"></i> Посмотреть</a>-->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


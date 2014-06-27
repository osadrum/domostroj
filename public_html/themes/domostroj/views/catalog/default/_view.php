<div class="col-md-4">
    <div class="w-box">
        <div class="figure">
            <img alt="" src="<?php echo Statics::getImageLink($data->image) ?>" class="img-responsive">
            <div class="figcaption bg-2"></div>
            <div class="figcaption-btn">
                <a href="<?php echo Statics::getImageLink($data->image, 'large') ?>" class="btn btn-xs btn-one theater"><i class="fa fa-search-plus"></i> Увеличить</a>
                <a href="#" class="btn btn-xs btn-one"><i class="fa fa-link"></i> Посмотреть</a>
            </div>
        </div>
        <h2><?php echo $data->title ?></h2>
        <p>
            <?php foreach ($data->grades as $grade) : ?>
                <h2><?php echo $grade->type->title ?></h2>
                <?php echo $grade->price ?> <i class="fa fa-rub"></i>
            <?php endforeach; ?>
        </p>
    </div>
</div>
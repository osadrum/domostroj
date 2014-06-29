<div class="col-md-4">
    <div class="w-box">
        <div class="figure">
            <img alt="" src="<?php echo Statics::getImageLink($data->image) ?>" class="img-responsive">
            <div class="figcaption bg-2"></div>
            <div class="figcaption-btn">
                <a href="<?php echo Statics::getImageLink($data->image, 'large') ?>" class="btn btn-xs btn-one theater"><i class="fa fa-search-plus"></i> Увеличить</a>
                <a href="<?php echo Yii::app()->createUrl('/catalog/default/view', array('id'=>$data->id)) ?>" class="btn btn-xs btn-one"><i class="fa fa-link"></i> Посмотреть</a>
            </div>
        </div>
        <h2><?php echo $data->title ?></h2>
        <div class="grades">
            <?php foreach ($data->grades as $grade) : ?>
                <span class="grade-title"><?php echo $grade->type->title ?></span>
                <span class="grade-price"><?php echo $grade->price ?> </span><i class="fa fa-rub"></i><br>
            <?php endforeach; ?>
        </div>
    </div>
</div>
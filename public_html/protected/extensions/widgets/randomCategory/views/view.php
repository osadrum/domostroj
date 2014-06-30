<div id="ulSorList">
    <?php $cnt=0; ?>
    <?php foreach ($category as $cat) : ?>
        <?php $cnt++; ?>
        <div class="mix category_<?php echo $cnt; ?> col-lg-3 col-md-3 col-sm-6 mix_all" data-cat="<?php echo $cnt; ?>" style="display: inline-block; opacity: 1;">
            <div class="w-box inverse">
                <div class="figure">
                    <img alt="" src="<?php echo Statics::getImageLink($cat->image) ?>" class="img-responsive">
                    <div class="figcaption bg-2"></div>
                    <div class="figcaption-btn">
                        <a href="<?php echo Yii::app()->createUrl('/catalog/default/', array('category'=>$cat->id)) ?>" class="btn btn-xs btn-one"><i class="fa fa-link"></i> Посмотреть</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h2><?php echo $cat->title; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<div class="gap"></div>
</div>
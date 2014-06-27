<?php if (!empty($slider)) :?>
    <section id="homepageCarousel" class="carousel carousel-1 slide color-two-l" data-ride="carousel">

        <div class="carousel-inner">
            <?php foreach($slider as $s) :?>
                <div class="item item-dark" style="background-image:url( <?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params["imagePath"]."high/".$s->image;?>);">
                    <div class="container">
                        <div class="description fluid-center">
                            <span class="title"><?php echo $s->title; ?></span>
                            <span class="subtitle"><?php echo $s->subtitle; ?></span>
                            <span class="features">
                                <?php echo $s->features; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#homepageCarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right carousel-control" href="#homepageCarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </section>
<?php endif; ?>
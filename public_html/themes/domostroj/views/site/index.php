<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php  $this->widget('ext.widgets.randomCategory.RandCategory'); ?>


<section class="slice bg-5">
    <div class="w-section inverse">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h3 class="section-title"><span>О компании<span class="border"></span></span></h3>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Settings::getCacheValue('about'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3 class="section-title">Отзывы</h3>
                    <div class="widget">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php  $this->widget('ext.widgets.randomProjects.RandProjects'); ?>
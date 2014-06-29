<?php
$this->pageTitle = 'Проект дома "'.$project->title.'"';
$this->breadcrumbs = array(
    'Проекты' => array('index'),
    $project->category->title => Yii::app()->createUrl('/catalog/default', array('category'=>$project->_category)),
    $this->pageTitle,
);
?>
<div class="row">
    <div class="col-lg-6">
        <a class="fancybox" rel="gallery"  href="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>large/<?php echo $project->image ?>">
            <img alt="" src="<?php echo Statics::getImageLink($project->image, 'large') ?>" class="img-responsive">
        </a>
    </div>
    <div class="col-lg-6">
        <?php if (!empty($addPhotos)) : ?>
            <?php foreach ($addPhotos as $photo) : ?>
                <div class="col-lg-6 add-photo-row">
                    <a class="fancybox" rel="gallery"  href="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>large/<?php echo $photo->image ?>">
                        <img alt="" src="<?php echo Statics::getImageLink($photo->image, 'small') ?>" class="img-responsive">
                    </a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="row project-row">
    <div class="col-lg-6">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td><span class="option-title">Общая площадь:</span></td><td><?php echo $project->area ?></td>
                </tr>
                <tr>
                    <td>Этажность</td><td><?php echo $project->floor ?></td>
                </tr>

                <?php if (!empty($options)) : ?>
                    <?php foreach ($options as $option) : ?>
                        <tr>
                            <td><?php echo $option->optionTitle->title ?></td><td><?php echo $option->value ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <div class="w-box popular box-promo">
            <h2>Что-то не подходит? Нет проблем!</h2>
            <div class="col-lg-12">
                Свяжитесь с нами и мы подберем варианты Вашего дома исходя из:
            </div>
            <div class="col-lg-12">
                <ul class="list-check">
                    <li><i class="fa fa-check"></i> Бюджета</li>
                    <li><i class="fa fa-check"></i> Возможного пятна застройки</li>
                    <li><i class="fa fa-check"></i> Ваших пожеланий по планировке</li>
                </ul></div>

            <a class="btn btn-two btn-call-back modal-call-back" title="" href="#modal-call-back" target="blank">
                <i class="fa fa-phone"></i> Заказать звонок
            </a>
        </div>
    </div>
</div>
<?php if (!empty($layouts)) : ?>
    <div class="row project-row">
        <div class="col-lg-12">
            <h3 class="section-title">Планировка <span class="vers"><?php $cnt=0; ?>
                <?php foreach ($layouts as $layout) : ?>
                    <?php
                    $cnt++;
                    if ($cnt != 1) {
                        echo CHtml::link(ActiveRecord::getTitleType("CatLayoutType",$layout->_type) . "  " .$layout->floor, '#', array('class'=>'btn-layout btn btn-xs', 'data-id'=>'lt_'.$layout->id));
                    } else {
                        echo CHtml::link(ActiveRecord::getTitleType("CatLayoutType",$layout->_type) . "  " .$layout->floor, '#', array('class'=>'btn-layout btn btn-xs btn-two', 'data-id'=>'lt_'.$layout->id));
                    }
                    ?>
                <?php endforeach; ?></span></h3>

        </div>
    </div>
        <?php $cnt=0; ?>
        <?php foreach ($layouts as $layout) : ?>
            <?php
                $cnt++;
                if ($cnt != 1) {
                    $visible = 'style="display:none"';
                } else {
                    $visible = '';
                }
            ?>
        <div class="row layouts" id="layout_lt_<?php echo $layout->id?>" <?php echo $visible ?>>
            <div class="col-lg-6">
                <a class="fancybox" href="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params['imagePath'] ?>large/<?php echo $layout->image ?>">
                    <img alt="" src="<?php echo Statics::getImageLink($layout->image,'large') ?>" class="img-responsive">
                </a>
            </div>
            <div class="col-lg-6">
                <table class="table table-bordered table-hover table-responsive">
                    <tbody>

                        <?php foreach ($layout->layoutOptions as $layoutOption) : ?>
                        <tr><td><?php echo $layoutOption->catLayoutOption->title ?></td><td><?php echo $layoutOption->value ?> <span>м<sup>2</sup></span></td></tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php $this->renderPartial('_stage_payments'); ?>
            </div>
        </div>
        <?php endforeach; ?>

<?php endif; ?>
<?php if (!empty($grades)) : ?>
    <div class="row  project-row">
        <div class="col-lg-12">
            <h3 class="section-title">Комплектация: <span class="vers">
                <?php $cnt=0; ?>
                <?php foreach ($grades as $grade) : ?>
                    <?php
                    $cnt++;
                    if ($cnt != 1) {
                        echo CHtml::link($grade->type->title, '#', array('class'=>'btn-grade btn btn-xs', 'data-id'=>'grade_'.$grade->id));
                    } else {
                        echo CHtml::link($grade->type->title, '#', array('class'=>'btn-grade btn btn-xs btn-two', 'data-id'=>'grade_'.$grade->id));
                    }
                    ?>
                <?php endforeach; ?></span>
                <span class="vers">Цена
                <?php $cnt=0; ?>
                <?php foreach ($grades as $grade) : ?>
                    <?php
                    $cnt++;
                    if ($cnt != 1) {
                        $visible = 'style="display:none"';
                    } else {
                        $visible = '';
                    }
                    ?>
                    <span class="grade-price" id="price_grade_<?php echo $grade->id ?>" <?php echo $visible ?>><?php echo $grade->price ?> <i class="fa fa-rub"></i> </span>
                <?php endforeach; ?>
            </span></h3>
        </div>
    </div>

        <?php $cnt=0; ?>
        <?php foreach ($grades as $grade) : ?>
            <?php
            $cnt++;
            if ($cnt != 1) {
                $visible = 'style="display:none"';
            } else {
                $visible = '';
            }
            ?>
        <div class="row grade-construct" <?php echo $visible ?>  id="construct_grade_<?php echo $grade->id ?>">
            <div class="col-lg-12">
                <ul class="list-listings">
                    <?php foreach ($grade->gradeConstructs as $construct) : ?>
                        <li class="featured">
                            <div class="listing-header bg-2">
                                <?php echo $construct->catConstruct->type->title ?>
                            </div>
                            <div class="listing-image">
                                <img alt="" src="<?php echo Statics::getImageLink($construct->catConstruct->image) ?>" class="img-responsive">
                            </div>
                            <div class="listing-body">
                                <?php echo $construct->catConstruct->description ?>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>

<?php endif; ?>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => '.fancybox',
    'config' => array(
        'fitToView' => true,
        'loop' => false,
        'width' => '80%',
        'height' => '80%',
        'autoSize' => false,
        'closeClick' => true,
        'openEffect' => 'elastic',
        'closeEffect' => 'none'
    ),
));
?>
<script>
        $('.btn-grade').on('click', function() {
            var id = $(this).attr('data-id');

            $('.btn-grade').removeClass('btn-two');
            $(this).addClass('btn-two');

            $('.grade-price').hide();
            $('#price_'+id).show();

            $('.grade-construct').hide();
            $('#construct_'+id).show();
            return false;
        });

        $('.btn-layout').on('click', function() {
            var id = $(this).attr('data-id');

            $('.btn-layout').removeClass('btn-two');
            $(this).addClass('btn-two');

            $('.layouts').hide();
            $('#layout_'+id).show();

            return false;
        });
</script>
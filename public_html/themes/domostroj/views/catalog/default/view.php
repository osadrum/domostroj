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
<div class="row">
    <div class="col-lg-6">
        <ul class="project-options">
            <li>Общая площадь:<?php echo $project->area ?></li>
            <li>Этажность:<?php echo $project->floor ?></li>
            <?php if (!empty($options)) : ?>
                <?php foreach ($options as $option) : ?>
                    <li><?php echo $option->optionTitle->title ?>: <?php echo $option->value ?></li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-lg-6">
        <div class="call-back-block1">
            <h2>Что-то не подходит? Нет проблем!</h2>
            Свяжитесь с нами и мы подберем варианты Вашего дома исходя из:
            <ul>
                <li>Бюджета</li>
                <li>Возможного пятна застройки</li>
                <li>Ваших пожеланий по планировке</li>
            </ul>
        </div>
    </div>
</div>
<?php if (!empty($layouts)) : ?>
    <div class="row">
        Планировка:
        <?php $cnt=0; ?>
        <?php foreach ($layouts as $layout) : ?>
            <?php
            $cnt++;
            if ($cnt != 1) {
                echo CHtml::link(ActiveRecord::getTitleType("CatLayoutType",$layout->_type) . "  " .$layout->floor, '#', array('class'=>'btn-layout btn btn-xs', 'data-id'=>'lt_'.$layout->id));
            } else {
                echo CHtml::link(ActiveRecord::getTitleType("CatLayoutType",$layout->_type) . "  " .$layout->floor, '#', array('class'=>'btn-layout btn btn-xs btn-four', 'data-id'=>'lt_'.$layout->id));
            }
            ?>
        <?php endforeach; ?>
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
                <ul>
                    <?php foreach ($layout->layoutOptions as $layoutOption) : ?>
                        <li><?php echo $layoutOption->catLayoutOption->title ?>: <?php echo $layoutOption->value ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php $this->renderPartial('_stage_payments'); ?>
            </div>
        </div>
        <?php endforeach; ?>

<?php endif; ?>
<?php if (!empty($grades)) : ?>
    <div class="row">
        Комплектация:
        <?php $cnt=0; ?>
        <?php foreach ($grades as $grade) : ?>
            <?php
            $cnt++;
            if ($cnt != 1) {
                echo CHtml::link($grade->type->title, '#', array('class'=>'btn-grade btn btn-xs', 'data-id'=>'grade_'.$grade->id));
            } else {
                echo CHtml::link($grade->type->title, '#', array('class'=>'btn-grade btn btn-xs btn-four', 'data-id'=>'grade_'.$grade->id));
            }
            ?>
        <?php endforeach; ?>
        Цена
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
            <span class="grade-price" id="price_grade_<?php echo $grade->id ?>" <?php echo $visible ?>><?php echo $grade->price ?></span>
        <?php endforeach; ?>
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
            <?php foreach ($grade->gradeConstructs as $construct) : ?>
                <div class="col-lg-4">
                    <img alt="" src="<?php echo Statics::getImageLink($construct->catConstruct->image) ?>" class="img-responsive">
                </div>
                <div class="col-lg-8">
                    <?php echo $construct->catConstruct->description ?>
                </div>
            <?php endforeach; ?>
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

            $('.btn-grade').removeClass('btn-four');
            $(this).addClass('btn-four');

            $('.grade-price').hide();
            $('#price_'+id).show();

            $('.grade-construct').hide();
            $('#construct_'+id).show();
            return false;
        });

        $('.btn-layout').on('click', function() {
            var id = $(this).attr('data-id');

            $('.btn-layout').removeClass('btn-four');
            $(this).addClass('btn-four');

            $('.layouts').hide();
            $('#layout_'+id).show();

            return false;
        });
</script>
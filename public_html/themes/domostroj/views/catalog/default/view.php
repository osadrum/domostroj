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
        <img alt="" src="<?php echo Statics::getImageLink($project->image, 'large') ?>" class="img-responsive">
    </div>
    <div class="col-lg-6">
        <?php if (!empty($addPhotos)) : ?>
            <?php foreach ($addPhotos as $photo) : ?>
                <div class="col-lg-6">
                    <img alt="" src="<?php echo Statics::getImageLink($photo->image, 'medium') ?>" class="img-responsive">
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <ul>
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
            <div class="col-lg-6" <?php echo $visible ?>>
                <img alt="" src="<?php echo Statics::getImageLink($layout->image,'large') ?>" class="img-responsive">
            </div>
            <div class="col-lg-6" <?php echo $visible ?>>
                <ul>
                    <?php foreach ($layout->layoutOptions as $layoutOption) : ?>
                        <li><?php echo $layoutOption->catLayoutOption->title ?>: <?php echo $layoutOption->value ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php $this->renderPartial('_stage_payments'); ?>

            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (!empty($grades)) : ?>
    <div class="row">
        Комплектация:
        <?php $cnt=0; ?>
        <?php foreach ($grades as $grade) : ?>
            <?php
            $cnt++;
            if ($cnt != 1) {
                echo CHtml::link($grade->type->title, '#', array('class'=>'btn btn-xs'));
            } else {
                echo CHtml::link($grade->type->title, '#', array('class'=>'btn btn-xs btn-four'));
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
            <span class="price" <?php echo $visible ?>><?php echo $grade->price ?></span>
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
        <div class="row" <?php echo $visible ?>>
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
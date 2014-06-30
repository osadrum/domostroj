<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

    <div class="col-md-9">
        <?php echo $content; ?>
    </div>
    <div class="col-md-3">
        <?php  $this->widget('ext.widgets.verticalProjects.VerticalProjects'); ?>
    </div>
<?php $this->endContent(); ?>
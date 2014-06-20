<?php $this->beginContent('//layouts/main'); ?>
        <div class="col-md-3">
            <?php $this->widget('bootstrap.widgets.TbNavbar', array(
                'id' => 'side-nav',
                'brand' => false,
                'type' => 'default',
                'fixed' => false,
                'htmlOptions' => array('class' => 'widget'),
                'items' => array(
                    array(
                        'class' => 'bootstrap.widgets.TbMenu',
                        'items' => $this->leftMenuAdmin,
                        'htmlOptions' => array('class'=>'categories'),
                        'submenuHtmlOptions' => array('class'=>'dropdown-menu')
                    ),
                ),
            )) ?>
        </div>
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>

<?php $this->endContent(); ?>

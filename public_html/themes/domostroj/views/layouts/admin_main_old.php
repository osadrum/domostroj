<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= CHtml::encode($this->pageTitle) ?></title>
    <meta name="description" content="<?php CHtml::encode($this->metaDescription) ?>">
    <meta name="keywords" content="<?php CHtml::encode($this->metaKeywords) ?>">

</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Yii::app()->getRequest()->getHostInfo(); ?>/admin"><?= Yii::app()->name ?></a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/admin/default/profile')?>"><i class="fa fa-user fa-fw"></i> Профиль </a>
                    </li>

                    <li class="divider"></li>
                    <li><?php echo CHtml::link('<i class="fa fa-sign-out fa-fw"></i> Выход', Yii::app()->createAbsoluteUrl('/site/logout')) ?>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->


        <!-- /.navbar-top-links -->
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'id' => 'side-nav',
            'brand' => false,
            'type' => 'default',
            'fixed' => false,
            'htmlOptions' => array('class' => 'navbar-default navbar-static-side', 'role' => 'navigation'),
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => $this->menuItems,
                ),
            ),
        )) ?>

        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?= $this->pageIcon; ?> <?= $this->pageTitle; ?></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">

            <div class="span12">
                <?php $this->widget('bootstrap.widgets.TbAlert', array(
                    'block' => true,
                    'fade' => true,
                    'closeText' => '&times;',
                )) ?>
            </div>
            <?php echo $content; ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<div id="ajax_loader"></div>
</body>

</html>
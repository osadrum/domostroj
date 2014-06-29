<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle) ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->metaDescription) ?>">
    <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords) ?>">
    <!-- Required -->
    <link rel="icon" href="<?php echo $this->getAssetsUrl(); ?>/images/favicon.png" type="image/png"
    --><!-- LayerSlider stylesheet -->
    <!--link rel="stylesheet" href="assets/layerslider/css/layerslider.css" type="text/css"-->

</head>
<body>
<div class="wrapper">

    <!-- Header: Logo and Main Nav -->
    <header>
        <div id="navOne" class="navbar navbar-wp" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl ?>" title="Яхочудом.рф">
                        <img src="<?php echo $this->getAssetsUrl(); ?>/images/logo.png"
                             alt="">
                    </a>
                </div>
                <div class="navbar-collapse collapse">
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
                                'htmlOptions' => array('class' => 'navbar-nav navbar-right'),
                                'submenuHtmlOptions' => array('class' => 'dropdown-menu')
                            ),
                        ),
                    )) ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </header>

    <?php if ($this->showSlider) :?>
        <?php $this->widget('ext.widgets.slider.SliderWidget'); ?>
    <?php endif; ?>

    <section class="slice bg-2 p-15">
        <div class="cta-wr">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <h1>
                            <?= $this->pageIcon; ?> <?= $this->pageTitle; ?>
                        </h1>
                    </div>
                    <div class="col-md-4 text-right">

                        <span class="line-phone"><?php echo Settings::getCacheValue('phone'); ?></span><br>
                        <span class="schedule-work"><?php echo Settings::getCacheValue('scheduleWork'); ?></span>

                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-one btn-lg pull-right" title="" href="" target="blank">
                            <i class="fa fa-phone"></i> Заказать звонок
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="pg-opt pin">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <?php if (isset($this->module) && $this->module->id === 'admin') {
                        $link = '/admin/default/';
                    } else {
                        $link = '/';
                    } ?>
                    <?php $this->widget('ext.widgets.breadcrumbs.BreadcrumbsWidget', array(
                        'homeLink'=>'<li>'.CHtml::link('Главная',$link).'</li>',
                        'htmlOptions'=>array('class'=>'breadcrumb'),
                        'links'=>$this->breadcrumbs,
                    )); ?>
                </div>

            </div>
        </div>
    </div>

    <?php if ($this->showFilter) : ?>
        <?php  $this->widget('ext.widgets.filter.FilterWidget', array('category'=>$this->categoryProjects)); ?>
    <?php endif; ?>

    <section class="slice bg-3 animate-hover-slide">
        <div class="w-section inverse blog-grid">
            <div class="container">
                <div class="row">

              <?php echo $content; ?>
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="col">
                    <h4>Contact us</h4>
                    <ul>
                        <li>5th Avenue, New York - United States</li>
                        <li>Phone: +10 724 1234 567 | Fax: +10 724 1234 567 </li>
                        <li>Email: <a href="mailto:hello@example.com" title="Email Us">hello@example.com</a></li>
                        <li>Skype: <a href="skype:my.business?call" title="Skype us">my-business</a></li>
                        <li>Creating great templates is our passion</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3">
                <div class="col">
                    <h4>Mailing list</h4>
                    <p>Sign up if you would like to receive occasional treats from us.</p>
                    <form class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your email address...">
                            <span class="input-group-btn">
                                <button class="btn btn-two" type="button">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="col col-social-icons">
                    <h4>Follow us</h4>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-skype"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                    <a href="#"><i class="fa fa-flickr"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="col">
                    <h4>About us</h4>
                    <p>
                        Boomerang Bootstrap Template is made with love and passion for your own business.
                        <br><br>
                        <a href="#" class="btn btn-two">Try it now!</a>
                    </p>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-9 copyright">
                2013 © Web Pixels. All rights reserverd.
                <a href="#">Terms of use</a> |
                <a href="#">Privacy policy</a>
            </div>
            <div class="col-lg-3 footer-logo">

            </div>
        </div>
    </div>
</footer></div>

<!-- Initializing the slider -->
<!--script>
    jQuery("#layerslider").layerSlider({
        pauseOnHover: true,
        autoPlayVideos: false,
        skinsPath: '<?php echo  $this->getAssetsUrl(); ?>/layerslider/skins/',
        responsive: false,
        responsiveUnder: 1280,
        layersContainer: 1280,
        skin: 'borderlessdark3d',
        hoverPrevNext: false
    });
</script-->
<div id="preloader"></div>
<script>
    function open_modal(box) {
        $("#background").show()
        $(box).centered_modal();
        $(box).delay(100).fadeIn(200);
    }
    function close_modal(box) {
        $(box).hide();
        //$("#background").delay(100).hide(1);
    }

    $(document).ready(function() {
        $.fn.centered_modal = function() {
            this.css("position","absolute");
            this.css("top", (($(window).height() - this.outerHeight()) / 2) + $(window).scrollTop() + "px");
            this.css("left", (($(window).width() - this.outerWidth()) / 2) + $(window).scrollLeft() + "px");
            return this;
        }

        $('#close').on('click', function(){
            close_modal('#modal_window');
        })

        $('#button-order').on('click', function(){
            open_modal('#modal_window');
        })
    });
</script>
</body>
</html>
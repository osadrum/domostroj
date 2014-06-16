<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boomerang - Multipurpose Template: Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Required -->
    <link rel="icon" href="<?php echo  $this->getAssetsUrl(); ?>/images/favicon.png" type="image/png"--><!-- LayerSlider stylesheet -->
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
                <a class="navbar-brand" href="index.html" title="Boomerang | One template. Infinite solutions">
                    <img src="<?php echo  $this->getAssetsUrl(); ?>/images/boomerang-logo-dark.png" alt="Boomerang | One template. Infinite solutions">
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
                            'htmlOptions' => array('class'=>'navbar-nav navbar-right'),
                            'submenuHtmlOptions' => array('class'=>'dropdown-menu')
                        ),
                    ),
                )) ?>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</header>
    <div class="pg-opt pin">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2><?= $this->pageIcon; ?> <?= $this->pageTitle; ?></h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Elements</a></li>
                        <li class="active">Shortcodes</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
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
</body>
</html>
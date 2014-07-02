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
        <div id="navOne" class="navbar navbar-rw" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Yii::app()->homeUrl ?>" title="Яхочудом.рф">
                        <img src="<?php echo $this->getAssetsUrl(); ?>/images/logo.jpg" alt="">
                    </a>
                    <!--a href="<?php echo Yii::app()->homeUrl ?>" title="Яхочудом.рф">
                        <h1>Я хочу дом</h1>
                    </a-->
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
                            Решено! Я хочу дом
                        </h1>
                    </div>
                    <div class="col-md-4 text-right">

                        <span class="line-phone"><?php echo Settings::getCacheValue('phone'); ?></span><br>
                        <span class="schedule-work"><?php echo Settings::getCacheValue('scheduleWork'); ?></span>

                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-one btn-lg pull-right modal-call-back" title="" href="#modal-call-back" target="blank">
                            <i class="fa fa-phone"></i> Заказать звонок
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ($this->showFilter) : ?>
        <?php  $this->widget('ext.widgets.filter.FilterWidget', array('category'=>$this->categoryProjects)); ?>
    <?php endif; ?>

    <section class="slice animate-hover-slide bg-3">
        <div class="w-section inverse">
            <div class="container">
                <?php  $this->widget('ext.widgets.randomCategory.RandCategory'); ?>
            </div>
        </div>
    </section>

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
                            <div class="row">
                                <?php $this->widget('ext.widgets.review.ReviewWidget'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slice bg-banner-1">
        <div class="mask-dark"></div>
        <div class="w-section inverse">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="text-center">
                            <h2>Звоните сейчас и мы поможем
                                вам правильно подобрать проект</h2>

                            <span class="clearfix"></span>

                            <div class="text-center">
                                <a class="btn btn-lg btn-three mt-20 ext-source modal-call-back" title="" href="#modal-call-back" target="blank">
                                    <i class="fa fa-phone"></i> Заказать звонок
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="slice animate-hover-slide bg-3">
        <div class="w-section inverse">
            <div class="container">
                <h3 class="section-title">Проекты</h3>
                <?php  $this->widget('ext.widgets.randomProjects.RandProjects'); ?>
            </div>
        </div>
    </section>


    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="col">
                        <h2>Решено! Я хочу дом.</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col text-center menu-bottom">
                            <?php $cnt=0 ?>
                            <?php foreach ($this->menuItems as $item) : ?>
                                <?php
                                $cnt++;
                                if ($item['label'] == 'Главная') {
                                    echo CHtml::link($item['label'], Yii::app()->homeUrl);
                                    continue;
                                }

                                if ($cnt > 1) {
                                    echo ' | ';
                                }
                                ?>
                                <?php echo CHtml::link($item['label'], Yii::app()->createUrl($item['url'][0])) ?>
                            <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="col">
                        <h4>Контактная информация</h4>
                        <ul>
                            <li><?php echo Settings::getCacheValue('address'); ?></li>
                            <li>Тел.: <?php echo Settings::getCacheValue('phone'); ?></li>
                            <li>Email: <?php echo Settings::getCacheValue('email'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-9 copyright">
                    2014 <?php echo (date('Y') > 2014)?' - '.date('Y'):''; ?> © <?php echo Settings::getCacheValue('siteName'); ?>. Все права защиещены.
                </div>
                <div class="col-lg-3 footer-logo">
                    <a href="http://rangeweb.ru" title="Разработка сайта"><img src="http://rangeweb.ru/shared/logo/logo130x21.png" alt="Разработка сайта"></a>
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
<div id="modal-call-back" style="display:none">
    <div class="call-back-title">Мы Вам перезвоним!</div>
    <span class="modal-message"></span><br>
    <form id="call-back-form">
        <input id="modal-name" type="text" name="name" placeholder="Ваше имя" value=""><br>
        <?php
        $this->widget('CMaskedTextField', array(
            'name' => 'phone',
            'mask' => '+7 (999) 999-99-99',
            'placeholder' => '_',
            'completed' => 'function(){console.log("ok");}',
            'htmlOptions' => array('id' => 'modal-phone', 'placeholder'=>'Ваш телефон')
        ));
        ?><br>
        <a href="#" class="btn btn-three btn-call-back-send">Отправить</a>
    </form>
</div>
<?php $this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => '.modal-call-back',
    'config' => array(
        'fitToView' => true,
        'loop' => false,
        'width' => '365',
        'height' => '195',
        'autoSize' => false,
        'closeClick' => false,
        'closeEffect' => 'none',
    ),
));
?>
<script>
    $('.btn-call-back-send').on('click', function() {

        var error = 0;
        var callBackForm = $('#call-back-form');
        var btn = $(this);
        callBackForm.find("input[type=text]").not('[type="submit"]').each(function() {

            if($(this).val().length != 0) {
                $(this).css({'border' : '1px solid #78b79b','color':'#78b79b'});
            } else {
                $(this).css({'border' : '1px solid #e86f56'});
                error++;
            }
        });

        if (error == 0) {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('/site/ajaxCallback') ?>',
                type: 'post',
                dataType: 'json',
                data: callBackForm.serialize(),
                beforeSend: function() {
                    btn.after('<span class="sending">Отправляем...</span>');
                    btn.hide();
                },
                success: function(data) {
                    if (data.status == 'ok') {
                        $('.sending').remove();
                        btn.show();
                        $('#modal-name').val('');
                        $('#modal-phone').val('');
                        callBackForm.hide();
                        $('.modal-message').html('Ваша заявка принята<br>Мы свяжемся с Вами в ближайшее время!').fadeIn(200).delay(4000).fadeOut(200, function() {
                            $.fancybox.close();
                            callBackForm.show(200);
                        });

                    }
                }
            });
        }
        return false;
    });
</script>
</body>
<?php echo Settings::getCacheValue('googleAnalytics'); ?>
<?php echo Settings::getCacheValue('yandexMetrika'); ?>
</html>
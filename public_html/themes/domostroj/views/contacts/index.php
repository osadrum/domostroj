<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle='Контакты';
$this->breadcrumbs=array(
	'Контакты',
);
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script type="text/javascript">
    function initialize() {
        var myLatlng = new google.maps.LatLng(<?php echo Settings::getCacheValue('coords'); ?>);
        var mapOptions = {
            zoom: <?php echo Settings::getCacheValue('mapZoom'); ?>,
            scrollwheel: false,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('mapCanvas'), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            animation: google.maps.Animation.DROP,
            title: '<?php echo Settings::getCacheValue('orgName'); ?>'
        });

        var contentString = '<div class="info-window-content"><?php echo Settings::getCacheValue('markerText'); ?>'+
            '<p><?php echo Settings::getCacheValue('address'); ?></p></div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

</script>
    <div class="col-md-7">
    <div id="mapCanvas" class="map-canvas no-margin"></div>

    <div class="row">
        <div class="col-sm-6">
            <div class="subsection">
                <h3 class="section-title">Контактная информация</h3>
                <div class="contact-info">
                    <h5>Адрес</h5>
                    <p><?php echo Settings::getCacheValue('address'); ?></p>

                    <h5>Телефон</h5>
                    <p><?php echo Settings::getCacheValue('phone'); ?></p>

                    <h5>Email</h5>
                    <p><?php echo Settings::getCacheValue('email'); ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="subsection">
                <h3 class="section-title">Режим работы</h3>
                <div class="contact-info">
                    <h5><?php echo Settings::getCacheValue('scheduleWork'); ?></h5>
                </div>
            </div>
        </div>
    </div>

</div>
    <div class="col-md-5">
        <?php if(Yii::app()->user->hasFlash('contact')): ?>

            <div class="flash-success">
                <?php echo Yii::app()->user->getFlash('contact'); ?>
            </div>

        <?php else: ?>
            <h3 class="section-title">Отправить нам сообщение</h3>
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'contact-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions' => array(
                    'class' => 'form-light mt-20',
                    'role' => 'form'
                )
            )); ?>
                <div class="form-group">
                    <label>Имя</label>
                    <?php echo $form->textField($model,'name', array('class'=>'form-control', 'placeholder'=>'Ваше имя')); ?>
                    <?php echo $form->error($model,'name'); ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=>'Ваш Email')); ?>
                            <?php echo $form->error($model,'email'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Телефон</label>
                            <?php
                            $this->widget('CMaskedTextField', array(
                                'model' => $model,
                                'attribute' => 'phone',
                                'mask' => '+7 (999) 999-99-99',
                                'placeholder' => '_',
                                'completed' => 'function(){console.log("ok");}',
                                'htmlOptions' => array('class'=>'form-control', 'placeholder'=>'Ваш телефон')
                            ));
                            ?>
                            <?php echo $form->error($model,'name'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Тема сообщения</label>
                    <?php echo $form->textField($model,'subject', array('class'=>'form-control', 'placeholder'=>'Тема сообщения')); ?>
                    <?php echo $form->error($model,'subject'); ?>
                </div>
                <div class="form-group">
                    <label>Сообщение</label>
                    <?php echo $form->textArea($model,'body', array('class'=>'form-control', 'placeholder'=>'Текст сообщения', 'style'=>'height:100px;')); ?>
                    <?php echo $form->error($model,'body'); ?>
                </div>

            <?php if(CCaptcha::checkRequirements()): ?>
                <div class="form-group">
                    <div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model,'verifyCode', array('class'=>'form-control', 'placeholder'=>'Код с картинки')); ?>
                    </div>

                    <?php echo $form->error($model,'verifyCode'); ?>
                </div>
            <?php endif; ?>


                <?php echo CHtml::submitButton('Отправить', array('class'=>'btn btn-two')); ?>

            <?php $this->endWidget(); ?>
        <?php endif; ?>
    </div>

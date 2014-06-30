<?php foreach($review as $r) :?>
    <div class="col-md-12">

    <h4><?php echo $r->title; ?></h4>
    </div>
    <div class="col-md-12">
        <img class="avatar-review" alt="" src="<?php echo Statics::getImageLink($r->image) ?>">
        <span class="review-desc"><?php echo $r->description; ?></span>
        <span class="view-review-link"><?php echo CHtml::link('Посмотреть оригинал',Yii::app()->getRequest()->getHostInfo().Yii::app()->params["docPath"].$r->document, array('class'=>'view_origin'))?></span>
    </div>
<?php endforeach;?>

<div class="col-md-12">
    <?php echo CHtml::link('Все отзывы',Yii::app()->createUrl('/site/reviewAll'),array('class'=>'btn btn-xs btn-two'))?>
</div>

<div id="modal-review" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Оригинал отзыва</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 iframe_content">

                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<script>
    /*$('.view_origin').on('click',function(){
        var link = $(this).attr('href');
        $('#modal-review').modal('toggle');

        $('.iframe_content').html('<iframe height="500px" src="'+link+'" ></iframe>');
        $('.modal-dialog').animate({
            width:'1000px'
        }, 200);

        return false;
    });*/

    $('.view_origin').on('click', function() {
        var link = $(this).attr('href');
        $.fancybox({
            'content':'<iframe height="100%" width="100%" src="'+link+'" ></iframe>',
            'fitToView':true,'loop':false,'width':'80%','height':'80%','autoSize':false,'closeClick':false,'closeEffect':'none'
        });

        return false;
    });

</script>
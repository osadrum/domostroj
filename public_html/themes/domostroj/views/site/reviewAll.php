<?php
$this->pageTitle = 'Отзывы';
$this->breadcrumbs = array(
    $this->pageTitle,
);
?>
<?php foreach($review as $r) :?>
    <div class="col-md-12">

        <h4><?php echo $r->title; ?></h4>
    </div>
    <div class="col-md-12">
        <img style="float: left; margin: 0 10px 5px 0" alt="" src="<?php echo Statics::getImageLink($r->image) ?>">
        <span style="text-align: justify"><?php echo $r->description; ?></span>
        <span style="float: right; font-weight: bold"><?php echo CHtml::link('Посмотреть оригинал','#',array('id'=>'view_origin'))?></span>
    </div>
<?php endforeach;?>


<div id="modal-review" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Оригинал отзыва</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <iframe height="500px" src="<?php echo Yii::app()->getRequest()->getHostInfo().Yii::app()->params["docPath"].$r->document?>" ></iframe>
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
    $('#view_origin').on('click',function(){
        $('#modal-review').modal('toggle');
        $('.modal-dialog').animate({
            width:'1000px'
        }, 200);
    })
</script>
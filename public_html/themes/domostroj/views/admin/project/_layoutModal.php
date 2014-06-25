<div id="modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <?php if ($this->action->id == 'grade'){
                    $title = 'Комплектация';
                } else {
                    $title = 'Планировка';
                }?>
                <h4 class="catalog-title"><?= $title; ?></h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 modal_option">

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


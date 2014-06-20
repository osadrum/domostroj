<?php
$this->pageTitle = 'Профиль администратора';
$this->breadcrumbs=array(
    $this->pageTitle,
);
$this->pageIcon = '<i class="fa fa-user"></i> ';
?>

<div class="password_message" style="display: none">
    <p class="alert in alert-block fade alert-success">Пароль изменен</p>
    <br>
</div>
<div class="form-group">
    <?php echo CHtml::link('Сменить пароль','#modalPassword',array(
        'data-toggle'=>"modal",
        'class' => 'btn btn-primary btn-xs',
        'id'=>'edit_password'
    )); ?>
</div>
<div id="modalPassword" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="catalog-title">Смена пароля</h4>
            </div>
            <div class="modal-body" >
                <div class="catalog">
                    <div>Введите 2 раза новый пароль</div>
                    <?php echo CHtml::passwordField('passwordOne', '', array('id'=>'passwordOne','class' => 'form-control')) ?><br/>
                    <?php echo CHtml::passwordField('passwordTwo', '', array('id'=>'passwordTwo','class' => 'form-control')) ?><br/>
                    <div id="alert_edit_password"></div>
                    <?php echo CHtml::button('Сохранить',
                        array(
                            'id'=>'savePassword',
                            'class'=>'btn btn-primary'
                        )); ?>
                    <div class='iframe'></div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>

    $("#edit_password").on("click", function() {
        $('#modalPassword').modal('toggle');

        $("#alert_edit_password").empty();
        return false;
    });

    $("#passwordOne").keydown(function(event){
        $("#alert_edit_password").empty();
    });

    $("#passwordTwo").keydown(function(event){
        $("#alert_edit_password").empty();
    });


    $("#savePassword").on("click", function(){
        var one = $("#passwordOne").val();
        var two = $("#passwordTwo").val();
        var pasOne_length = one.replace(/\s+/g,'').length;
        var pasTwo_length = two.replace(/\s+/g,'').length;

        if ( pasOne_length < 6 && pasTwo_length < 6 ){
            $("#alert_edit_password").html("Пароль должен быть не менее 6 символов").attr('style','color:red;margin-bottom:15px');

        } else if  ( one == two ){
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl("/admin/default/ajaxEditPassword") ?>",
                data: {password: two, id: <?php echo  Yii::app()->user->id ?>},
                dataType: "json",
                type: "POST",
                success: function(data){
                    $('#modalPassword').modal('hide');
                    $(".password_message").show(200).delay(10000).hide(200);
                    $("#passwordOne").val('');
                    $("#passwordTwo").val('');
                }
            })
        } else {
            $("#alert_edit_password").html("Пароли не совпадают").attr('style','color:red;margin-bottom:15px');
        }
    });
</script>
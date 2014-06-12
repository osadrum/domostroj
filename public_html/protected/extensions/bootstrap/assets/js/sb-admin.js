$(function() {

    $('.sidebar-collapse').find('.nav').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
})

function ajaxListUpdate(listId){
    $("#"+listId).yiiListView.update(listId);
}




$(document).ajaxStart(function(){
    $('#ajax_loader').show();
});

$(document).ajaxStop(function(){
    $('#ajax_loader').hide();
});

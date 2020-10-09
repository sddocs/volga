$(document).ready(function (){

    /*$('button[name = "confirm_custom"]').on('click', function (e){
        e.preventDefault();
        loadCustomsAdmin('confirm');
    });

    $('button[name = "remove_custom"]').on('click', function (e){
        e.preventDefault();
        loadCustomsAdmin('remove');
    });*/

    //loadCustomsAdmin();

});


function loadCustomsAdmin(edit = null){
    $.ajax({
        url: "load_customs_admin.php",
        method: "POST",
        dataType: "html",
        data:{
            'edit': edit
        },
        success: function (data){
            $('.customs').html(data);
        }
    });
}

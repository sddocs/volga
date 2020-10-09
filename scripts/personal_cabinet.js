$(document).ready(function (){
    //loadCustoms();

   /* $('#custom_status').on('change', function (){
        let status = $(this).val();
        loadCustoms(status);
    });*/

});


function loadCustoms(status = 0){
    $.ajax({
        url: "load_customs.php",
        method: "POST",
        dataType: "html",
        data: {
            'status': status,
        },
        success: function (data){
            $('.customs').html(data);
        }
    });
}
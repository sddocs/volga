$(document).ready(function (){

    $('#custom_status').on('change', function (){
        let status = $(this).val();
        $.ajax({
            url: "filter.php",
            method: "POST",
            dataType: "html",
            data:{
                'custom_status': status,
            },
            success: function (data){
                $('.customs').html(data);
            }
        });
    });

    $('#search_start').on('click', function (e){
        e.preventDefault();
        let search = $('#search').val();
        $.ajax({
            url: "search.php",
            method: "POST",
            dataType: "html",
            data:{
                'search': search,
            },
            success: function (data){
                $('.customs').html(data);
            }
        });
    });

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
$(document).ready(function(){
    ajaxDatatable('#userpins-list', userPinListURL);
    //date filter
    $('.date_filter').change(function(e){
        e.preventDefault();
        var value = $(this).val();
        if( value == 'custom' ){
            $(this).parent().hide();
            $('#custom_date').show();
        } else {
            $('#custom_date').hide();
        }
    })
    //clear map filter
    $('.clear_filter').click(function(){
        $('#custom_date').hide();
        $('.date_filter').parent().show();
        $('#search_pin_form').trigger("reset");
        $('#search_filter').trigger("reset");
    })
    $('#filter').click( function(){
        if( $('#grid_filter').hasClass('d-none') ){
            $('#grid_filter').removeClass('d-none');
            $('#grid').removeClass('col-md-12').addClass('col-md-9');
        } else {
            $('#grid_filter').addClass('d-none');
            $('#grid').removeClass('col-md-9').addClass('col-md-12');
        }
        $('table').css('width','100%');
    })

    $('#export_data').click( function(e){
        e.preventDefault()
        ajax_request( base_url + '/admin/user-pin/export-data', 'POST', $('#search_filter').serialize() )
            .then( (res) => {
                if( res.error ){
                    alert(res.message);
                } else {
                    let file_url = base_url + '/' + res.data + '/' + res.data + '.csv';
                    window.location.href = file_url;
                    setTimeout( function(){
                        $.post(base_url + '/admin/user-pin/export-file',{filename:res.data})
                    },2000)
                }
            })
    });

})
var ajaxDatatable = (element,source_url = '') => {

    var ids;
    var action;
    if(source_url == ''){
        source_url = window.location.href + '/ajax-listing'
    }
    table = $(element).DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        searching: false,
        "deferRender": true,
        "ajax":{
            url :source_url,
            type: "POST",
            beforeSend : function(){
                $('.overlay').show();
                $('.progress').removeAttr('style');
                $('.progress').css({width: '20%'});
                timer = window.setInterval(ProgressBar, 2000);
                $('button').attr('disabled','disabled');
            },
            data : function(d) {
                d._csrf = $('meta[name="csrf-token"]').attr('content');
                d.custom_search = $("form#search_filter").serialize();
            },
            error: function(){  // error handling

            }
        },
        drawCallback: function (settings) {
            // other functionality
            progress_status = 20;
            $('button').removeAttr('disabled');
            window.clearInterval(timer);
            $('.progress').css({width: '80%'});
            setTimeout(function() {
                $('.progress').css({width: '100%'});
                $('.overlay').hide();
                $('.progress').hide()
            },2000);
        },
        lengthMenu: [
            [10, 20, 50, 100, 200],
            [10, 20, 50, 100, 200] // change per page values here
        ],
        pageLength: 10,// default record count per page
		
        //order: typeof tableSorting == 'undefined' ? [0, 'desc'] : tableSorting, //created at column sorting
        
        createdRow: function( row, data, dataIndex ) {
            if( (dataIndex % 2) == 1 ){
                $( row ).addClass('t-row-color');
            }
        }
    
    });

    

    let visible_order    = [];
    let un_visible_order = [];

    $('.pin_column').each( function () {
        var order = parseInt($(this).attr('data-order'));
        if( $(this).is(':checked')){
            visible_order.push(order);
        } else {
            un_visible_order.push(order);
        }
    })

    // table.columns(visible_order).visible( true );
    // table.columns(un_visible_order).visible( false );

    // $('.pin_column').on( 'click', function(){
    //      var order = $(this).attr('data-order');
    //      if( $(this).is(':checked')){
    //          table.columns( [order] ).visible( true );
    //     } else {
    //          table.columns( [order] ).visible( false );
    //     }
    //     let column_length = $('table tr th').length;
    //     if( column_length > 5 && column_length <= 11 ){
    //         $('table').css('width','1700px');
    //     }else if (column_length > 10 && column_length <= 15){
    //         $('table').css('width','2500px');
    //     } else if (column_length > 15 && column_length <= 21){
    //         $('table').css('width','3000px');
    //     }else {
    //         $('table').css('width','100%');
    //     }
    // })

    $('#search_filter_btn, .search_filter_btn').click( function(e){
        e.preventDefault();
        var date_filter = $('select[name="date_filter"]').val();
        if( date_filter == 'custom' ){
            let from_date = $('input[name="from_date"]').val();
            let to_date   = $('input[name="to_date"]').val();
            if( from_date == '' ){
                alert("From Date field is required");
                return;
            }
            if( to_date == '' ){
                alert("To Date field is required");
                return;
            }
            from_date = new Date(from_date);
            to_date   = new Date(to_date);

            if( from_date.getTime() > to_date.getTime() ){
                alert("From Date is not valid");
                return;
            }
        }
        table.ajax.reload();
    })

    $('.dt_select_all').on('click',function(){
        var attr_name = $(this).attr('name');
        if($(this).is(':checked')){
            $('.' + attr_name).prop('checked',true);
            $('select[name="action"]').show();
        }else{
            $('.' + attr_name).prop('checked',false);
            $('select[name="action"]').hide();
        }
    });

    $(document).on('click','.ids',function(){
        if($('.ids:checked').length > 0){
            $('select[name="action"]').show()
        }else{
            $('select[name="action"]').hide()
        }
    });

    $('select[name="action"]').on('change',function(e){
        e.preventDefault();
        ids = [];
        $('.ids:checked').each(function(){
            ids.push($(this).val());
        });
        action = $(this).val();
        var selector = this;
        if(action != ''){
            alertify.confirm("Alert","Are you sure you want to continue?",function(){
                    let url =  window.location.href + "/action";
                    $.ajax({
                        type : "POST",
                        url  : url.replace('#',''),
                        data : {ids:ids , action:action, _csrf:_token},
                        success : function(data){
                            if(data == 'denied'){
                                alertify.error("<p>You don't have a permission to delete this record.</p>");
                                return false;

                            }else if(data == 'error'){
                                alertify.error("<p>You can't delete this record because it is used in some modules.</p>");
                                return false;
                            }else{
                                alertify.set('notifier','position', 'top-right');
                                if(action == 'delete'){
                                    alertify.success("<p>Record has been deleted successfully.</p>");
                                }else{
                                    alertify.success("<p>Record has been updated successfully.</p>");
                                }
                                $('.dt_select_all').prop('checked',false);
                                $(selector).hide();
                                table.ajax.reload();
                            }
                        }
                    });

            },function(){

            });
            $('.alertify-button-ok').show();
        }
    })

    //delete select row
    $(document).on('click','.delete_row',function(){
        $(this).parent().parent().find('input.ids').prop('checked',true);
        $('select[name="action"]').val('delete').change();
    });

    //reset fields
    $('.reset_fields').click(function(e){
        e.preventDefault()
        $('table').find('input, textarea, select').val('');
        table.ajax.reload();
    });
}

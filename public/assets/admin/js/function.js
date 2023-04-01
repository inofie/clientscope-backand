'use strict'
var _token;
var progress_status = 20;
var timer;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'TOKEN': 'api.Pd*!(5675',
        "USER-TOKEN": currentUser.token ? currentUser.token : ''
    }
});
var  ProgressBar = () => {
    if(progress_status < 70) {
        progress_status = (parseInt(progress_status) + 10 );
        $('.progress').css({
            width: progress_status + '%'
        });
    }
}
var ajax_form_submitted = (form,error_element,success_element) => {
    $(document).on('submit',form,function(e){
        e.preventDefault();
        var form_ele = $(this);
        $(error_element).hide();
        $(success_element).hide();
        var submit_text = $(this).find('button[type="submit"]').html();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#overlay').show();
                $('#ajaxLoader').show();
                $('button').attr('disabled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
                form_ele.find('button[type="submit"]').html('Submitting....');
            },
            success: function(data){
                $('#overlay').hide();
                $('#ajaxLoader').hide();
                form_ele.find('button[type="submit"]').html(submit_text);
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
                if( data.error ){
                    var error_html = '<div class="alert alert-danger">';
                    for( var key in data.data ){
                        error_html += '<p>'+ data.data[key] +'</p>';        
                    }
                    error_html += '</div>';
                    $(error_element).html(error_html);
                    $(error_element).show();    
                }  else {
                    $(form)[0].reset();
                    var success_html = '<div class="alert alert-success">'+ data.message +'</div>';
                    $(success_element).html(success_html);
                    $(success_element).show();
                    setTimeout(function(){
                        $('.modal').modal('hide');    
                        if( data.redirect ){
                            window.location.href = data.redirect_url;
                            return;
                        }
                    },2000);
                }
            },
            error: function(jqXHR, exception){
                $('#overlay').hide();
                form_ele.find('button[type="submit"]').html(submit_text);
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');

                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }        
            }
        });
    })        

} 
var ajax_request = (url, method, params = {}) => {

    return new Promise( (resolve,reject) => {
        $.ajax({
            type: method,
            url: url,
            data: params,
            beforeSend: function(){
                $('#overlay').show();
                $('#ajaxLoader').show();
                $('button').attr('disbaled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#ajaxLoader').hide();
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');            
                resolve(data);
            },
            error: function(jqXHR, exception) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }
            }
        });
    })
}

var autoComplete = (element, url) => {

    $(element).autoComplete({
        resolver: 'custom',
        events: {
            search: function (qry, callback) {
                $.ajax(
                    url,
                    {
                        data: { 'string': qry}
                    }
                ).done(function (res) {
                    callback(res)
                });
            }
        }
    });
}

$(function () {

    $(document).ajaxComplete(function(event,xhr,options){
        if( xhr.status == 401 ){
            window.location.href = base_url + '/admin/login';
            return false;
        }
    })

    $('.select2').select2();

    $('input, select').on('focus', function () {
        $(this).parent().find('.input-group-text').css({'border-color':'#F58719','color':'#F58719','background': '#FEEDDD'});
    });

    $('input, select').on('blur', function () {
        $(this).parent().find('.input-group-text').css({'border-color':'#ced4da','color':'gray','background':'#F5F5F5'});
    });
    $('textarea').on('focus', function () {
        $(this).parent().find('.input-group-text').css({'color':'#F58719','background': '#FEEDDD'});
    });
    $('textarea').on('blur', function () {
        $(this).parent().find('.input-group-text').css({'color':'gray','background':'#F5F5F5'});
    });

    $('[data-toggle="tooltip"]').tooltip()

    $(document).on('hidden.bs.modal','.modal', function () {
       $('.error_div').html('');
       $('.error_div').hide();
       $('.success_div').html('');
       $('.success_div').hide();
        $('._ajax_modal').html('');
    });


    $('.slide-toggle').click(function(event){
        event.stopPropagation();
        $(".menu-box").toggle();
    });
    $(".menu-box").on("click", function (event) {
        event.stopPropagation();
        var id = event.target.dataset.target;
        $(id).collapse('toggle');

    });
    $(".privacyPolicy").on("click", function (event) {
        $('#privacyPolicy').modal()
    });
    $(".termsConditions").on("click", function (event) {
        $('#termsConditions').modal()
    });

    $(document).on("click", function () {
        $(".menu-box").hide();
    });

    $('._add_user').click( function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.attr('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#add_user_modal').html(data.html);
                $('.select2').select2();
                var target_modal = element.data('target');
                $(target_modal).modal('show');

            }
        })
    })

    $('._add_pin').click( function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.attr('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#add_pin_modal').html(data.html);
                $('.select2').select2();
                var target_modal = element.data('target');
                $(target_modal).modal('show');

            }
        })
    })

    $('._add_appointment').on('click', function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.data('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#add_appointment_modal').html(data.html);
                $('.select2').select2();
                var target_modal = element.data('target');
                $(target_modal).modal('show');
            }
        })
    })

    $('._addStatus').on('click', function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.data('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#add_status_modal').html(data.html);
                $('.select2').select2();
                var target_modal = element.data('target');
                $(target_modal).modal('show');
            }
        })
    });

    $('._editStatus').on('click', function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.attr('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#edit_status_modal').html(data.html);
                $('.select2').select2();
                var target_modal = element.data('target');
                $(target_modal).modal('show');
            }
        })
    }) 
    $('._editTeam').on('click', function(e){
        e.preventDefault();
        var element = $(this);
        $.ajax({
            type:'GET',
            url: element.attr('href'),
            beforeSend: function(){
                $('#overlay').show();
            },
            success: function(data){
                $('#overlay').hide();
                $('#edit_team_modal').html(data.html);
                var target_modal = element.data('target');
                $(target_modal).modal('show');
            }
        })
    })  
    var page_no = 1
    $(document).on('click','#_load_more_notification',function(e){
        e.stopPropagation();
        page_no++;
        getNotifiction(page_no);
    })
    //get notification
    getNotifiction(page_no);
});

function getNotifiction(page_no = 1)
{
      $.ajax({
       type:'GET',
       url: base_url + '/api/notification',
       headers: {"token": "api.Pd*!(5675", "user-token":currentUser.token},
       data:{page:page_no},
       success : function(res){
          let notification_html = '';
          if( res.data.length > 0 ){
              for(var i=0; i < res.data.length; i++ )
              {
                  let redirect_link = '#';
                  if( res.data[i].identifier == 'add_user_pin' ){
                      redirect_link = base_url + '/admin/map?user_pin_id=' + res.data[i].reference_id;
                  }else if(res.data[i].identifier == 'add_territory'){
                    redirect_link = base_url + '/admin/map';
                  }else{
                    redirect_link = base_url + '/admin/chat';
                  }
                  notification_html += '<a class="dropdown-item" href="'+ redirect_link +'">'+ res.data[i].description +'</a>';
                  notification_html += '<div class="dropdown-divider"></div>';
                  
              }
              if( res.pagination.meta.current_page != res.pagination.meta.last_page ){
                   let notification_pagination  = '<div class="dropdown-divider"></div>';
                       notification_pagination += '<a id="_load_more_notification" class="dropdown-item text-center"><b>Load More</b></a>';
                   $('#notification_pagination').html(notification_pagination);   
              }else{
                  $('#notification_pagination').remove();
              }
          }else{
              notification_html += '<a class="dropdown-item">No data found</a>'; 
          }
          $('#notification_list').append(notification_html);
       }
    })
}

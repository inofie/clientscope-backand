<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" sizes="16x16">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" /> 
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
      <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' />
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase-messaging.js"></script>
       @stack('stylesheets')
      <title>Client Scope</title>
      <script>
         var base_url      = '{{ URL::to('/') }}';
         var current_url   = '{{ Request::url() }}';
         var currentUser   = JSON.parse(`{!! get_user() !!}`);
         var node_chat_url = '{{ env("NODE_CHAT_URL") }}';
         var table;
      </script>
      <style>
         .menu_active{
            color: #f5891e !important;
         }
      </style>
   </head>
   <body>
      <div id="ajaxLoader">
          <img src="{{ asset('images/ajax-loader.gif') }}">
      </div>
      <div id="overlay"></div>
      <section>
         @yield('content')
      </section>
      @include('admin.modal.change-password')
      @include('admin.modal.edit-profile')
      <div class="_ajax_modal" id="add_user_modal"></div>
      <div class="_ajax_modal" id="edit_user_modal"></div>
      <div class="_ajax_modal" id="add_pin_modal"></div>
      <div class="_ajax_modal" id="update_pin_modal"></div>
      <div class="_ajax_modal" id="add_appointment_modal"></div>
      <div class="_ajax_modal" id="add_status_modal"></div>
      <div class="_ajax_modal" id="edit_appointment_modal"></div>
      <div class="_ajax_modal" id="edit_status_modal"></div>
      <div class="_ajax_modal" id="edit_team_modal"></div>
      <div style="display:none;">
        <audio id="_notification_sound">
          <source src="{{ URL::to('notification.mp3') }}">
        </audio>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
      <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
      <script type='text/javascript' src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
      <script type='text/javascript' src='https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js'></script>
      <script type='text/javascript' src='https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js'></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
      <script src="{{ base_url('/assets/admin/js/function.js') }}"></script>
      <script src="{{ base_url('/assets/admin/js/datatable-ajax.js') }}"></script>
      <script src="{{ base_url('/assets/admin/js/custom.js') }}"></script>
      <script src="{{ asset('assets/admin/js/cloud-message.js') }}"></script>
      @stack('scripts')
      <script>
         $('#sidebar').find('a[data-name]').each( function(){  
            var link = $(this).attr('data-name');
            var current_url = window.location.href;
            if( current_url == link){
               $('.active-icon').addClass('d-none');
               $(this).find('.non-active-icon').addClass('d-none');
               $(this).find('.active-icon').removeClass('d-none');
               $(this).find('.active-icon').addClass('d-block');
               $(this).parent().addClass('side-active');
               return;
            }
         })
      </script>
   </body>
</html>
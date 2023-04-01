<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
      <title>Client Scope</title>
   </head>
<!--    <body class= "{{ !empty($body_class) ? $body_class : '' }}">    -->
     <body>

      <section>
         @yield('content')
      </section>
      <div class="modal fade new-modal" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                  <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form>
                     <div class="row">
                        <div class="form-group col-md-6">
                           <label>Password</label>
                           <input type="text" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                           <label>New Password</label>
                           <input type="text" name="new_password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group col-md-6">
                           <label>Confirm Password</label>
                           <input type="text" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-save" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-close">Save changes</button>
               </div>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <script>
         $(function () {
             $('input, select').on('focus', function () {
                 $(this).parent().find('.input-group-text').css({'border-color':'#F58719','color':'#F58719','background': '#FEEDDD'});
             });
             $('input, select').on('blur', function () {
                 $(this).parent().find('.input-group-text').css({'border-color':'#ced4da','color':'gray','background':'#F5F5F5'});
             });
         
         });
      </script>
   </body>
</html>
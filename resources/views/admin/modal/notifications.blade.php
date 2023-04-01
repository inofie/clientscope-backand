<div class="modal fade new-modal" id="notification" tabindex="-1" role="dialog" aria-labelledby="notification" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="notificationTitle">Notifications</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="notificationForm" method="POST" enctype="multipart/form-data" action="">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="row">
                  <div class="col-md-12">
                     <div id="notificationFormError" class="error_div"></div>
                     <div id="notificationFormSuccess" class="success_div"></div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-md-12 pb-3 pt-3">
                     <div class="d-flex justify-content-between">
                        <div>Appointment</div>
                        <div>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="customSwitch1">
                              <label class="custom-control-label" for="customSwitch1"></label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 pb-3">
                     <div class="d-flex justify-content-between">
                        <div>User add new pins</div>
                        <div>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="customSwitch2">
                              <label class="custom-control-label" for="customSwitch2"></label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="form-group col-md-12 pb-3">
                     <div class="d-flex justify-content-between">
                        <div>New pin assigned to you</div>
                        <div>
                           <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="customSwitch3">
                              <label class="custom-control-label" for="customSwitch3"></label>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-save">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
 @push('scripts')
 <script>
    ajax_form_submitted('#notificationForm','#notificationFormError','#notificationFormSuccess');
 </script>
 @endpush
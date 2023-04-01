<div class="modal fade new-modal" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered add-modal edit-profile-img" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-24" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="change_password_form" class="pt-3 pl-3" method="post" action="{{ route('admin.change-password') }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="change_password_error" class="error_div"></div>
                        <div id="change_password_success" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        {{-- <label>Current Password</label> --}}
                        <input type="password" name="current_password" class="form-control form-control2 focus-color" placeholder="Current Password">
                    </div>
                    <div class="form-group col-md-12">
                        {{-- <label>New Password</label> --}}
                        <input type="password" name="new_password" class="form-control form-control2 focus-color" placeholder="New Password">
                    </div>
                    <div class="form-group col-md-12">
                        {{-- <label>Confirm Password</label> --}}
                        <input type="password" name="confirm_password" class="form-control form-control2 focus-color" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-2">
            <button type="button" class="btn btn-close btn-theme2" data-dismiss="modal">
            <ul class="d-flex align-items-center justify-content-center">
              <li>-</li>
              <li>Cancel</li>
            </ul>
          </button>
          <button type="submit" class="btn btn-save btn-theme">
          <ul class="d-flex align-items-center justify-content-center">
              <li>+</li>
              <li>Save</li>
            </ul>  
         </button>
            </div>
        </form>    
    </div>
    </div>
</div>
@push('scripts')
    <script>
        ajax_form_submitted('#change_password_form','#change_password_error','#change_password_success')
    </script>
@endpush
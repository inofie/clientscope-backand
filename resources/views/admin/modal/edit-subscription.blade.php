<div class="modal fade new-modal" id="edit_admin_subscription_modal" tabindex="-1" role="dialog" aria-labelledby="edit_admin_subscription" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="edit_admin_subscription">Edit Subscription</h5>
             <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form method="POST" id="edit_subscription_form" action="{{ route('admin.subscription.update') }}" enctype="multipart/form-data">
              <input type="hidden" name="subscription_id" value="" />
             <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="edit_subscription_error" class="error_div"></div>
                        <div id="edit_subscription_success" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                            <label>Subscription expire date</label>
                            <input type="date" required id="expire_date" name="expire_date" value="" class="form-control" placeholder="Start expire ate">
                            @if($errors->has('expire_date'))
                              <p class="text-danger">{{ $errors->first('expire_date') }}</p>
                            @endif
                        </div>
                 </div>
                <div class="row">
                   <div class="form-group col-md-12">
                      <label>Status</label>
                      <select name="status" class="form-control" required>
                         <option value="">Select Status</option> 
                         <option value="active">Active</option>
                         <option value="cancel">Cancel</option>  
                         <option value="expired">Expired</option>  
                      </select>
                   </div>
                </div>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-save">Update</button>
             </div>
          </form>
       </div>
    </div>
 </div>

 <script>
    $(document).ready(function(){
        ajax_form_submitted('#edit_subscription_form','#edit_subscription_error','#edit_subscription_success');
    })
</script>
<div class="modal fade new-modal" id="edit_admin_user_modal" tabindex="-1" role="dialog" aria-labelledby="edit_admin_user" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="edit_admin_user">Edit User</h5>
             <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form method="POST" action="{{ route('admin.update-all-user') }}">
              <input type="hidden" name="user_id" value="" />
             <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                   <div class="form-group col-md-12">
                      <label>Status</label>
                      <select name="status" class="form-control" required>
                         <option value="">Select Status</option> 
                         <option value="1">Active</option>
                         <option value="2">Disabled</option>  
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
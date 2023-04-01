<div class="modal fade new-modal" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Group</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form id="_add_chat_group" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               {{ csrf_field() }}
               <div class="row">
                  <div class="form-group col-md-12">
                     <label>Group Image</label>
                     <input type="file" name="group_image" accept="image/*" id="group_image" class="form-control" placeholder="Image">
                  </div>
                  <div class="form-group col-md-12">
                     <label>Group Title</label>
                     <input type="text" name="group_title" id="group_title" value="" class="form-control" required>
                  </div>
                  <div class="form-group col-md-12">
                     <label>Add Users</label>
                     <select name="group_users[]" id="group_users" class="form-control select2" multiple="multiple" required>
                        @if( count($users) )
                           @foreach($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                           @endforeach
                        @endif
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-save">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
@push('scripts')
<script>
   $(document).ready(function(){
       ajax_form_submitted('#edit_profile_form','#edit_profile_error','#edit_profile_success')        
   })
</script>
@endpush
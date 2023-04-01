<div class="modal fade new-modal" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="addTeamModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="addTeamTitle">Add Team</h5>
             <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form id="addTeamForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.add-team') }}">
             <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                   <div class="col-md-12">
                      <div id="addTeamFormError" class="error_div"></div>
                      <div id="addTeamFormSuccess" class="success_div"></div>
                   </div>
                </div>
                <div class="row">
                   <div class="form-group col-md-12">
                      <label>Team Title</label>
                      <input type="text" name="title" class="form-control" placeholder="Team title" required>
                   </div>
                </div>
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-save">Add Team</button>
             </div>
          </form>
       </div>
    </div>
 </div>
 @push('scripts')
 <script>
    ajax_form_submitted('#addTeamForm','#addTeamFormError','#addTeamFormSuccess');
 </script>
 @endpush
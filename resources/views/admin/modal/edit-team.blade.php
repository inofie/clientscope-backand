<div class="modal fade new-modal" id="editTeamModal" tabindex="-1" role="dialog" aria-labelledby="data-target" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editStatusTitle">Update Team</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editTeamForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.edit-team') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $team->id }}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="editTeamFormError" class="error_div"></div>
                        <div id="editTeamFormSuccess" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $team->title ? $team->title : ''}}" class="form-control" placeholder="Team Title">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-save">Update Team</button>
            </div>
        </form>    
    </div>
    </div>
</div>
<script>
    ajax_form_submitted('#editTeamForm','#editTeamFormError','#editTeamFormSuccess');
</script>
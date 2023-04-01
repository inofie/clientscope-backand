<div class="modal fade new-modal" id="edtCompanyContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Content</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin-content-update') }}">
            <input type="hidden" name="content_id" value="{{ $record->id }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Content</label>
                        <textarea id="editor1" name="content" class="form-control" placeholder="Content" required>{{ $record->content }}</textarea>
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
<script>
    $(document).ready( function(){
        CKEDITOR.replace( 'editor1' );
    })
</script>

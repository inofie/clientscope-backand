<div class="modal fade new-modal" id="addCompanyFAQ" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="add_faq_form" method="POST" enctype="multipart/form-data" action="{{ route('admin.save-faq') }}">
            <input type="hidden" name="status_id" value="1">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="add_faq_error" class="error_div"></div>
                        <div id="add_faq_success" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Question</label>
                        <input type="text" name="question" value="" class="form-control" placeholder="Question" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Answer</label>
                        <input type="email" name="answer" value="" class="form-control" placeholder="Answer" required>
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
            ajax_form_submitted('#add_faq_form','#add_faq_error','#add_faq_success');
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        })
    </script>
@endpush
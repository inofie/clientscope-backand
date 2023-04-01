<div class="modal fade new-modal" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="add_company_form" method="POST" enctype="multipart/form-data" action="{{ route('admin.save-company') }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="add_company_error" class="error_div"></div>
                        <div id="add_company_success" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" value="" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" value="" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" value="" class="form-control" placeholder="Confirm Password">
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
            ajax_form_submitted('#add_company_form','#add_company_error','#add_company_success');
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        })
    </script>
@endpush
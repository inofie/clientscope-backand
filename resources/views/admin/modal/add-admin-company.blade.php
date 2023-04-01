<div class="modal fade new-modal" id="addCompanySubscription" tabindex="-1" role="dialog" aria-labelledby="addCompanySubscription" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="appointmentFormTitle">Add Company</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addCompanySubscritionForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.store-company') }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="addCompanySubscritionFormError" class="error_div"></div>
                        <div id="addCompanySubscritionFormSuccess" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                    <label>Subscription Package</label>
                        <select name="subscription_packages_id" class="form-control select2">
                            <option value="">Select Subscription Package</option>
                            @foreach ($subscriptionPackages as $subscriptionPackage )
                                <option value="{{$subscriptionPackage->id}}">{{$subscriptionPackage->title}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('subscription_packages_id'))
                            <p class="text-danger">{{ $errors->first('subscription_packages_id') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" id="name" value="{{old("name")}}" class="form-control" placeholder="Company name">
                        @if($errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" id="email" name="email" value="{{old("email")}}" class="form-control" placeholder="Company email">
                        @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                         @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>Mobile no</label>
                        <input type="text" id="mobile_no" name="mobile_no" value="{{old("mobile_no")}}"  value="" class="form-control" placeholder="Mobile no">
                        @if($errors->has('mobile_no'))
                             <p class="text-danger">{{ $errors->first('mobile_no') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" value="" class="form-control" placeholder="Company password">
                        @if($errors->has('password'))
                          <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label>Confirm password</label>
                        <input type="password" name="confirm_password" value="" class="form-control" placeholder="Company confirm password">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Subscription expire date</label>
                        <input type="date" required name="expire_date" value="{{old("expire_date")}}" class="form-control" placeholder="Start expire date">
                        @if($errors->has('expire_date'))
                          <p class="text-danger">{{ $errors->first('expire_date') }}</p>
                        @endif
                    </div>
              
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="subscription_status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="expired">expired</option>
                            <option value="active">active</option>
                        </select>
                        @if($errors->has('subscription_status'))
                        <p class="text-danger">{{ $errors->first('subscription_status') }}</p>
                      @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-save">Add Company</button>
            </div>
        </form>    
    </div>
    </div>
</div>
@push('scripts')
 <script>
    ajax_form_submitted('#addCompanySubscritionForm','#addCompanySubscritionFormError','#addCompanySubscritionFormSuccess');
 </script>
 @endpush
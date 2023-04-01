<style>
    input[readonly="readonly"]{
        cursor: not-allowed;
    }
</style>
<div class="modal fade new-modal" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg add-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-24" id="exampleModalLabel">Add User</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="add_user_form" method="POST" enctype="multipart/form-data" action="{{ env('APP_URL') . '/admin/add-user' }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="add_user_error" class="error_div"></div>
                        <div id="add_user_success" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Name</label>
                        <input type="text" name="name" value="" class="form-control" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Email Adress</label>
                        <input type="text" name="email" value="" class="form-control" placeholder="Email Address" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Phone Number</label>
                        <input type="number" name="mobile_no" value="" class="form-control" placeholder="Phone No (1112223333)" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Reports To</label>
                        <select name="user_report" class="form-control">
                            <option value=""> Select User </option>
                            @if( count($companyUsers) )
                                @foreach($companyUsers as $companyUser)
                                    <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Title</label>
                        <input type="text" name="user_meta[title]" value="" class="form-control" placeholder="title">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="font-14 color-4e5164 font-600">Assign To Team</label>
                        <select name="team_id" class="form-control">
                            <option value=""> Select Team </option>
                            @if( count($companyTeams) )
                                @foreach($companyTeams as $companyTeam)
                                    <option value="{{ $companyTeam->id }}">{{ $companyTeam->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-3">
                        <h4 class="font-weight-bold">User Sales Plan</h4>
                        <small class="ft-14"> This data is used to determine Users Yearly, Monthly and Weekly Targets.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Revenue Per Sale Amount</label>
                        <input type="text" name="revenue_per_sale_amount" id="user_revenue_per_sale_amount" class="form-control" placeholder="Revenue Per Sale Amount">
                    </div>
                    <div class ="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Average Commission Per Sale</label>
                        <input type="text" name="average_commission_per_sale" id="user_average_commission_per_sale" class="form-control" placeholder="Average Commission Per Sale">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">User Annual Income Target</label>
                        <input type="text" name="user_annual_income_target" id="user_annual_income_target" class="form-control" placeholder="User Annual Income Target">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Total Work Months Left To Sell</label>
                        <input type="text" name="total_work_month_left_to_sell" id="user_total_work_month_left_to_sell" class="form-control" placeholder="Total Work Months Left To Sell">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Total Work Weeks Left To Sell</label>
                        <input type="text" name="total_work_week_left_to_sell" id="user_total_work_week_left_to_sell" class="form-control" placeholder="Total Work Weeks Left To Sell">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Total Contracts Needed</label>
                        <input type="text" readonly="readonly" name="total_contracts_needed" id="user_total_contracts_needed" class="form-control" placeholder="Total Contracts Needed">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Total Annual Sales Needed</label>
                        <input type="text" readonly="readonly" name="total_annual_sales_needed" id="user_total_annual_sales_needed" class="form-control" placeholder="Total Annual Sales Needed">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="my-3 font-weight-bold">Company Metric Targets</h4>
                    </div>
                    @if( count($metrices) )
                        @foreach( $metrices as $metrice )
                            <div class="form-group col-md-4">
                                <label>{{ !empty($metrice->custom_metric_title) ? $metrice->custom_metric_title : $metrice->title }} (%)</label>
                                <input type="text" value="{{ $metrice->company_metric_value }}" name="metric[{{ $metrice->slug }}]" id="user_{{ $metrice->slug }}" class="form-control" placeholder="{{ $metrice->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                     <div class="col-md-12 mb-3 mt-3">
                        <h4 class="font-weight-bold">User Annual KPI Targets</h4>
                        <small class="ft-14"> to hit sales rep income target</small>
                    </div>
                    @if( count($kpi_groups) )
                        @foreach( $kpi_groups as $kpi_group )
                            <div class="form-group col-md-4">
                                <label>{{ $kpi_group->title }}</label>
                                <input type="text" readonly="readonly" id="user_annual_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_annual_target][{{ $kpi_group->slug }}]" class="form-control" placeholder="{{ $kpi_group->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-3">
                        <h4 class="font-weight-bold">User Monthly KPI Targets</h4>
                        <small class="ft-14"> to hit sales rep income target</small>
                    </div>
                    @if( count($kpi_groups) )
                        @foreach( $kpi_groups as $kpi_group )
                            <div class="form-group col-md-4">
                                <label>{{ $kpi_group->title }}</label>
                                <input type="text" readonly="readonly" id="user_monthly_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_monthly_target][{{ $kpi_group->slug }}]" class="form-control" placeholder="{{ $kpi_group->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 mt-3">
                        <h4 class="font-weight-bold">User Weekly KPI Targets</h4>
                        <small class="ft-14"> to hit sales rep income target</small>
                    </div>
                    @if( count($kpi_groups) )
                        @foreach( $kpi_groups as $kpi_group )
                            <div class="form-group col-md-4">
                                <label>{{ $kpi_group->title }}</label>
                                <input type="text" readonly="readonly" id="user_weekly_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_weekly_target][{{ $kpi_group->slug }}]" class="form-control" placeholder="{{ $kpi_group->title }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="my-3 font-weight-bold">Pin Permissions</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Can View</label>
                        <select name="user_meta[pin_view_permission]" class="form-control" required>
                            <option value="own_subordinate">Own</option>
                            <option value="own_subordinate_peer">Own & Sales Rep</option>
                            <option value="own_subordinate_peer_manager">Own, Sales Rep & Team Lead</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-14 color-4e5164 font-600">Can Edit</label>
                        <select name="user_meta[edit_permission]" class="form-control" required>
                            <option value="own_subordinate">Own</option>
                            <option value="own_subordinate_peer">Own & Sales Rep</option>
                            <option value="own_subordinate_peer_manager">Own, Sales Rep & Team Lead</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="my-3 font-weight-bold">User Permissions</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-check" style="display: flex;">
                            <input type="checkbox" value="1" name="user_meta[is_administrator]" class="form-check-input">
                            <label class="form-check-label">Is Administrator</label>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-check" style="display: flex;">
                            <input type="checkbox" value="1" name="user_meta[manage_user]" class="form-check-input">
                            <label class="form-check-label">Can Manage Users</label>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-check" style="display: flex;">
                            <input type="checkbox" value="1" name="user_meta[can_import_pin]" class="form-check-input">
                            <label class="form-check-label">Can Import Pins</label>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group form-check" style="display: flex;">
                            <input type="checkbox" value="1" name="user_meta[share_report]" class="form-check-input">
                            <label class="form-check-label">Can Share Reports</label>
                          </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-close btn-theme2" data-dismiss="modal">
            <ul class="d-flex align-items-center justify-content-center">
              <li>-</li>
              <li>Cancel</li>
            </ul>
          </button>
          <button type="submit" class="btn btn-save btn-theme">
          <ul class="d-flex align-items-center justify-content-center">
              <li>+</li>
              <li>Confirm</li>
            </ul>  
         </button>
            </div>
        </form>    
    </div>
    </div>
</div>
<script src="{{ asset('assets/admin/js/user_sales_plan.js') }}"></script>
<script>
    $(document).ready(function(){
        ajax_form_submitted('#add_user_form','#add_user_error','#add_user_success');
    })
</script>

@extends('admin.master')
@section('content')
@include('admin.include.navbar')
@push('stylesheets')
   <style>
      input[readonly="readonly"]{
         cursor: not-allowed;
      }
   </style>
@endpush
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <div id="content" class="p-4">
      <div class="row pb-3">
         <div class="col-md-12">
            <h4 class="heading2 font-30">Company Sales Plan</h4>
         </div>
         <form id="company_sales_form" method="post" action="">
            {{ csrf_field() }}
            <div class="col-md-12">
               @include('admin.flash-message')
               <div class="white-box2">
                  <div class="row mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company Sales Targets</h4>
                     </div>
                     <div class="col-md-8">
                        <div class="row new-modal mt-2">
                           <div class="col-md-4">
                              <label>Company Annual Sales Target</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="company_annual_sales_target" value="{{ !empty($companySalePlan->company_annual_sales_target) ? round($companySalePlan->company_annual_sales_target) : '' }}" name="company_annual_sales_target" class="form-control form-control2" placeholder="Company Annual Sales Target" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >$</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label>Company Year To Date Sold</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="company_year_to_date_sold" value="{{ !empty($companySalePlan->company_year_to_date_sold) ? round($companySalePlan->company_year_to_date_sold) : '' }}" name="company_year_to_date_sold" class="form-control form-control2" placeholder="Company Year To Date Sold" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >$</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <label>Left To Sell</label>
                              <div class="input-group mb-3">
                                 <input type="text" required id="left_to_sell" readonly="readonly" value="{{ !empty($companySalePlan->left_to_sell) ? $companySalePlan->left_to_sell : '' }}" name="left_to_sell" class="form-control form-control2" placeholder="Left To Sell" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >$</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label>Company Average Revenue Per Sale</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="company_average_revenue_per_sale" value="{{ !empty($companySalePlan->company_average_revenue_per_sale) ? round($companySalePlan->company_average_revenue_per_sale) : '' }}" name="company_average_revenue_per_sale" class="form-control form-control2" placeholder="Company Average Revenue Per Sale" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >$</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label>Work Weeks Left For The Year</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="work_week_left_for_the_year" value="{{ !empty($companySalePlan->work_week_left_for_the_year) ? round($companySalePlan->work_week_left_for_the_year) : '' }}" name="work_week_left_for_the_year" class="form-control form-control2" placeholder="Work Weeks Left For The Year" autocomplete="off">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label>Work Months Left For The Year</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="work_month_left_for_the_year" value="{{ !empty($companySalePlan->work_month_left_for_the_year) ? round($companySalePlan->work_month_left_for_the_year) : '' }}" name="work_month_left_for_the_year" class="form-control form-control2" placeholder="Work Months Left For The Year" autocomplete="off">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 calculation">
                        <div class="form-group">
                           <label>Company Sales Needed Per Week ($)</label>
                           <input type="text" required readonly="readonly" value="{{ !empty($companySalePlan->company_sales_needed_per_week) ? $companySalePlan->company_sales_needed_per_week : '' }}" id="company_sales_needed_per_week" name="company_sales_needed_per_week" class="form-control form-control2 text-center" placeholder="Company Sales Needed Per Week" autocomplete="off">
                        </div>
                        <div class="form-group">
                           <label>Company Sales Needed Per Month ($)</label>
                           <input type="text" required readonly="readonly" value="{{ !empty($companySalePlan->company_sales_needed_per_month) ? $companySalePlan->company_sales_needed_per_month : '' }}" id="company_sales_needed_per_month" name="company_sales_needed_per_month" class="form-control form-control2 text-center" placeholder="Company Sales Needed Per Month" autocomplete="off">
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company Staffing Plan</h4>
                     </div>
                     <div class="col-md-8">
                        <div class="row new-modal mt-2">
                           <div class="col-md-12">
                              <label>Active Company Sales Rep</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="active_company_sales_rep" value="{{ !empty($companySalePlan->active_company_sales_rep) ? round($companySalePlan->active_company_sales_rep) : '' }}" name="active_company_sales_rep" class="form-control form-control2" placeholder="Active Company Sales Rep" autocomplete="off">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label>Average Annual Sales Per Sales Rep</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="average_annual_sales_per_sales_reps" value="{{ !empty($companySalePlan->average_annual_sales_per_sales_reps) ? round($companySalePlan->average_annual_sales_per_sales_reps) : '' }}" name="average_annual_sales_per_sales_reps" class="form-control form-control2" placeholder="Average Annual Sales Per Sales Rep" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >$</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <label>New Hire Retention Rate</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="new_hire_rentention_rate" value="{{ !empty($companySalePlan->new_hire_rentention_rate) ? round($companySalePlan->new_hire_rentention_rate) : '' }}" name="new_hire_rentention_rate" class="form-control form-control2" placeholder="New Hire Retention Rate" autocomplete="off">
                                 <div class="input-group-append">
                                    <span class="input-group-text" >%</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 calculation">
                        <div class="form-group">
                           <label>Total Sales Reps Needed</label>
                           <input type="number" required id="total_sales_reps_needed" value="{{ !empty($companySalePlan->total_sales_reps_needed) ? $companySalePlan->total_sales_reps_needed : '' }}" readonly="readonly" name="total_sales_reps_needed" class="form-control form-control2 text-center" placeholder="Company Sales Needed Per Week" autocomplete="off">
                        </div>
                        <div class="form-group">
                           <label>New Hires Needed <small>taking into account retention rate</small></label>
                           <input type="number" required id="new_hire_needed" readonly="readonly" value="{{ !empty($companySalePlan->new_hire_needed) ? $companySalePlan->new_hire_needed : '' }}" name="new_hire_needed" class="form-control form-control2 text-center" placeholder="Company Sales Needed Per Month" autocomplete="off">
                        </div>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company Metric Targets</h4>
                     </div>
                  </div>
                  <div class="row new-modal mt-2">
                     @if( count($metrices) )
                        @foreach( $metrices as $metric )
                           <div class="col-md-2">
                              <label>{{ !empty($metric->custom_metric_title) ? $metric->custom_metric_title : $metric->title }} (%)</label>
                              <div class="input-group mb-3">
                                 <input type="number" required id="{{ $metric->slug }}" value="{{ round($metric->value) }}" name="metric[{{ $metric->slug }}]" class="form-control form-control2" placeholder="{{ $metric->title }}" autocomplete="off">
                              </div>
                           </div>
                        @endforeach
                     @endif
                  </div>
                  <div class="row new-modal mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Total Company Wide KPI Targets To Hit Sales Target</h4>
                     </div>
                     @if( count($kpi_groups) )
                        @foreach($kpi_groups as $kpi_group)
                           <div class="form-group col-md-4">
                              <label>{{ $kpi_group->title }}</label>
                              <input type="number" required readonly="readonly" id="wide_{{ $kpi_group->slug }}" name="kpi_target_sale[total_company_wide_kpi_targets][{{ $kpi_group->id }}]" value="" class="form-control" placeholder="{{ $kpi_group->title }}">
                           </div>
                        @endforeach
                     @endif
                  </div>
                  <div class="row new-modal mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company KPI Annual Targets To Hit Sales Target <small class="ft-14">per active rep from above</small></h4>
                     </div>
                     @if( count($kpi_groups) )
                        @foreach($kpi_groups as $kpi_group)
                           <div class="form-group col-md-4">
                              <label>{{ $kpi_group->title }}</label>
                              <input type="number" required readonly="readonly" id="annual_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_annual_target][{{ $kpi_group->id }}]" value="" class="form-control" placeholder="{{ $kpi_group->title }}">
                           </div>
                        @endforeach
                     @endif
                  </div>
                  <div class="row new-modal mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company KPI Monthly Targets To Hit Sales Target <small class="ft-14">per active rep from above</small></h4>
                     </div>
                     @if( count($kpi_groups) )
                        @foreach($kpi_groups as $kpi_group)
                           <div class="form-group col-md-4">
                              <label>{{ $kpi_group->title }}</label>
                              <input type="number" required readonly="readonly" id="monthly_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_monthly_target][{{ $kpi_group->id }}]" value="" class="form-control" placeholder="{{ $kpi_group->title }}">
                           </div>
                        @endforeach
                     @endif
                  </div>
                  <div class="row new-modal mt-3">
                     <div class="col-md-12">
                        <h4 class="heading2 font-30">Company KPI Weekly Targets To Hit Sales Target <small class="ft-14">per active rep from above</small></h4>
                     </div>
                     @if( count($kpi_groups) )
                        @foreach($kpi_groups as $kpi_group)
                           <div class="form-group col-md-4">
                              <label>{{ $kpi_group->title }}</label>
                              <input type="number" required readonly="readonly" id="weekly_{{ $kpi_group->slug }}" name="kpi_target_sale[kpi_weekly_target][{{ $kpi_group->id }}]" value="" class="form-control" placeholder="{{ $kpi_group->title }}">
                           </div>
                        @endforeach
                     @endif
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-save btn-theme">Confirm</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
   @push('scripts')
      <script src="{{ asset('assets/admin/js/company_sales.js') }}"></script>
   @endpush
@endsection
@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<style>
.form-control2,
.form-control2:focus,
.select2-container--default .select2-selection--multiple,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    background: #fff;
}
</style>
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-4">
        <div class="row ">
            <div class="col-md-12">
                <h4 class="heading2 font-semi-bold font-30 color-f58719">Dashboard</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <p class="color-black font-600">Sales Plan Performance</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="d-flex ft-14 justify-content-between filter-box2">
                    <div class="font-weight-bold">Attempts Per Contact</div>
                    <div id="attepmt_per_contact" class="font-weight-bold"></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="d-flex ft-14 justify-content-between filter-box2">
                    <div class="font-weight-bold"> Attempts Per Lead</div>
                    <div id="attempt_per_lead" class="font-weight-bold"></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="d-flex ft-14 justify-content-between filter-box2">
                    <div class="font-weight-bold">Attempts Per Sale</div>
                    <div id="attempt_per_sale" class="font-weight-bold"></div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="d-flex ft-14 justify-content-between filter-box2">
                    <div class="font-weight-bold">Reknocked</div>
                    <div id="reknocked" class="font-weight-bold"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="ft-14 font-weight-bold">Yearly Target</p>
                    <div id="kpi_annual_target"></div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14 font-weight-bold">Monthly Target</p>
                    <div id="kpi_monthly_target"></div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14 font-weight-bold">Weekly Target</p>
                    <div id="kpi_weekly_target"></div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6  col-xl-3 mb-3">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="text-uppercase ft-14 font-weight-bold">sales leaderboard</p>
                    <div id="leader_board"></div>
                </div>
            </div>
        </div>
        <div class="row mb-5 mt-5">
            <p style="width:100%; text-align:right;">
                <span data-target="#time_section_chart" class="hide_section" data-toggle="collapse">Hide Section</span>
            </p>
            <div class="col-md-12">
                <div id="time_section_chart" class="row collapse show">
                    <div class="col-md-12 col-lg-6">
                        <h5 class="color-f58719">
                            Best Knock Time
                        </h5>
                        <div id="knock_time_section" class="chart filter-box2 collapse show">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <h5 class="color-f58719">
                            Best Knock Day
                        </h5>
                        <div class="chart filter-box2 collapse show">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="title">
                        <h5 class="color-f58719 font-22">
                            My Performance
                            <!-- <span data-target="#my_performance_filter" data-toggle="collapse"><i class="fa fa-filter"></i></span> -->
                            <!-- <span data-target="#performance_section" class="hide_section" data-toggle="collapse"> hide dsection</span> -->
                        </h5>
                    </div>
                    <div class="btn -area">
                        <button data-target="#my_performance_filter" data-toggle="collapse" class="filter-btn">
                            <ul class="d-flex algn-items-center justify-content-center">
                                <li>
                                    <img src="{{ asset('assets/images/filter-img.png') }}" alt="{{ get_user()->name }}">
                                </li>
                                <li>
                                    <p>Filter</p>
                                </li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <form id="my_performance_filter" class="filter-sec mb-3 collapse">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 ">
                    <div class="form_group">
                        <label>Date Range From </label>
                        <input type="date" name="date_from" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 ">
                    <div class="form_group">
                        <label>Date Range To</label>
                        <input type="date" name="date_to" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="form_group">
                        <label>Territory</label>
                        <select name="territory[]" multiple class="form-control select2">
                            <option value="">--Select Territory--</option>
                            @if( count($territories) )
                            @foreach( $territories as $territory )
                            <option value="{{ $territory->title }}">{{ $territory->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="form_group">
                        <label>Chart Type</label>
                        <select name="chart_type[]" id="my_performance_chart_type" class="form-control select2"
                            multiple>
                            <option value="kpi_group_datatable_section" selected>KPI Group Data Table</option>
                            <option value="metric_data_table_section" selected>Metric Data Table</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 col-xl-2 " style="margin-top: 30px;">
                    <div class="form_group search-area">
                        <button type="submit" class="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div id="performance_section" class="row collapse show">
            <div class="col-md-12 col-xl-6 mb-3" id="kpi_group_datatable_section">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="font-18 font-weight-bold">{{ get_user()->name }}</p>
                    <div id="kpi_group_performance"></div>
                </div>
            </div>
            <div class="col-md-12 col-xl-6 mb-3" id="metric_data_table_section">
                <div class="filter-box2" style="height:380px;overflow-y: auto;">
                    <p class="font-18 font-weight-bold">{{ get_user()->name }}</p>
                    <div id="metric_performance"></div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="title">
                        <h5 class="color-f58719 font-22">
                            My Territory Performance
                            <!-- <span data-target="#territory_performance_filter" data-toggle="collapse"><i class="fa fa-filter"></i></span>
                              <span data-target="#territory_performance" class="hide_section" data-toggle="collapse">Hide Section</span> -->
                        </h5>
                    </div>
                    <div class="btn -area">
                        <button data-target="#territory_performance_filter" data-toggle="collapse" class="filter-btn">
                            <ul class="d-flex algn-items-center justify-content-center">
                                <li>
                                    <img src="{{ asset('assets/images/filter-img.png') }}" alt="{{ get_user()->name }}">
                                </li>
                                <li>
                                    <p>Filter</p>
                                </li>
                            </ul>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <form id="territory_performance_filter" class="collapse mb-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 ">
                    <div class="form_group">
                        <label>Date Range From</label>
                        <input type="date" name="date_from" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2">
                    <div class="form_group">
                        <label>Date Range To</label>
                        <input type="date" name="date_to" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="form_group">
                        <label>Territory</label>
                        <select name="territory[]" multiple class="form-control select2">
                            <option value="">--Select Territory--</option>
                            @if( count($territories) )
                            @foreach( $territories as $territory )
                            <option value="{{ $territory->title }}">{{ $territory->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="form_group">
                        <label>Chart Type</label>
                        <select name="chart_type[]" id="territory_performance_chart_type" class="form-control select2"
                            multiple>
                            <option value="territory_kpi_group_datatable" selected>KPI Group Data Table</option>
                            <option value="territory_metric_data_table" selected>Metric Data Table</option>
                            <option value="territory_kpi_group_bar_chart" selected>KPI Group Bar Chart</option>
                            <option value="territory_metric_bar_chart" selected>Metric Bar Chart</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 col-xl-2" style="margin-top: 30px;">
                    <div class="form_group search-area">
                        <button type="submit" class="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div id="territory_performance" class="collapse show"></div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="title">
                        <h5 class="color-f58719 font-22">
                            My Team Performance
                            <!-- <span data-target="#team_performance_filter" data-toggle="collapse"><i class="fa fa-filter"></i></span> -->
                            <!-- <span data-target="#team_performance" class="hide_section" data-toggle="collapse">Hide Section</span> -->
                        </h5>
                    </div>
                    <div class="btn -area">
                        <button data-target="#team_performance_filter" data-toggle="collapse" class="filter-btn">
                            <ul class="d-flex algn-items-center justify-content-center">
                                <li>
                                <img src="{{ asset('assets/images/filter-img.png') }}" alt="{{ get_user()->name }}">
                                </li>
                                <li>
                                    <p>Filter</p>
                                </li>
                            </ul>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <form id="team_performance_filter" class="collapse mb-3">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 ">
                    <div class="form_group">
                        <label>Date Range From</label>
                        <input type="date" name="date_from" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-2 ">
                    <div class="form_group">
                        <label>Date Range To</label>
                        <input type="date" name="date_to" class="form-control" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="form_group">
                        <label>Territory</label>
                        <select name="territory[]" multiple class="form-control select2">
                            <option value="">--Select Territory--</option>
                            @if( count($territories) )
                            @foreach( $territories as $territory )
                            <option value="{{ $territory->title }}">{{ $territory->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                    <div class="form_group">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 col-xl-2 " style="margin-top: 30px;">
                    <div class="form_group search-area">
                        <button type="submit" class="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </form>
        <div id="team_performance" class="collapse show"></div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<script src="{{ asset('assets/admin/js/sr-dashboard.js') }}"></script>
@endsection
@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<style>
.labels {
    color: red;
    background-color: white;
    font-family: "Lucida Grande", "Arial", sans-serif;
    font-size: 10px;
    font-weight: bold;
    text-align: center;
    width: 40px;
    border: 2px solid black;
    white-space: nowrap;
}
input[type="date"]:after {
    top: -24px;
    position: inherit;
    float: right;
    display: inline-block;
}
</style>
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-0">
        <div id="map">
        </div>
        <h1 class="map-title color-f58719">Map</h1>
        <div class="box">
            <div class="btn-group" role="group" aria-label="Basic example">
                <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="user_pin_filter territory-filter filter nav-link active d-flex align-items-center justify-content-center "
                            id="pills-filter-tab" data-toggle="pill" href="#pills-filter" role="tab">
                            <img src="{{ asset('assets/images/black-filter.png') }}" />
                            <p>Filter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="territory territory-filter nav-link d-flex align-items-center justify-content-center "
                            id="pills-terr-tab" data-toggle="pill" href="#pills-terr" role="tab">
                            <img src="{{ asset('assets/images/fil-ter.png') }}" />
                            <p>Territories</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content bg-white" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-filter" role="tabpanel"
                    aria-labelledby="ills-filter-tab">
                    <form id="search_pin_form" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="filter_error_msg"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="font-600 color-0087 text-center font-20">Choose some filters</p>
                                <p>Choose some filters <span style="cursor:pointer;" class="text-danger pull-right clear_filter">Clear filter</span></p>
                                <div class="input-group mb-3 territories-input ">
                                    <input type="text" name="address" id="googleautocomplete"
                                        onfocus="GoogleAutoComplete()" class="form-control"
                                        placeholder="Search">
                                    <input type="hidden" name="search_latitude" id="search_latitude" value="37.09024">
                                    <input type="hidden" name="search_longitude" id="search_longitude"
                                        value="-95.712891">
                                    <div class="search-icon">
                                        <span>
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group new-select2">
                                    <label>Territory</label>
                                    <select data-placeholder="Territory" id="territory" name="territory[]" class="form-control select2" multiple>
                                        <option value=""> Inspection Area </option>
                                        @if (count($getTerritories))
                                        @foreach ($getTerritories as $getTerritory)
                                        <option value="{{ $getTerritory->id }}">{{ $getTerritory->title }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group new-select2">
                             <label>Assigned To</label>
                             <select data-placeholder="Assigned To" id="assignedto" name="assignee_user_id[]" multiple class="form-control select2">
                            @if (count($companyUsers))
                            @foreach ($companyUsers as $companyUser)
                            <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                            @endforeach
                            @endif
                             </select>
                          </div>
                                <div class="form-group new-modal">
                                    <label>Date Updated</label>
                                    <input type="date" name="updated_at" class="form-control" placeholder="Updated At">
                                </div>
                                <div class="form-group new-modal new-input">
                                    <label>Date Status Modified</label>
                                    <input type="date" name="status_modified_date" class="form-control"
                                        placeholder="Date">
                                </div>
                                <div class="form_group">
                                    <label>Date Created</label>
                                    <select name="date_filter" class="form-control date_filter form-control2">
                                        <option value="">Select Date Range</option>
                                        <option value="today">Today</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="this_ween">This Week</option>
                                        <option value="last_week">Last Week</option>
                                        <option value="this_month">This Month</option>
                                        <option value="last_month">Last Month</option>
                                        <option value="this_year">This Year</option>
                                        <option value="last_year">Last Year</option>
                                        <option value="custom">custom</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="custom_date" style="display: none;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" placeholder="From Date" value=""
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>To Date</label>
                                <div class="form-group">
                                    <input type="date" name="to_date" placeholder="To Date" value=""
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        @if (count($companyStatuses))
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group boder">
                                    <h5 class="font-weight-bold color-3f3d56">Status</h5>

                                </div>
                                <div class="form-check mb-3 mt-4">
                                    <input type="checkbox" name="select_all_status" value="1" class="form-check-input"
                                        id="select_all_status">
                                    <label class="form-check-label" for="select_all_status"> Select All</label>
                                </div>
                                @foreach ($companyStatuses as $companyStatus)
                                <div class="d-flex flex-row justify-content-between mb-3 ft-14">
                                    <div class="first-cell">
                                        <div class="form-check">
                                            <input type="checkbox" name="pin_status_id[]"
                                                value="{{ $companyStatus->id }}" class="form-check-input"
                                                id="exampleCheck{{ $companyStatus->id }}">
                                            <label class="form-check-label color-gray"
                                                for="exampleCheck{{ $companyStatus->id }}">{{ $companyStatus->title }}</label>
                                        </div>
                                    </div>

                                    <div>1%</div>

                                    <div> {{ $companyStatus->status_count }}
                                        <span class="pl-1">
                                            <img style="width:16px; height: 16px; object-fit: contain;"
                                                src="{{ $companyStatus->image_url }}">
                                            <img style="width:16px; height: 16px; object-fit: contain;"
                                                src="{{ asset('assets/images/map-icon.png') }}">
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-save btn-theme">Search</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-terr" role="tabpanel" aria-labelledby="pills-terr-tab">
                    <form id="add_territory_form" method="post">
                        <input type="hidden" name="geofence_detail" id="territory_latlng" value="">
                        <input type="hidden" name="center_point" id="add_center_point" value="">
                        <div class="row territory_form" style="display:none;">
                            <div class="form-group col-md-12">
                                <h5 class="font-weight-bold font-24 color-4e5164">Add Territory</h5>
                                <hr />
                            </div>
                            <div class="d-flex form-group col-md-12 align-items-center">
                                <div class="mr-auto font-18 font-semi-bold color-4e5164">Choose the color</div>
                                <div class="colorComponent"> <input type="color" class="favcolor" id="favcolor"
                                        name="color" value="#ff0000" required></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-semi-bold color-4e5164">Name</label>
                                <input type="text" name="title" id="territory_title" value=""
                                    class="form-control form-control2" required>
                            </div>
                            <!-- <div class="form-group col-md-12">
                          <label>Universe</label>
                          <input type="number" name="universe" id="universe" value="" class="form-control form-control2" required>
                       </div> -->
                            <div class="form-group col-md-12 new-select">
                                <label class="font-semi-bold color-4e5164">Assign User</label>
                                <select name="assignee_user_id[]" id="territory_user_id" multiple
                                    class="form-control form-control2 select2" required>
                                    @if (count($companyUsers))
                                    @foreach ($companyUsers as $companyUser)
                                    <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="bnt-area mt-4  d-flex align-items-center justify-content-center">
                                <div class="form-group ">
                                    <button type="submit" class="btn btn-save btn-block btn-theme">
                                        <ul class=" d-flex align-items-center justify-content-center">
                                            <li>+</li>
                                            <li>Save</li>
                                        </ul>
                                    </button>
                                </div>
                                <div class="form-group ml-4">
                                    <button type="button" class="btn cencel-btn btn-block territory-close btn-theme2">
                                        <ul class=" d-flex align-items-center justify-content-center">
                                            <li>-</li>
                                            <li>Cancel</li>
                                        </ul>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="col-12">
                            <a href="#"
                                class="color-danger d-flex align-items-center justify-content-center mt-5 clear-filter">Clear
                                Territory
                                on Map</a>
                        </div>
                    </form>
                    <form id="update_territory_form" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="geofence_detail" id="edit_territory_latlng" value="">
                        <input type="hidden" name="territory_id" id="territory_id" value="">
                        <input type="hidden" name="center_point" id="edit_center_point" value="">
                        <div class="row edit_territory_form" style="display:none;">
                            <div class="form-group col-md-12">
                                <h5 class="font-weight-bold font-24">Edit Territory</h5>
                                <hr />
                            </div>
                            <div class="d-flex form-group col-md-12 align-items-center">
                                <div class="mr-auto font-18 font-semi-bold">Choose the color</div>
                                <div class="colorComponent"> <input type="color" class="favcolor" id="favcolor"
                                        name="color" value="#ff0000" required></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Name</label>
                                <input type="text" name="title" id="territory_title" value=""
                                    class="form-control form-control2" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Universe</label>
                                <input type="number" name="universe" id="universe" value=""
                                    class="form-control form-control2" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Assign User</label>
                                <select name="assignee_user_id[]" id="territory_user_id" multiple
                                    class="form-control form-control2 territory_user_id" required>
                                    @if (count($companyUsers))
                                    @foreach ($companyUsers as $companyUser)
                                    <option value="{{ $companyUser->id }}">{{ $companyUser->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-save btn-block btn-theme">Save</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button type="button"
                                    class="btn btn-close btn-block territory-close btn-theme2">Cancel</button>
                            </div>
                            <div class="form-group col-md-12 text-center">
                                <a href="#" class="text-underline font-semi-bold theme-color">Clear Territory on Map</a>
                            </div>
                        </div>
                    </form>

                    <div class="territory_list">
                        <div class="input-group mb-2 territories-input">
                            <input type="text" name="territories_search" id="territories_search" class=""
                                placeholder="Search Territory Name">
                            <div class="search-icon">

                                <span>
                                    <i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="d-flex flex-row justify-content-between pt-4 territorE-border">
                            <h5 class="font-weight-bold mb-0 color-3f3d56">Territories
                                ({{ $territories->pagination->meta->total }})
                            </h5>
                            <div class="add_territory"><span class="fa fa-plus color-3f3d56"></span></div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" checked name="select_all_territory" value="1"
                                    class="select_all_territory form-check-input">
                                <label class="form-check-label">Select All Territories</label>
                            </div>
                        </div>
                        @if (count($territories->data))
                        @foreach ($territories->data as $territory)
                        <div class="d-flex flex-row justify-content-between mb-3 ft-14">
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" checked id="territory_id" name="territory_id[]" value="{{ $territory->id }}"
                                        class="select_territory form-check-input">
                                    <label class="form-check-label color-c840e9">{{ $territory->title }}</label>
                                </div>
                            </div>
                            <div class="dropdown territory-edit-dropdown">
                                <span class="fa fa-cog" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </span>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit_territory" data-record="{{ json_encode($territory) }}"
                                        href="javascript:void(0)">Edit Territory</a>
                                    <a class="dropdown-item move_territory" data-record="{{ json_encode($territory) }}"
                                        href="javascript:void(0)">Move Map To Territory</a>
                                    <a class="dropdown-item delete_territory" id="{{ $territory->id }}"
                                        href="javascript:void(0)">Delete Territory</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
var user_pin = `{!! !empty($user_pin) ? json_encode($user_pin) : '' !!}`;
user_pin = user_pin.length > 0 ? JSON.parse(user_pin) : '';
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places,drawing&callback=initMap">
</script>
<script src="{{ asset('assets/admin/js/map.js') }}"></script>
@endpush
@endsection
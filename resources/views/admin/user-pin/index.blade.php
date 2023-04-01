@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-4">
        <div class="row ">
            <div class="col-12"></div>
         <h1 class="list-title">List</h1>
            
        </div>
        <div class="row d-none">
            <div class="col-md-3">
               <button id="filter" type="button" class="btn bg-orange filter w-100 mb-2">
                    <img src="{{ asset('assets/images/filter3.png') }}" />
                </button>
            </div>
            <div class="col-md-3">
                <a href="#" id="export_data" class="btn bg-orange" style="color:#fff;">Export Data</a>
            </div>
            <div class="col-md-6 position-relative">
                <div class="dropdown position-absolute" style="right:12px;">
                    <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fa fa-cog"></i>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right setting-col">
                        @foreach( config('constants.PIN_GRID_COLUMN') as $value )
                        <span class="dropdown-item ft-14">
                            <label for="address">
                                <input type="checkbox" {{ $loop->index > 4 ? '' : 'checked' }}
                                    data-order="{{ $loop->index }}" id="{{ str_slug($value,'_') }}"
                                    name="{{ str_slug($value,'_') }}" class="pin_column">
                                {{ $value }}
                            </label>
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12  col-lg-4 col-xl-3 ">
                <form id="search_filter">
                    <div class="filter-box">
                        <p class="font-600 color-0087  filter-title">Filters</p>
                        <p class="font-600 color-0087  font-18">Choose some filters</p>
                        <div class="input-group  territories-input ">
                            <input type="text" name="keyword" id="" class="form-control filter_keyword" placeholder="Search Projects">
                            <div class="search-icon">
                                <span>
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="status-text boder ">
                            <h5 class="font-weight-bold color-3f3d56 status-title">Status</h5>
                        </div>
                        <div class="mt-4">
                            @if( count($companyStatuses) )
                                @foreach ( $companyStatuses as $companyStatus )
                                <div class="d-flex flex-row justify-content-between mb-3 ft-14 status-detail">
                                    <div class="first-cell">
                                        <div class="form-check">
                                            <input type="checkbox" name="pin_status_id[]" value="{{ $companyStatus->id }}" class="form-check-input filter_status" id="filter_status_{{ $companyStatus->id }}">
                                            <label class="form-check-label color-gray" for="filter_status_{{ $companyStatus->id }}">{{ $companyStatus->title }}</label>
                                        </div>
                                    </div>
                                    <div>1%</div>
                                    <div>
                                        <span class="pl-1">
                                            <span>{{ $companyStatus->status_count }}</span>
                                            <img style="width:16px; height: 16px; object-fit: contain;" src="{{ asset('assets/images/map-icon.png')}}">
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            <div class="form-group text-center mt-3">
                                <button type="submit" id="search_filter_btn" class="btn btn-save">Search</button>
                            </div>
                        </div>
                    </div>
                </form>    
            </div>
            <div class="col-12 col-md-12 col-lg-8 col-xl-9">
                <div class="table-row table-responsive">
                    <table id="userpins-list" class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="w-14 ">Address</th>
                                <th scope="col" class="w-14 ">Status</th>
                                <th scope="col" class="w-14 ">Created By</th>
                                <th scope="col" class="w-14 ">Created Date</th>
                                <th scope="col" class="w-14 ">Updated By</th>
                                <th scope="col" class="w-14 ">Updated Time</th>
                                <th scope="col" class="w-14 ">Assigned To</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@push('scripts')
<script>
var tableSorting = [16, 'desc'];
var userPinListURL = '{{ route("admin.userpins.list") }}';
</script>
<script src="{{ asset('assets/admin/js/user-pin.js') }}"></script>
@endpush
@endsection
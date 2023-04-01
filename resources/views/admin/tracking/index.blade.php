@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <div id="content" class="p-0">
      <div id="map"></div>
      <h1 class="map-title color-f58719">User Track</h1>
      <div class="box">
         <div style="width:100%;" class="btn-group d-none" role="group" aria-label="Basic example" >
            <ul style="width:100%;" class="nav nav-pills mb-2" id="pills-tab" role="tablist">
               <li style="width:100%;" class="nav-item">
                  <a style="width:100%;" class="user_pin_filter filter nav-link active" id="pills-filter-tab" data-toggle="pill" href="#pills-filter" role="tab"><img src="{{asset('assets/images/filter1.png')}}"/></a>
               </li>
            </ul>
         </div>
         <div class="tab-content bg-white" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-filter" role="tabpanel" aria-labelledby="ills-filter-tab">
               <form id="search_pin_form" method="get">
                  <div class="row">
                     <div class="col-md-12">
                        <div id="filter_error_msg"></div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <p class="font-20 color-black font-600 mb-5">Filters</p>
                        <div class="form-group">
                           <label class="color-black font-500">Select User</label>
                           <select data-placeholder="Select User" name="user_id" class="select2 form-control form-control2">
                              <option value=""></option>
							         @if( count($salesRepresentative) )
                                 @foreach( $salesRepresentative as $sr )
                                    <option value="{{ $sr->id }}">{{ $sr->name }}</option>
                                 @endforeach
                              @endif
                           </select>
                        </div>
                        <div class="form-group new-modal">
                           <label  class="color-black font-500">Tracking Date</label>
                           <select name="date" id="tracking_date" class="form-control">
                              <option value="">-- Select Tracking Date -- </option>
                           </select>
                           
                           <input type="date" class="date-input" placeholder="Select Tracking Date">
                        </div>
                     </div>
                  </div>
                  <div class="form-group text-center mt-3">
                     <button type="submit" class="btn btn-save">Search</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@push('scripts')
<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places,drawing&callback=initMap"></script>
<script src="{{ asset('assets/admin/js/user-tracking.js') }}"></script>
<script>
   $('.user_pin_filter').click( function(e){
      e.preventDefault();
      if( $('.box').find('.d-none').length > 0 ){
         $('#pills-tabContent').removeClass('d-none');
      } else {
         $('#pills-tabContent').addClass('d-none');
      }
   })
   $( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
@endpush
@endsection
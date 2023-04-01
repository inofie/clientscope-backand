@extends('admin.master') @section('content') @push('stylesheets')
<link
   rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css"
   />
<link rel="stylesheet" href="{{ asset('assets/admin/css/calendar.css') }}" />
@endpush @include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <!-- Page Content  -->
   <div id="content" class="p-5">
      <div class="d-flex align-items-center justify-content-between appoit-text">
         <div>
            <h2 class="color-f58719 font-30">Appointment</h2>
         </div>
         <div>
            <button class=" add-appoit _add_appointment btn-block " data-href="{{ route('admin.add-appointment') }}" data-target="#addAppointment">
               <ul class="d-flex align-items-center justify-content-center">
                  <li><img src="{{ asset('assets/images/ic_event.png') }}" /></li>
                  <li>Add New Appointment</li>
               </ul>
            </button>
         </div>
      </div>
      <div class="row">
		<div class="col-9">
			<div id='calendar'></div>
		 </div>
         <div class="col-3">
            <div class="appoit-filter-box">
               <div class="head">
                  <h3 class="font-26 color-f58719">Filters</h3>
               </div>
               <div class="filter-body">
                  {{-- 
                  <div class="d-flex justify-content-between mb-2">
                     <div class="font-14">
                        Show only available dates in calendar (Planner)
                     </div>
                     <div class="custom-control custom-switch">
                        <input
                           type="checkbox"
                           class="custom-control-input"
                           id="customSwitch1"
                           />
                        <label class="custom-control-label" for="customSwitch1"></label>
                     </div>
                  </div>
                  --}}
                  <div class="mt-4 mb-2">
                     <label class="ft-12 color-3f3d56 font-600">Default Calendar</label>
                     <select name="pin_status_id" class="form-control user-select select2" id="selectEmplyeeUser" required>
                        <option value="">Select User</option>
                        @if( count($users) )
							@foreach( $users as $companyUser )
								<option value="{{ $companyUser->id }}">{{ $companyUser->name }} </option>
							@endforeach
						@endif
                     </select>
                  </div>
                  <div class="calender-user">
                     <div
                        class="company-users d-flex align-items-center justify-content-between mb-4"
                        >
                        <div>
                           <p class="font-14 color-3f3d56 font-600">COMPANY CALENDAR</p>
                        </div>
                        <div>
                           <p style="cursor: pointer;" id="selectAllEmployees" class="ft-12 color-f58719 font-600">Select all</p>
                        </div>
                     </div>
					 @if( count($users) )
					 	@foreach( $users as $companyUser )
							<div class="d-flex justify-content-between mb-2 align-items-center user-calendar-post border-bottom">
								<div class="ft-12 text-uppercase font-weight-bold">
								<div class="media align-items-center mb-1">
									<img
										src="{{ $companyUser->image_url }}"
										alt="user-img"
										class="user-img"
										/>
									<div class="media-body">
										<p class="mt-0 mb-0 text-capitalize">{{ $companyUser->name }}</p>
									</div>
								</div>
								</div>
								<div class="ft-12">
								<div class="form-check">
									<input name="company_users[]"
										class="selectEmployee form-check-input position-static selectEmployee"
										id="{{$companyUser->username.$companyUser->id}}" value="{{$companyUser->id}}"
										type="checkbox"
										/>
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
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
<script src="{{ asset('assets/admin/js/calendar.js') }}"></script>
<script>
   let events;
   events = `{!! json_encode($events) !!}`;
   addAppointmentsToCalendar({!! json_encode($events) !!});
</script>
@endpush @endsection
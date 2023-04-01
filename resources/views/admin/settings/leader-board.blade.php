@extends('admin.master') @section('content') @include('admin.include.navbar')
<form id="leader_board_form">
	<div class="wrapper d-flex align-items-stretch">
		@include('admin.include.sidebar')
		<div id="content" class="p-4 lb-bg-height">
			<div class="row">
				<div class="col-md-12">
					<h5 class="heading2 font-30 color-f58719">Leaderboard</h5>
				</div>
				<div class="col-md-12 mt-4">
					<div class=" new-modal lb-white-box">
						<div class="row">
							<div class="col-md-6"></div>
							<div class="form-group col-md-3">
								<label>Time Frame</label>
								<select
									name="time_frame"
									class="form-control time_frame lb-select-bg"
								>
									<option value="">Select Time Frame</option>
									<option value="today">Today</option>
									<option value="yesterday">Yesterday</option>
									<option value="this_week">This Week</option>
									<option value="last_week">Last Week</option>
									<option value="this_month">This Month</option>
									<option value="last_month">Last Month</option>
									<option value="this_year">This Year</option>
									<option value="last_year">Last Year</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Kpi Group</label>
								<select
									name="kpi_group_id"
									class="form-control kpi_group_id lb-select-bg"
								>
									<option value="">Select Kpi Group</option>
									@if( count($kpi_groups) ) @foreach( $kpi_groups as $kpi_group
									)
									<option value="{{ $kpi_group->id }}">
										{{ $kpi_group->title }}
									</option>
									@endforeach @endif
								</select>
							</div>
						</div>
						<div id="leader_board"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@push('scripts')
<script src="{{ asset('assets/admin/js/leader-board.js') }}"></script>
@endpush @endsection

<div class="modal fade new-modal" id="addAppointment" tabindex="-1" role="dialog" aria-labelledby="addAppointment" aria-hidden="true">
    <div class="modal-dialog modal-lg add-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="appointmentFormTitle">Add Appointment</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="addAppointmentForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.add-appointment') }}">
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div id="addAppointmentFormError" class="error_div"></div>
                        <div id="addAppointmentFormSuccess" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <p class="font-18 color-4e5164"> Assign to Pin</p>
                    <!-- <label>Assign to Pin</label> -->
                        <select name="user_pin_id" class="form-control select2">
                            <option value="">To find pin write name or address</option>
                            @if( count($pins) )
                                @foreach( $pins as $companyPin )
                                    <option value="{{ $companyPin->id }}">{{ $companyPin->house_address }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <p class="mt-2 font-20 color-4e5164 font-weight-bold">Appointment</p>
                    </div>
                    <div class="form-group col-md-6">
                        <!-- <label>Appointment title</label> -->
                        <input type="text" name="appointment_title" value="" class="form-control" placeholder="Appointment title">
                    </div>
                    <div class="form-group col-md-6">
                        <!-- <label>Assign to calendar</label> -->
                        <select name="assign_to_calender" class="form-control">
                            <option value="">Select User</option>
                            @if( count($users) )
                                @foreach( $users as $companyUser )
                                    <option value="{{ $companyUser->id }}">{{ $companyUser->name }} ({{ $companyUser->email }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <!-- <label>Start Date Time</label> -->
                        <input type="datetime-local" required name="start_datetime" value="" class="form-control" placeholder="Start Date time">
                    </div>
                    <div class="form-group col-md-4">
                        <!-- <label>End Date Time</label> -->
                        <input type="datetime-local" required name="end_datetime" value="" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group col-md-4">
                        <!-- <label>Duration</label> -->
                        <input type="number" name="duration" required value="" class="form-control" placeholder="Duration">
                    </div>
                    <div class="form-group col-md-12">
                        <!-- <label>Note</label> -->
                        <textarea class="form-control" name="appointment_notes" rows="3" placeholder="Note"></textarea>
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
              <li>Save</li>
            </ul>  
         </button>
            </div>
        </form>    
    </div>
    </div>
</div>
    <script>
        // $(document).ready(function(){
            ajax_form_submitted('#addAppointmentForm','#addAppointmentFormError','#addAppointmentFormSuccess')        
        // })
    </script>

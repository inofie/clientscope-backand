<div class="modal fade new-modal" id="editAppointment" tabindex="-1" role="dialog" aria-labelledby="editAppointment" aria-hidden="true">
    <div class="modal-dialog modal-lg  edit-profile-img add-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="appointmentFormTitle">Edit Appointment</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editAppointmentForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.edit-appointment') }}">
            <input type="hidden" name="appointment_id" value="{{ $appointment->id }}" >
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="editAppointmentFormError" class="error_div"></div>
                        <div id="editAppointmentFormSuccess" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <select name="user_pin_id" class="form-control select2">
                            <option value="">Select Pin</option>
                            @if( count($pins) )
                                @foreach( $pins as $companyPin )
                                    <option {{$companyPin->id == $appointment->user_pin_id ? 'selected' : ''}} value="{{ $companyPin->id }}">{{ $companyPin->house_address }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Appointment title</label>
                        <input type="text" name="appointment_title" value="{{ $appointment->title }}" class="form-control" placeholder="Appointment title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Assign to calendar</label>
                        <select name="assign_to_calender" class="form-control">
                            <option value="">Select User</option>
                            @if( count($users) )
                                @foreach( $users as $companyUser )
                                    <option {{$companyUser->id == $appointment->assignee_user_id ? 'selected' : ''}} value="{{ $companyUser->id }}">{{ $companyUser->name }} ({{ $companyUser->email }})</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Start Date Time</label>
                        <input type="datetime-local" name="start_datetime" required value="{{ date("Y-m-d\TH:i:s", strtotime($appointment->start_datetime)) }}" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group col-md-4">
                        <label>End Date Time</label>
                        <input type="datetime-local" name="end_datetime" required value="{{ date("Y-m-d\TH:i:s", strtotime($appointment->end_datetime)) }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Duration</label>
                        <input type="number" name="duration" required value="{{ $appointment->duration }}" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Note</label>
                        <textarea class="form-control" name="appointment_notes" rows="3" placeholder="Appointment notes">{{$appointment->notes}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="button" id="{{ $appointment->id }}"  class="btn btn-danger delete_appointment" data-dismiss="modal">
                        <ul class="d-flex align-items-center justify-content-center">
                            <li>
                            <img id="imagePreview" src="{{ asset('assets/images/drop-dlete.png')}}" alt="" class="img-fluid">
                            </li>
                            <li>Delete</li>
                        </ul>
                    </button>
                    <button type="button" class=" btn btn-danger delete_appointment btn btn-close " data-dismiss="modal">
                        <ul class="d-flex align-items-center justify-content-center">
                            <li>-</li>
                            <li>Cancel</li>
                        </ul>
                    </button>
                    
                    <button type="submit" class="btn btn-save ">
                        <ul class="d-flex align-items-center justify-content-center">
                            <li>+</li>
                            <li>Submit</li>
                        </ul>  
                    </button>
            </div>
        </form>    
    </div>
    </div>
</div>
<script>
    // $(document).ready(function(){
        ajax_form_submitted('#editAppointmentForm','#editAppointmentFormError','#editAppointmentFormSuccess')        
    // })
</script>

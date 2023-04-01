<div class="modal fade new-modal" id="pinDetail" tabindex="-1" role="dialog" aria-labelledby="pinDetail" aria-hidden="true">
    <div class="modal-dialog modal-xl add-modal edit-profile-img" role="document" style="width: 80%;max-width: 80%;">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="appointmentFormTitle">Pin Detail</h5>
             <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form id="pinDetailForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.user-pin.update' , ['id' => $record->id ]) }}">
              {{ csrf_field() }}
              <div class="modal-body">
                <div class="row">
                   <div class="col-md-12">
                      <div id="pinDetailFormError" class="error_div"></div>
                      <div id="pinDetailFormSuccess" class="success_div"></div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-5">
                      <div class="form-row">
                         <div class="form-group col-md-6">
                            <label class="font-14 color-4e5164 font-600">Current Status</label>
                            <select name="pin_status_id" class="form-control">
                               <option value="">Select Status</option>
                                @if( count($companyStatuses) )
                                    @foreach( $companyStatuses as $companyStatus )
                                        <option {{ $record->pin_status_id == $companyStatus->id ? 'selected' : '' }} value="{{ $companyStatus->id }}">{{ $companyStatus->title }}</option>
                                    @endforeach
                                @endif
                            </select>
                         </div>
                         <div class="form-group col-md-6">
                            <label class="font-14 color-4e5164 font-600">Assign To</label>
                            <select name="assignee_user_id" class="form-control">
                               <option value="">Select User</option>
                                @if( count($companyUsers) )
                                    @foreach( $companyUsers as $companyUser )
                                        <option {{ $record->assignee_user_id == $companyUser->id ? 'selected' : '' }} value="{{ $companyUser->id }}">{{ $companyUser->name }}({{ $companyUser->email }})</option>
                                    @endforeach
                                @endif
                            </select>
                         </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">House Number</label>
                              <input type="text" name="house_number" value="{{ $record->house_number }}" class="form-control" placeholder="House Number">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">Street Name</label>
                              <input id="autocomplete" name="house_address" class="form-control" required onfocus="initAutocomplete()" placeholder="Enter your address" type="text" value="{{ $record->house_address }}"/>
                              <input type="hidden" id="latitude" value="{{ $record->latitude }}" name="latitude"/>
                              <input type="hidden" id="longitude" value="{{ $record->longitude }}" name="longitude"/>
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">Unit</label>
                              <input type="text" name="unit" value="{{ $record->unit }}" class="form-control" placeholder="Unit">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">City</label>
                              <input type="text" name="city" value="{{ $record->city }}" class="form-control" placeholder="City">
                          </div>
                          <div class="form-group col-md-6 col-xl-3">
                              <label class="font-14 color-4e5164 font-600">State</label>
                              <input type="text" name="state" value="{{ $record->state }}" class="form-control" placeholder="State">
                          </div>
                          <div class="form-group col-md-6 col-xl-3">
                              <label class="font-14 color-4e5164 font-600">Zip Code</label>
                              <input type="text" name="zipcode" value="{{ $record->zipcode }}" class="form-control" placeholder="Zip Code">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">Name</label>
                              <input type="text" name="name" value="{{ $record->name }}" class="form-control" placeholder="Name">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600">Phone</label>
                              <input type="text" name="phone" value="{{ $record->phone }}" class="form-control" placeholder="Phone">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="font-14 color-4e5164 font-600"  >Email</label>
                              <input type="email" name="email" value="{{ $record->email }}" class="form-control" placeholder="Email">
                          </div>
                          @if( !empty($getCustomFields) )
                              @foreach( $getCustomFields as $customFields )
                                  <div class="form-group col-md-6">
                                      <label>{{ $customFields->label }}</label>
                                      @if( $customFields->field_type == 'text' )
                                          <input type="text" name="custom_fields[{{ $customFields->id }}]" value="{{ $customFields->default_value }}" class="form-control" placeholder="{{ $customFields->label }}">
                                      @else
                                          <textarea class="form-control" name="custom_fields[{{ $customFields->id }}]">{{ $customFields->default_value }}</textarea>
                                      @endif
                                  </div>
                              @endforeach
                          @endif
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12 app-p">
                            <p class="mt-2 color-4e5164 font-20">Appointments</p>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-14 color-4e5164 font-600">Appointment title</label>
                            <input type="text" name="appointment_title[]" value="{{ !empty($record->appointment) ? $record->appointment->title : '' }}" class="form-control" placeholder="Appointment title">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-14 color-4e5164 font-600">Assign to calendar</label>
                            <select name="assign_to_calender[]" class="form-control">
                                <option value="">Select User</option>
                                @if( count($companyUsers) )
                                    @foreach( $companyUsers as $companyUser )
                                        <option {{ $record->assignee_user_id == $companyUser->id ? 'selected' : '' }} value="{{ $companyUser->id }}">{{ $companyUser->name }}({{ $companyUser->email }})</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-14 color-4e5164 font-600">Start Date Time</label>
                            <input type="datetime-local" name="start_datetime[]"  value="{{ !empty($record->appointment) ? date("Y-m-d\TH:i:s", strtotime($record->appointment->start_datetime)) : '' }}" class="form-control" placeholder="Date">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-14 color-4e5164 font-600">End Date Time</label>
                            <input  type="datetime-local" name="end_datetime[]" value="{{ !empty($record->appointment) ? date("Y-m-d\TH:i:s", strtotime($record->appointment->end_datetime)) : '' }}" class="form-control" placeholder="Start">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-14 color-4e5164 font-600">Duration</label>
                            <input type="number" name="duration[]" value="{{ !empty($record->appointment) ? $record->appointment->duration : '' }}" class="form-control" placeholder="Duration">
                        </div>
                        <div class="form-group col-md-12">
                            <label class="font-14 color-4e5164 font-600">Note</label>
                            <textarea class="form-control" name="appointment_notes[]" rows="3">{{ !empty($record->appointment) ? $record->appointment->notes : '' }}</textarea>
                        </div>
                    </div>
                   </div>
                   <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mt-2 font-20 color-4e5164 bg-or-light">History</p>
                            </div>
                           {{--<div class="col-md-8 ft-14 gray text-lg-right align-self-center">Created: 8/18/2020 2:07 AM in Mobile App</div>--}}
                       </div>
                       <div class="row">
                           <div class="col-md-12">
                                <div class="table-responsive modify-table">
                                    <table class="table" style="font-size:10px;">
                                        <thead>
                                          <tr class="bg-grey-light">
                                            <th scope="col">Status</th>
                                            <th scope="col">Who</th>
                                            <th scope="col">When</th>
                                            <th scope="col">Verified</th>
                                            <th scope="col">Distance</th>
                                            <th scope="col">Map it</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @if( count($record->pin_status_history) )
                                            @foreach( $record->pin_status_history as $pin_status_history )
                                              <tr>
                                                <td>{{ $pin_status_history->title }}</td>
                                                <td>{{ $pin_status_history->username }}</td>
                                                <td>{{ date('m-d-Y',strtotime($pin_status_history->created_at)) }} at {{ date('h:i A',strtotime($pin_status_history->created_at)) }}</td>
                                                <td>Yes</td>
                                                <td>13 ft</td>
                                                <td>
                                                <img src="{{ asset('assets/images/map-icon.png')}}" alt="" class="img-fluid">
                                                <img src="{{ $pin_status_history->status_image_url }}" style="width:16px; height:16px; object-fit: contain;">
                                                </td>
                                              </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                      </table>
                                </div>
                           </div>
                       </div>
                   </div>
                </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger delete_pin" id="{{ $record->id }}">
                   <ul class="d-flex align-items-center justify-content-center">
                            <li> <img src="{{ asset('assets/images/ic_delete_forever.png')}}" alt="" class="img-fluid"></li>
                            <li> Delete Pin</li>
                        </ul>
                </button>
                 <button type="button" class="btn btn-close btn-theme" data-dismiss="modal">
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
     ajax_form_submitted('#pinDetailForm','#pinDetailFormError','#pinDetailFormSuccess')
 </script>
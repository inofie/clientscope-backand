<div class="modal fade new-modal" id="addStatus" tabindex="-1" role="dialog" aria-labelledby="addStatus" aria-hidden="true">
    <div class="modal-dialog modal-lg add-status" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title font-24" id="addStatusTitle">Add Status</h5>
             <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form id="addStatusForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.add-status') }}">
             <div class="modal-body">
                {{ csrf_field() }}
                <div class="row">
                   <div class="col-md-12">
                      <div id="addStatusFormError" class="error_div"></div>
                      <div id="addStatusFormSuccess" class="success_div"></div>
                   </div>
                </div>
                <div class="row">
                   <div class="form-group col-md-6">
                      <label>Status Name</label>
                      <input type="text" name="title" class="form-control" placeholder="Status Name" required>
                   </div>
                   <div class="form-group col-md-6">
                      <label>KPI Group</label>
                      <select name="kpi_group_id[]" multiple class="form-control text-capitalize select2" required>
                         <option value="">Select KPI Group</option>
                         @if( count($kpi_groups) )
                            @foreach( $kpi_groups as $kpi )
                              <option class="text-capitalize" value="{{ $kpi->id }}">{{ $kpi->title }}</option>
                            @endforeach
                         @endif
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label>Company Metric</label>
                      <select name="metric_id" class="form-control text-capitalize">
                         <option value="">Select Metric</option>
                         @if( count($metrices) )
                            @foreach( $metrices as $metric )
                               <option class="text-capitalize" value="{{ $metric->id }}">{{ $metric->title }}</option>
                            @endforeach
                         @endif
                      </select>
                   </div>
                   <div class="form-group col-md-6">
                      <label>Custom Metric Title</label>
                      <input type="text" name="custom_metric_title" class="form-control" value="" placeholder="Custom Metric Title">
                   </div>
                   <div class="form-group col-md-6">
                      <label>Pin Colour</label>
                      <input type="hidden" name="type" value="pin" >
                      <div class="gray-box">
                        @foreach( config('constants.PIN_STATUS_IMAGES') as $color => $pin_status_images)
                           <div class="form-check">
                              <input style="margin-top: 5px;" required class="form-check-input" type="radio" name="image_url" value="{{ $color . '|' . asset($pin_status_images) }}">
                              <label class="form-check-label">
                                 <img style="width:30px;height:30px;object-fit:contain;margin-bottom: 10px;" src={{ asset($pin_status_images) }} />
                              </label>
                           </div>
                        @endforeach
                      </div>
                   </div>
                   <div class="form-group col-md-6">
                      <div id="icon-container" class="img-responsive d-none form-control">
                         <img style="width: 15px; height:15px" id="status-icon" src="#" alt="your image" />
                      </div>
                   </div>
                </div>
                <hr>
             </div>
             <div class="modal-footer"> 
                <button type="button" class="btn btn-close btn-theme2" data-dismiss="modal">
                <ul class="d-flex align-items-center justify-content-center">
               <li>-</li>
               <li>Cancel</li>
               </ul></button>
                <button type="submit" class="btn btn-save btn-theme">
                <ul class="d-flex align-items-center justify-content-center">
               <li>+</li>
               <li>Confirm</li>
               </ul></button>
             </div>
          </form>
       </div>
    </div>
 </div>
 @push('scripts')
 <script>
    ajax_form_submitted('#addStatusForm','#addStatusFormError','#addStatusFormSuccess');
 </script>
 @endpush
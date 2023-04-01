<div class="modal fade new-modal" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="data-target" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editStatusTitle">Update Status</h5>
            <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="editStatusForm" method="POST" enctype="multipart/form-data" action="{{ route('admin.edit-status') }}">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $pin->id }}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="editStatusFormError" class="error_div"></div>
                        <div id="editStatusFormSuccess" class="success_div"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" value="{{$pin->title ? $pin->title : ''}}" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>KPI Group</label>
                        <select name="kpi_group_id[]" multiple class="form-control text-capitalize select2" required>
                            <option value="">Select KPI Group</option>
                            @if( count($kpi_groups) )
                                @foreach( $kpi_groups as $kpi )
                                    <option {{ $kpi->is_selected ? 'selected' : '' }} class="text-capitalize" value="{{ $kpi->id }}">{{ $kpi->title }}</option>
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
                                    <option {{ $pin->metric_id == $metric->id ? 'selected' : '' }} class="text-capitalize" value="{{ $metric->id }}">{{ $metric->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Custom Metric Title</label>
                        <input type="text" name="custom_metric_title" class="form-control" value="{{ $pin->custom_metric_title }}" placeholder="Custom Metric Title">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Pin Color</label>
                        <input type="hidden" name="type" value="pin" >
                        <div class="gray-box">
                            @foreach( config('constants.PIN_STATUS_IMAGES') as $color => $pin_status_images)
                                <div class="form-check">
                                    <input style="margin-top: 5px;" {{ $pin->image_url == URL::to($pin_status_images) ? 'checked' : '' }} required class="form-check-input" type="radio" name="image_url" value="{{ $color . '|' . URL::to($pin_status_images) }}">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-save">Update</button>
            </div>
        </form>    
    </div>
    </div>
</div>
<script>
    ajax_form_submitted('#editStatusForm','#editStatusFormError','#editStatusFormSuccess');
</script>
@extends('admin.master')
@section('content')
    @include('admin.include.navbar')
    <div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
        <div id="content" class="p-4">
            @include('admin.flash-message')
            <div class="row pb-3">
                <div class="col-md-5 fields-ip">
                    <h4 class="heading2 font-30">Default Fields</h4>
                    <p class="fields-mainp">These are the fields that are being used by default</p>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Pin Status" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Assign To" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Address" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="House Number" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Unit" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="City" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="State" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Zip Code" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Name" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Phone" disabled>
                    </div>
                    <div class="form-group new-modal">
                        <input type="text" class="form-control" placeholder="Email" disabled>
                    </div>
                </div>
                <div class="col-md-7">
                    <h4 class="heading2 font-30">Custom fields</h4>
                    <p class="fields-mainp">Add custom fields to collect specific information</p>
                    <div class="table-responsive">
                        <table class=" account-table table statuses-table customfields-table">
                            <thead>
                                <tr>
                                    <th class="pl-3">
                                        <p class="statuses-rightside-table ">Field Label</p>
                                    </th>
                                    <th class="text-center"> 
                                        <p class="statuses-rightside-table ft-weight-normal " >Field Type:Text</p>
                                    </th>
                                    <th class="text-right" style="vertical-align: middle;">
                                    <a href="#"  class=" pr-1 customfield-icon"><img src="{{asset('assets/images/ic_mode_edit.png')}}" class="img-fluid" alt="Edit Status Image"  /></a>
                                    <a  href="#" class=" pr-1 customfield-d-icon" ><img src="{{asset('assets/images/ic_delete.png')}}" class="img-fluid statuses-btn" alt="Delete Image"  /></button>
                                        <!-- <p class="statuses-rightside-table border-0" style="font-weight:normal;">Action</p> -->
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @if( count($custom_fields) )
                                @foreach( $custom_fields as $custom_field )
                                    <tr>
                                        <td class="pl-3"><p class="statuses-rightside-table">{{ $custom_field->label }}</p></td>
                                        <td class="text-center">
                                           <p class="statuses-rightside-table ft-weight-normal ">Field Type:{{ $custom_field->field_type }}</p>
                                        </td>
                                        <td class="text-right">
                                            <a class="_delete_custom_field pr-1 customfield-d-icon" id="{{ $custom_field->id }}" href="javascript:void(0);">
                                                <img src="{{asset('assets/images/ic_delete.png')}}" class="img-fluid statuses-btn" alt="Delete Image"  />
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="3">
                                        <span class="text-info">Custom field not found.</span>
                                    </th>
                                </tr>
                            @endif
                            <tr>
                                <td class="new-modal" colspan="3">
                                    <!-- <a id="_add_custom_field" href="javascript:void(0);"><p class="orange ft-14">- Add Custom Field</p></a> -->
                                    <form method="post" action="{{ route('admin.add-custom-fields') }}">
                                        {{ csrf_field() }}
                                        <div id="_add_custom_field_section">
                                            <div class="form-row">
                                                <div class="col-md-4 statuses-righttable-select form-group statuses-righttable-select-left" >
                                                    <select name="field_type[]" class="form-control" required>
                                                        <option value="text">Text</option>
                                                        <option value="textarea">Note</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 statuses-righttable-select form-group statuses-righttable-select-center" >
                                                    <input type="text" name="label[]" required class="form-control" placeholder="Field Name">
                                                </div>
                                                <div class="col-md-4 statuses-righttable-select "style="padding-left:10.5rem;">
                                                    <button class="btn btn-orange btn-theme" style="padding: 0.6rem 1.5rem;">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="form-row">
                                            
                                        </div> -->
                                    </form>
                                </td>
                            </tr>
                            <tr style="background:transparent;"><td> <a id="_add_custom_field" href="javascript:void(0);"><p class="orange ft-14">- Add Custom Field</p></a></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/admin/js/custom-field.js') }}"></script>
    @endpush
@endsection
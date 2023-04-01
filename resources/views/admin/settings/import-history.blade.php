@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <div id="content" class="p-4">
      <div class="row pb-3">
         <div class="col-md-12">
            <h4 class="heading2">Import Pins</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12 mb-3">
            @include('admin.flash-message')
            <div id="accordionImport">
               <div class="card mb-3" id="step_1">
                  <div class="card-header">
                     <h6 class="mb-0 panel-title" data-toggle="collapse" data-target="#chooseFile" aria-expanded="false">
                        1. Upload your CSV files with you contact/pins
                     </h6>
                  </div>
                  <div id="chooseFile" class="collapse"  data-parent="#accordionImport">
                     <div class="card-body">
                        <form id="import_file_form" method="post" action="{{ route('admin.get-import-data') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="form-group">
                              <label>Select File</label>
                              <input type="file" id="import_pin" name="import_pin" class="form-control-file">
                              <p class="mt-2 ft-14 mb-0">You can import up to 10,000 of data.</p>
                              <button type="submit" class="btn btn-save mt-2 text-capitalize">Upload List</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="card mb-3" id="step_2" disabled>
                  <div class="card-header">
                     <h6 class="mb-0 panel-title" data-toggle="collapse" data-target="#configCol" aria-expanded="false">
                        2. Configure column data types/names
                     </h6>
                  </div>
                  <div id="configCol" class="collapse"  data-parent="#accordionImport">
                     <div id="step2_data"></div>
                  </div>
               </div>
               <div class="card mb-3" id="step_3" disabled>
                  <div class="card-header">
                     <h6 class="mb-0 panel-title" data-toggle="collapse" data-target="#reviewData" aria-expanded="false">
                        3. Review data in chosen columns
                     </h6>
                  </div>
                  <div id="reviewData" class="collapse"  data-parent="#accordionImport">
                     <div id="step3_data"></div>
                  </div>
               </div>
               <div class="card mb-3" id="step_4" disabled>
                  <div class="card-header">
                     <h6 class="mb-0 panel-title" data-toggle="collapse" data-target="#finish" aria-expanded="false">
                        4. Finish
                     </h6>
                  </div>
                  <div id="finish" class="collapse"  data-parent="#accordionImport">
                     <div class="card-body">
                        <p>Your data has been imported successfully</p>
                        <p>Thanks!<br/>Client Scope.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@push('scripts')
   <script src="{{ asset('assets/admin/js/import.js') }}"></script>
@endpush
@endsection
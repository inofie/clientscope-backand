@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <!-- Page Content  -->
   <div id="content" class="p-4">
      <div class="row pb-3">
         <div class="col-md-12">
            <h4 class="heading2">Import History</h4>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <table class="table table-striped import-history">
               <thead>
                  <tr>
                     <th>Date/Time of Import</th>
                     <th>CSV file name</th>
                     <th class="text-center"># of PINs</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  @if( count($import_history) )
                     @foreach( $import_history as $history )
                        <tr>
                           <th>{{ $history->created_at }}</th>
                           <td>{{ $history->filename }}</td>
                           <td class="text-center">{{ $history->total_pin }}</td>
                           <td>Done</td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="4">No History Found</td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>
      @if( count($import_history) )
         <div class="row">
            <div class="col-lg-12">
               {{ $import_history->links() }}
            </div>
         </div>
      @endif
   </div>
</div>
@endsection
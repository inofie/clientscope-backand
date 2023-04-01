@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <div id="content" class="p-4">
      <div class="row pb-3">
         <div class="col-md-6">
            <h4 class="heading2 font-30">Current Statuses</h4>
            <p class="gray">Your pins can have custom statuses. Different statuses can be color coded to differentiate the pins on the map.</p>
         </div>
      </div>
      <div class="row">
         <div class="col-md-2 mb-3">
            <a href="{{route('admin.add-status')}}" data-toggle="modal" data-target="#addStatus" class="_addStatus"><img src="{{asset('assets/images/add-status.png')}}" class="img-fluid" alt="Status Image"  /></a>
         </div>
         @foreach($company_statuses as $status)
         <div class="col-md-2 mb-3">
            <div class="add-statusbox">
               <div class="d-flex justify-content-between">
                  <div>
                     <span style="color:{{$status->color}}" class="">
                        <img style="width: 50px; height: 50px; object-fit: contain;"  src="{{ URL::to($status->image_url) }}">
                     </span>
                  </div>
                  <div class="d-flex justify-content-between align-items-center"> 
                     <a href="{{route('admin.edit-status', ['id' => $status->id])}}" data-toggle="modal" data-target="#editStatus" class="_editStatus pr-1 statuses-icon"><img src="{{asset('assets/images/ic_mode_edit.png')}}" class="img-fluid" alt="Edit Status Image"  /></a>
                     <form action="{{route('admin.edit-status')}}" method="delete" style="display:inline;">
                        <input type="hidden" name="id" value="{{$status->id}}" />
                        <input type="hidden" name="_method" value="delete" />
                        <button type="submit" class="btn p-0"><img src="{{asset('assets/images/ic_delete.png')}}" class="img-fluid statuses-btn" alt="Delete Image"  /></button>
                     </form>
                  </div>
               </div>
               <div class="pt-5 mt-5">
                  <h6 class="mb-2 font-weight-bold statuses-h6" style="color:{{$status->color}}">{{ !empty($status->title) ? $status->title : '--' }}</h6>
                  <p class="mb-2 text-capitalize">Metric: <span style="font-size: 14px;"><b>{{ !empty($status->metric->title) ? $status->metric->title : '--' }}</b></span></p>
               </div>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</div>
@include('admin.modal.add-status')
@endsection
@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <div id="content" class="p-4">
      <div class="row pb-3">
         <div class="col-md-6">
            <h4 class="heading2">Team Management</h4>
         </div>
         <div class="col-md-6">
            <a class="nav-link pull-right" href="javascript:void(0)" data-toggle="modal" data-target="#addTeamModal"><button class="btn btn-black"><i class="fa fa-user-plus pr-2"></i> Add Team</button></a>
         </div>
      </div>
      <div class="row">
         @foreach($teams as $team)
            <div class="col-md-2 mb-3">
               <div class="add-statusbox">
                  <div class="d-flex justify-content-between">
                     <div>
                        <span class=""></span>
                     </div>
                     <div> 
                        <a href="{{route('admin.edit-team', ['id' => $team->id])}}" data-toggle="modal" data-target="#editTeamModal" class="_editTeam pr-1"><img src="{{asset('assets/images/edit.png')}}" class="img-fluid" alt="Edit Team"  /></a>
                        <form action="{{route('admin.edit-team')}}" method="delete" style="display:inline;">
                           <input type="hidden" name="id" value="{{$team->id}}" />
                           <input type="hidden" name="_method" value="delete" />
                           <button type="submit" class="btn p-0"><img src="{{asset('assets/images/delete.png')}}" class="img-fluid" alt="Delete Image"  /></button>
                        </form>
                     </div>
                  </div>
                  <div class="pt-5 mt-5">
                     <h6 class="mb-2 font-weight-bold">{{ $team->title }}</h6>
                  </div>
               </div>
            </div>
         @endforeach
      </div>
   </div>
</div>
@include('admin.modal.add-team')
@endsection
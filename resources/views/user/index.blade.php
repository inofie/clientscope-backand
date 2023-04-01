@extends('layouts.app')
@section('content')
   <div class="container-fluid">
      <div class="row p-3">
            <img class="img-fluid" src="{{asset('assets/images/logo.png')}}" style="height:40px;" />
            <div class="d-flex flex-row ml-auto align-items-center">
                <div class="pr-3"><button class="btn btn-black"><i class="fa fa-user-plus pr-2"></i> Add user</button></div>
                <div class="pr-3"><button class="btn btn-black"><i class="fa fa-map-marker pr-2"></i> Add Pin</button></div>
                <div class="pr-3">
                    <span class="bell"><i class="fa fa-bell"></i></span>
                </div>
            </div>
      </div>
   </div>
@endsection
@extends('admin.master')
@section('content')
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('assets/admin/css/colorbox.css') }}">
@endpush
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
   @include('admin.include.sidebar')
   <!-- Page Content  -->
   <div id="content" class="p-5">
        <div class="row pt-5">
            <div class="col-md-6 mb-3">
                <h2 class="heading1">Welcome to<br/> Client Scope, {{ get_user()->name }}</h2>
                <div class="pt-5">
                <span class="heading2 pr-4">To learn more watch this video</span>
                <span><a class="youtube" href="https://www.youtube.com/embed/fdLsXm2xYCU?rel=0&wmode=transparent"><img style="width:25px;" src="{{asset('assets/images/video.png')}}" class="img-fluid" alt="video button"/></a></span>
                </div>
                <p class="pt-4 ft-14" style="color:#939BB5;">Praesent eu dolor eu orci vehicula euismod. Vivamus sed sollicitudin libero, vel malesuada velit. Nullam et maximus lorem. Suspendisse maximus dolor quis consequat volutpat. Donec vehicula elit eu erat pulvinar, vel congue ex egestas.</p>
                <div class="pt-3">
               <a href="#"><img src="{{asset('assets/images/app.png')}}" class="img-fluid app-icon"/></a>
               <a href="#"><img src="{{asset('assets/images/android.png')}}" class="img-fluid app-icon"/></a>
            </div>
            </div>
            <div class="col-md-6">
                <a class="youtube" href="https://www.youtube.com/embed/fdLsXm2xYCU?rel=0&wmode=transparent"><img src="{{asset('assets/images/dashboard.png')}}" class="img-fluid" style="width:400px;" alt="dashboard image"/></a>
            </div>
        </div>
   </div>
</div>
@push('scripts')
<script defer src="{{asset('assets/admin/js/jquery.colorbox.js')}}"></script>
<script>
    $(document).ready(function(){
    $(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
});
</script>
@endpush
@endsection
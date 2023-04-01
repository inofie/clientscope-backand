@extends('layouts.app')
@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-4 p-5 bg-white1">
            <img src="{{ asset('assets/images/logo.png')}}" class="img-fluid pb-5">
            <p class="mt-4 mb-3">Forgot Password</p>
            @include('admin.flash-message')
            <form method="post" class="login" autocomplete="off">
               {{ csrf_field() }}
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Email" id="custom-input1" required="required" autocomplete="off">
               </div>
               <input type="submit"  name="submit" value="Submit" class="btn btn-lg btn-add ft-16 btn-block" id="login-btn">
            </form>
         </div>
         <div class="col-md-8 text-md-right text-center p-5 position-relative">
            <ul class="ul-no-style">
               <li class="white pr-3">{{ '@' . date('Y') }} Clientscope</li>
               <li><a class="white pr-3" href="#">Site Map</a></li>
               <li><a class="white" href="#">Privacy Policy</a><li>
            </ul>
         </div>
      </div>
   </div>
@endsection
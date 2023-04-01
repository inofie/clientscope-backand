@extends('layouts.app')
@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-4 p-5 bg-white1">
            <img src="{{ asset('assets/images/logo.png')}}" class="img-fluid pb-5">
            <h3 class="mt-4 mb-3">Reset Password</h3>
            @include('admin.flash-message')
            <form method="post" class="login" autocomplete="off">
               {{ csrf_field() }}
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  </div>
                  <input type="password" name="new_password" class="form-control" placeholder="New Password" id="custom-input1" required="required" autocomplete="off">
               </div>
               <div class="input-group mb-3">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  </div>
                  <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" id="custom-input1" required="required" autocomplete="off">
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
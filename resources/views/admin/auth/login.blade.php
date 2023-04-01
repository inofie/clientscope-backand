@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-md-4 p-3 p-xl-5 bg-white1">
         <img src="{{ asset('assets/images/modifiy-logo.png')}}" class="img-fluid pb-md-5">
         <h1 class="mt-4 mb-1 font-28 color-ffd76e ">Sign In</h1>
         <p class="color-fff font-19 mb-5">Enter your email address and password to access <br> your account.</p>
         @include('admin.flash-message')
         <form method="post" class="login" autocomplete="off">
            {{ csrf_field() }}
            <div class="form-group mb-4 mt-4">
               <p class="mb-1 font-medium color-fff">Email Address</p>
               <input type="email" name="email" class="form-control primary-input" placeholder="Enter your Email" id="custom-input1" required="required" autocomplete="off" >
            </div>
            <div class="form-group mb-4 ">
               <div class="d-flex justify-content-between">
                  <div>
                     <p class="mb-1 color-fff">Password</p>
                  </div>
                  <div>
                     <p class="mb-1"><a class="gray font-13 hover-color color-ffd76e" href="{{ route('admin.forgot-password') }}">Forgot your Password?</a></p>
                  </div>
               </div>
               <input type="Password" name="password" class="form-control primary-input" placeholder="Enter your Password" id="custom-input2" required="required" autocomplete="off" >
            </div>
            <label class="mt-4 mb-4 d-flex align-items-center color-fff">
            <input name="remember_me" value="1" type="checkbox" class="mr-2 "> Remember me
            </label>
            <input type="submit"  name="submit" value="Login" class="btn btn-lg btn-add font-500 ft-16 btn-block color-black bg-ffd76e" id="login-btn">
         </form>
         <div class="text-right mt-4 andriod-app-store d-flex">
            <a href="#"><img src="{{ asset('assets/images/app.png') }}" class="img-fluid"/></a>
            <a href="#"><img src="{{ asset('assets/images/android.png') }}" class="img-fluid"/></a>
         </div>
      </div>
      <div class="col-md-8 text-md-right text-center p-3 p-md-5 position-relative bg-yellow body-bg login-">
         <a href="{{ env('SCOPEIT360URL') }}" target="_blank" class="pr-md-3 color-black  font-600 hover-color">Don’t have an account?
            <button class="btn btn-add btn-theme ml-2 mt-2 mt-md-0">Get Started</button>
         </a>
         <ul class="ul-no-style">
            <li class="color-black pr-3">{{ '@' . date('Y') }} Clientscope</li>
             <li><a class="color-black pr-3" href="#">Site Map</a></li> 
            <li><a data-toggle="modal" data-target="#privacyPolicy" class="color-black" href="javascript:void(0);">Privacy Policy</a><li>
         </ul>
      </div>
   </div>
</div>
<div id="privacyPolicy" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Privacy Policy</h4>
      </div>
      <div class="modal-body">
        <p>
           {!! !empty($appContent['privacyPolicy']->content) ? $appContent['privacyPolicy']->content : NULL !!}
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
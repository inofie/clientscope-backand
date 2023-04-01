<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function privacyPolicy()
    {
        $data['content'] = \DB::table('app_content')->where('identifier','privacy-policy')->first();
        return view('app-content',$data);
    }

    public function termsConditions()
    {
        $data['content'] = \DB::table('app_content')->where('identifier','terms-condition')->first();
        return view('app-content',$data);
    }

    public function login(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_postLogin($request);

        return view('login');
    }

    public function _postLogin($request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->withErrors($validator)->withInput();
        }     
        
        $credentials = [
            'email'     => $request['email'],
            'password'  => $request['password'],
        ];
        if( Auth::attempt($credentials) ) {
            return redirect('user/chat');
        } else {
            return redirect()->back()->with('error','Invalid credential');
        }  
    }

    public function userChat()
    {
        return view('chat');
    }

    public function userLogin(){
        return view('auth.login');
    }

    public function forgetPassword(){
        return view('auth.forget-password');
    }

     public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function map(){
        return view('map.index');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class AdminController extends Controller
{
    private $_ajax_response;

    public function __construct()
    {
        $this->_ajax_response = [
            'error'        => false,
            'message'      => '',
            'data'         => [],
            'redirect'     => false,
            'redirect_url' => '',
        ];
    }

    public function login(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_postLogin($request);

        return view('admin.auth.login', [
            'body_class' => 'body-bg'
         ]);
    }

    private function _postLogin($request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->withErrors($validator)->withInput();
        }        
        $credential = [
            'email'    => $request['email'],
            'password' => $request['password'],     
        ];
        $remember_me = !empty($request['remember_me']) ? true : false;
        if( Auth::attempt($credential,$remember_me) ){
            //update user token
            $token = md5( $request['email'] . '|' . $request->ip() );
            User::where('email',$request['email'])->update(['token' => $token ]);
            return redirect()->route('admin.dashboard')->with('success',__('app.login_success_msg'));    
        }else{
            return redirect()->back()->with('error',__('app.login_failed_msg'));
        }
    }

    public function forgotPassword(Request $request)
    {
        if( $request->isMethod('post') )
            return self::_postForgotPassword($request);
        
        return view('admin.auth.forget-password',[
            'body_class' => 'body-bg'
        ]);
    }

    public function _postForgotPassword($request)
    {
        $response = $this->internalCall('api/user/forgot-password','POST',$request->all());
        if( $response->code != 200 )
            return redirect()->back()->with('api_error',$response->data);
        
        return redirect()->route('admin.login')->with('success',$response->message);    
    }

    public function changePassword(Request $request)
    {
        $user_token = Auth::user()->token;
        $response = $this->internalCall('api/user/change-password','POST',$request->all(),$user_token);
        if( $response->code != 200){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        } else {
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = false;
        }
        return response()->json($this->_ajax_response);
    }

    public function updateProfile(Request $request)
    {
        $user_token        = Auth::user()->token;
        $params            = $request->all();
        $params['_method'] = 'PUT'; 
        $response          = $this->internalCall('api/user/' . Auth::user()->id,'POST',$params,$user_token);
        if( $response->code != 200){
            $this->_ajax_response['error']   = 1;
            $this->_ajax_response['message'] = $response->message;
            $this->_ajax_response['data']    = $response->data;
        } else {
            $this->_ajax_response['error']        = 0;
            $this->_ajax_response['message']      = $response->message;
            $this->_ajax_response['data']         = $response->data;
            $this->_ajax_response['redirect']     = true;
            $this->_ajax_response['redirect_url'] = url()->previous();
        }
        return response()->json($this->_ajax_response);
    }

    public function logout()
    {
        $user = get_user();
        User::where('id',$user->id)->update(['device_token' => NULL]);
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\ServiceProviderType;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\UserPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends RestController
{

    public function __construct()
    {
        parent::__construct('User');
    }

    public function verifyUser($tableName,$email)
    {
        $tableName = decrypt($tableName);
        $email     = decrypt($email);
        \DB::table($tableName)->where('email',$email)->update([
            'is_email_verify' => 1
        ]);
        \DB::table($tableName)->where('email',$email)->where('is_email_verify',0)->delete();
        return redirect('admin/login')->with('success',__('app.user_account_verified'));
    }

    public function resetPassword(Request $request,$model,$user_id)
    {
        if($request->isMethod('POST')){
            return self::_resetPassword($request,$model,$user_id);
        }
        $checkRequest = UserPasswordReset::where('user_id',decrypt($user_id))->first();
        if( !isset($checkRequest->id) ){
            return redirect('/')->with('error','Invalid request');
        }
        return view('admin.auth.reset-password',[
            'body_class' => 'body-bg'
        ]);
    }

    private function _resetPassword($request,$model,$user_id)
    {
        $model   = '\App\Models\\' . decrypt($model);
        $model   = new $model;
        $user_id = decrypt($user_id);
      
        $message = [
          'confirm_password.same' => "New password and confirm password doesn’t match"
        ];
        $validator = Validator::make($request->all(), [
            'new_password'     => 'required|min:6|max:20',
            'confirm_password' => 'required|same:new_password',
        ],$message);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }
        $model->where('id',$user_id)->update([
            'password' => Hash::make($request->input('new_password'))
        ]);
        //delete forgot password request
        UserPasswordReset::where('user_id',$user_id)->forceDelete();

        return redirect()->route('admin.login')->with('success',__('app.password_success_msg'));
    }

    public function activeSubscriber($param)
    {
        $param = explode('_',decrypt($param));
        \DB::table('subscriber')
            ->where('id',$param[0])
            ->update([
                'status' => 1
            ]);
        \DB::table('subscriber')->where('id','!=',$param[0])->where('email',$param[1])->delete();
        return redirect('/')->with('success','Your subscription has been activated successfully');
    }
}

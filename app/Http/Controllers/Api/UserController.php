<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\RestController;
use App\Models\CompanyMetricTarget;
use App\Models\Team;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\UserPasswordReset;
use App\Models\NotificationIdentifier;
use Carbon\Carbon;

class UserController extends RestController
{
    public $_request,$_apiResource ;

    public $success_store_message = 'user_account_created';

    private $child = [];

    public function __construct(Request $request)
    {
        parent::__construct('User');
        $this->_request     = $request;
        $this->_apiResource = 'User';

    }

    public function validation($action,$id=0)
    {
        $validator = [];
        switch ($action){
            case 'INDEX':
                $validator = Validator::make($this->_request->all(), [
                    'company_user_id' => 'required|exists:users,id,deleted_at,NULL',
                ]);
            break;
            case 'POST':
                if(!empty($this->_request['mobile_no'])){
                    $this->_request['mobile_no'] = str_replace('+','',$this->_request['mobile_no']);
                }
                $validator = Validator::make($this->_request->all(), [
                    'name'             => 'required|min:3|max:50',
                    'email'            => 'required|email|unique:users,email,NULL,deleted_at',
                    'mobile_no'        => array('nullable','unique:users,mobile_no,NULL,deleted_at','numeric'),
                    'password'         => 'min:6',
                    'confirm_password' => 'same:password',
                    'user_role'        => 'required|exists:roles,slug,deleted_at,NULL'
                ]);
                break;
            case 'PUT':
                $this->_request->merge(['token' => $this->_request->header('user-token')]);
                $validator = Validator::make($this->_request->all(), [
                    '_method'      => 'required|in:PUT',
                    'name'         => 'min:3|max:50',
                    'image_url'    => 'image',
                    'mobile_no'    => 'nullable|numeric',
                ]);
                break;
        }
        return $validator;
    }

    /**
     * @param $request
     */
    public function beforeIndexLoadModel($request){
    }

    /**
     * @param $request
     */
    public function beforeStoreLoadModel($request)
    {
        //assign role
       $params = $request->all();
       if( $params['user_role'] != 'company' ){
           if( empty($params['user_meta']) ){
               $request['user_role'] = 'sales-representative';
           } else {
               $user_meta = $params['user_meta'];
               if( !empty($user_meta['is_administrator']) || !empty($user_meta['manage_user']) )
               {
                   $request['user_role'] = 'team-lead';
               }
           }
       }
    }


    /**
     * @param $request
     * @params $id
     */
    public function beforeShowLoadModel($request,$id){
    }

    /**
     * @param $request
     */
    public function beforeUpdateLoadModel($request,$id){
    }

    /**
     * @param $request
     */
    public function beforeDestroyLoadModel($request,$id){
    }



    public function login()
    {
        $validator = Validator::make($this->_request->all(), [
            'email'        => 'required|email',
            'password'     => 'required',
            'device_type'  => 'in:ios,android',
            'device_token' => 'string'
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->getMessages() as $key => $value){
                $error_messages[$key] = $value[0];
            }
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }

        $user = User::where('email',$this->_request['email'])
                    ->first();

        if( !isset($user->id) ){
            $error_messages['message'] = __('app.login_failed_msg');
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        if ( !Hash::check($this->_request['password'], $user->password) ) {
            $error_messages['message'] = __('app.login_failed_msg');
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        if($user->status_id != get_status_id('active')){
            $error_messages['message'] = 'User is inactive by admin';
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }

        $user->token = User::generateApiToken(
            $this->_request['email'],
            $this->_request->ip(),
            $this->_request['device_type'],
            $this->_request['device_token'],
            $user->created_at
        );
        $userData['token'] = $user->token;
        //update device type & token
        if( !empty($this->_request['device_type']) && !empty($this->_request['device_token']) ){
            $user->device_type  = $userData['device_type'] = $this->_request['device_type'];
            $user->device_token = $userData['device_token'] = $this->_request['device_token'];
        }

        //update user data
        User::where('id',$user->id)->update($userData);

        $user = User::getUserByID($user->id);

        $this->__is_paginate   = false;
        $this->__is_collection = false;

        return $this->__sendResponse($user,200,__('app.login_success_msg'));
    }

    public function socialLogin()
    {
        $validator = Validator::make($this->_request->all(), [
            'name'          => 'required',
            'email'         => 'required',
            'platform_id'   => 'required',
            'platform_type' => 'required',
        ]);
        if ($validator->fails()) {
            foreach($validator->errors()->getMessages() as $key => $value){
                $error_messages[$key] = $value[0];
            }
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        $user = User::socialUser($this->_request->all());
        $this->__is_paginate   = false;
        return $this->__sendResponse($user, 200, __('app.login_success_msg'));
    }

    public function changePassword()
    {
        $message = [
          'confirm_password.same' => "Password and confirm password doesn’t match"
        ];
        $validator = Validator::make($this->_request->all(), [
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ],$message);
        if ($validator->fails()) {
            foreach($validator->errors()->getMessages() as $key => $value){
                $error_messages[$key] = $value[0];
            }
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        $record = $this->_request['user'];
        //check old password
        if(!Hash::check($this->_request['current_password'],$record->password)){
            $error_messages['error'] = __('app.invalid_old_password');
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        //update password
        User::where('id',$this->_request['user']->id)->update([
            'password' => Hash::make($this->_request['new_password'])
        ]);

        $this->__is_paginate   = false;
        $this->__is_collection = false;

        $record = User::getUserByID($record->id);

        return $this->__sendResponse($record,200,__('app.password_success_msg'));
    }

    public function forgotPassword()
    {
        $message = [
          'email.exists' => 'This Email ID isn’t associated with any user',
        ];
        $validator = Validator::make($this->_request->all(), [
            'email'        => 'required|email|exists:users',
        ],$message);
        if ($validator->fails()) {
            foreach($validator->errors()->getMessages() as $key => $value){
                $error_messages[$key] = $value[0];
            }
            return $this->__sendError(__('app.validation_msg'),$error_messages,400);
        }
        $record = User::where('email',$this->_request['email'])->where('status_id',get_status_id('active'))->first();

        $mail_params['YEAR']      = date('Y');
        $mail_params['USERNAME'] = $record->name;
        $mail_params['LINK']     = \URL::to('admin/reset-password/' . encrypt($this->_model) . '/' . encrypt($record->id));
        $mail_params['APP_URL']  = \URL::to('/');
        $mail_params['APP_NAME'] = config('constants.APP_NAME');
        sendMail($record->email,'forgot-password',$mail_params);

        UserPasswordReset::insert([
            'user_id'     => $record->id,
            'reset_token' => md5($record->email),
            'created_at'  => Carbon::now()
        ]);

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse([],200,__('app.forgot_password_success_msg'));
    }

    public function logout()
    {
        User::where('token',$this->_request['user']->token)
            ->update([
                'device_token' => NULL,
                'token'        => HASH_HMAC('sha256',rand(),rand()),
            ]);

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse([],200,__('app.logout_msg'));
    }

    public function userSubscribe(Request $request)
    {
        $param_rules['email'] = 'required|email|unique:subscriber,email,NULL,deleted_at';

        $response = $this->__validateRequestParams($request->all(),$param_rules);

        if( $this->__is_error )
            return $response;

        $id = \DB::table('subscriber')->insertGetId([
            'email'      => $request['email'],
            'ip_address' => $request->ip(),
            'created_at' => Carbon::now()
        ]);

        $mail_params['LINK']      = URL::to('user/subscribe/activate/' . encrypt($id . '_' . $request['email']) );
        $mail_params['APP_NAME']  = config('constants.APP_NAME');
        sendMail($request['email'],'user_subscription',$mail_params);

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse([], 200, "You've just been sent an email to confirm your email address. Please click on the link in this email to confirm your subscription.");
    }

    public function leaderBoard(Request $request)
    {
        $leaderBoard = User::getleaderBoard($request['user']->id,NULL,$request->all());

        $this->__collection = false;
        return $this->__sendResponse($leaderBoard, 200, "Leader board retrieved successfully");
    }


    public function getManageUsers(Request $request)
    {
        $parent_users = [];
        $users = User::getReportingUsers($request['user']->id);

        if( count($users) )
        {
            $users = $users->toArray();
            session(['users' => $users]);
            foreach($users as $index => $user){
                if( $user['reporting_user_id'] == 0 ) {
                    $parent_users[] = $user;
                }
            }
            $this->getChilds($parent_users);
        }

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($parent_users, 200, "Users retrieved successfully");
    }

    public function getChilds(&$parent_users)
    {

        foreach( $parent_users as $index => $pu )
        {
            $child_user = [];
            foreach( session('users') as $u ){
                if( $u['reporting_user_id'] == $pu['id'] ){
                    $child_user[] = $u;
                }

            }
            $parent_users[$index]['child'] = $child_user;
            //recursive call
            if( !empty($child_user) )
                $this->getChilds($parent_users[$index]['child']);

        }
    }

    public function getCompanyMetric()
    {
        $params = $this->_request->all();
        $user   = $params['user']->toArray();
        $company_metrics = CompanyMetricTarget::getCompanyMetric($user['user_company']['id']);

        $this->__is_paginate = false;
        $this->__collection  = false;

        return $this->__sendResponse($company_metrics, 200, __('app.success_listing_message'));
    }
}

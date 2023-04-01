<?php

namespace App\Http\Middleware;

use App\Http\Models\ApiUser;
use App\Models\User;
use App\Models\UserSubscription;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authentication
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth , $request;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth, Request $request)
    {
        $this->auth    = $auth;
        $this->request = $request;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if($this->authenticate($guards)){
            return $this->authenticate($guards);
        }
        return $next($request);
    }

    protected function authenticate(array $guards)
    {

        if (empty($guards)) {
            return $this->auth->authenticate();
        }
        foreach ($guards as $guard) {
            if($guard == "admin"){
                return  $this->adminAuth($guard);
            }else if($guard == "web"){
                return $this->webAuth($guard);
            }else if($guard == "api"){
                return $this->apiAuth();
            }
        }
    }

    /**
     * This function is used for validate session based authentication for admin user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function adminAuth($guard)
    {
        if ($this->auth->guard($guard)->guest()) {
            return redirect()->route('admin.login');
        }
    }

    /**
     * This function is used for validate session based authentication for web user
     * @return \Illuminate\Http\JsonResponse
     */
    protected function webAuth($guard)
    {
        if ($this->auth->guard($guard)->guest()) {
            if( $this->request->ajax() ){
                return response()->json([
                    'code'    => 401,
                    'message' => 'Your session has timed out. Please login again'
                ],401);
            }else{
                return redirect()->guest('/');
            }
        } else {
            $user = get_user()->toArray();
            if( $user['user_role']['slug'] != 'super-admin' ){
                $getUserSubscription = UserSubscription::checkUserSubscription($user['user_company']['company_user_id']);
                $this->request->merge(['user_package' => $getUserSubscription]);
                if( strtotime(date('Y-m-d')) > strtotime($getUserSubscription->expire_date) ){
                    if( \Route::getCurrentRoute()->getName() != 'admin.account-details' ){
                        return redirect()->route('admin.account-details');
                    } 
                }
            }
        }
    }

    /**
     * This function is used for validate json web token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiAuth()
    {
        if( $this->request->is('admin/*') ){
            $userToken = get_user()->token;
            $user      = User::where('token',$userToken)->first();
        }else{
            if(empty($this->request->header('user-token'))){
                return response()->json([
                    'code'    => 401,
                    'message' => 'Unauthorized',
                    'data'    => [ 'auth' => 'User token is required' ]
                ],401);
            }

            $userToken = $this->request->header('user-token');
            $user      = User::where('token',$userToken)->first();

            if(!isset($user->id))
            {
                return response()->json([
                    'code'    => 401,
                    'message' => 'Unauthorized',
                    'data'    => [ 'auth' => 'User token is invalid' ]
                ],401);
            }
        }
        if( $user->status_id != 1 ){
            return response()->json([
                    'code'    => 401,
                    'message' => 'Unauthorized',
                    'data'    => [ 'auth' => 'Your account has been disabled by admin' ]
                ],401);
        }
        $user = User::getUserByID($user->id);
        $this->request['user'] = $user;
    }
}

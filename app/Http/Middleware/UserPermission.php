<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$module)
    {
        if( !$request->isMethod('get') )
        {
            $module = $module[0];
            $user   = Auth::check() ? get_user() :$request['user'];

            if( $user->userRole->slug != 'company' )
            {
                if( \Route::currentRouteName() == 'user.show' || \Route::currentRouteName() == 'user.update' ||
                    \Route::currentRouteName() == 'user.index'){
                    return $next($request);
                }

                if( $module == 'manage_user' ){
                    if( $user->user_meta['is_administrator'] == 0 && $user->user_meta['manage_user'] == 0 ){
                        return response()->json([
                            'code' => 400,
                            'message' => 'Permission Denied',
                            'data' => ['message' => "You don't have a permission to proceed this request"]
                        ], 400);
                    }
                }

                if( $module == 'team' ){
                    if( $user->user_meta['is_administrator'] == 0 ){
                        return response()->json([
                            'code' => 400,
                            'message' => 'Permission Denied',
                            'data' => ['message' => "You don't have a permission to proceed this request"]
                        ], 400);
                    }
                }

                if( $module == 'status' ){
                    if( $user->user_meta['is_administrator'] == 0 ){
                        return response()->json([
                            'code' => 400,
                            'message' => 'Permission Denied',
                            'data' => ['message' => "You don't have a permission to proceed this request"]
                        ], 400);
                    }
                }

            }
        }
        return $next($request);
    }

}

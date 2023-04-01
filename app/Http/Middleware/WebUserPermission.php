<?php

namespace App\Http\Middleware;

use Closure;

class WebUserPermission
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
            $user   = get_user();

            if( $user->userRole->slug != 'company' )
            {
                if( \Route::currentRouteName() == 'user.show' || \Route::currentRouteName() == 'user.update' ||
                    \Route::currentRouteName() == 'user.index'){
                    return $next($request);
                }

                if( $module == 'manage_user' ){
                    if( $user->user_meta['is_administrator'] == 0 && $user->user_meta['manage_user'] == 0 ){
                        return redirect()->route('admin.dashboard')
                                ->with('error',"You don't have a permission to proceed this request");
                    }
                }

                if( $module == 'import_pin' ){
                    if( $user->user_meta['is_administrator'] == 0 && $user->user_meta['can_import_pin'] == 0 ){
                        return redirect()->route('admin.dashboard')
                            ->with('error');
                    }
                }

                if( $module == 'team' || $module == 'account-detail' || $module == 'status' ||
                    $module == 'custom_field' ){
                    if( $user->user_meta['is_administrator'] == 0 ){
                        return redirect()->route('admin.dashboard')
                            ->with('error',"You don't have a permission to proceed this request");
                    }
                }

				if( $module == 'company-sales' ){
					if( $user->user_meta['is_administrator'] == 0 ){
                        return redirect()->route('admin.dashboard')
                            ->with('error',"You don't have a permission to proceed this request");
                    }
				}

				if( $module == 'user-track' ){
					if( $user->user_meta['is_administrator'] == 0 ){
                        return redirect()->route('admin.dashboard')
                            ->with('error',"You don't have a permission to proceed this request");
                    }
				}

            }
        }
        return $next($request);
    }

}

<?php

namespace App\Http\Middleware;

use Closure;

class ApiAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->header('token') !=  config('constants.APIKEY')){
            return response()->json([
                'code'    => 401,
                'message' => 'Unauthorized',
                'data'    => [ 'auth' => 'You do not have permission to access this module.' ]
            ],401);
        }
        return $next($request);
    }
}

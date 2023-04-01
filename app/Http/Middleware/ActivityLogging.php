<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class ActivityLogging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $response = $next($request);
        // Perform action
        if( !$request->isMethod('get') )
        {
            unset($request['password'],$request['current_password'],$request['new_password'],$request['confirm_password']);
            \App\Models\ActivityLogging::create([
                'user_id'       => Auth::guard($guards[0])->check() ? Auth::guard($guards[0])->user()->id : 0,
                'user_type'     => $guards[0],
                'action'        => $request->route()->getName(),
                'user_request'  => json_encode($request->all()),
                'user_agent'    => $request->header('User-Agent'),
                'ip_address'    => $request->ip(),
                'created_at'    => Carbon::now(),
            ]);
        }
        return $response;
    }
}

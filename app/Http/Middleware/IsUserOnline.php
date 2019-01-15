<?php

namespace Mirror\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;  // For making time for expirection

class IsUserOnline
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
        if(Auth::check())
        {
            $expireTime = Carbon::now()->addMinutes(1);
            Cache::put("is-user-online-" . Auth::user()->id, true, $expireTime);
        }
        return $next($request);
    }
}

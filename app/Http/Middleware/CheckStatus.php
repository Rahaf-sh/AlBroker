<?php

namespace App\Http\Middleware;

use App\Traits\GeneralFunction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    use GeneralFunction;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        $user = Auth::guard('api')->user();
        if ($user->account_status !='active') {
        return $this->sendErrors(__('custom_messages.general.account_'.$user->account_status ),401);
     }  
        return $next($request);
    }
}

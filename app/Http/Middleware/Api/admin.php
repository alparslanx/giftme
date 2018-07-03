<?php

namespace App\Http\Middleware\Api;

use App\UserToken;
use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        if($request->input('token') != 'test_admin_token'){
            return response()->json(UserToken::getErrorToken(),400);
        }

        return $next($request);
    }
}

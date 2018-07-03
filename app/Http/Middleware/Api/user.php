<?php

namespace App\Http\Middleware\Api;

use App\UserToken;
use Closure;
use Illuminate\Support\Facades\Auth;

class user
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
        if(!empty($request->input('token'))){
            $userToken = UserToken::where('token',$request->input('token'))->where('status',1)->first();
            if(!$userToken){
                return response()->json(UserToken::getErrorToken(),400);
            }
            Auth::loginUsingId($userToken->user_id);
        }else{
            return response()->json(UserToken::getErrorToken(),400);
        }


        return $next($request);
    }
}

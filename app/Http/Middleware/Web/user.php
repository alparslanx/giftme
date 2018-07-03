<?php

namespace App\Http\Middleware\Web;

use App\UserToken;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

        if(!$request->user() && !empty($request->cookie('user_token'))){
            $userToken = UserToken::where('token',$request->cookie('user_token'))->where('status',1)->first();
            if(!$userToken){
                return redirect(route('web.guest.user.login'))->withCookie(cookie('user_token','',-10000,'/','.giftme.com'));
            }
            Auth::loginUsingId($userToken->user_id);
            Auth::user()->token = $userToken->token;
        }elseif(!$request->user()){
            return redirect(route('web.guest.user.login'));
        }

        return $next($request);
    }
}

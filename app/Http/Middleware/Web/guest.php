<?php

namespace App\Http\Middleware\Web;

use Closure;

class guest
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
        if($request->user() || !empty($request->cookie('user_token'))){
            return redirect('/');
        }

        return $next($request);
    }
}

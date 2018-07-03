<?php

namespace App\Http\Middleware\Api;

use Closure;

class accessOrigin
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
        $allowedDomains = [
            'http://giftme.com',
            'http://www.giftme.com'
        ];

        if(in_array($request->header('origin'),$allowedDomains)){
            return $next($request)
                ->header('Access-Control-Allow-Origin', $request->header('origin'))
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        }
        return $next($request);
    }
}
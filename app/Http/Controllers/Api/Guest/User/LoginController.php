<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Log;
use App\UserToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email|email|min:5|max:255',
            'password' => 'required|min:5'
        ]);

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$request->input('remember',0))){
            $token = UserToken::create(Auth::user()->id,$request->ip(),$request->server('HTTP_USER_AGENT'),($request->input('remember',0) ? 360 : 90));
            if(!$token){
                return response()->json(['message'=>'Lütfen daha sonra tekrar deneyin.','status'=>false], 400);
            }

            return response()->json([
                'status'=>true,
                'token' =>  $token
            ], 200)->withCookie(cookie('user_token',$token,360,'/','.giftme.com'));
        }

        return response()->json(['message'=>'Bilgileriniz geçersizdir.','status'=>false], 400);
    }
}

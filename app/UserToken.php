<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserToken extends Model
{
    public static function create($user_id=0,$ip='',$user_agent='',$expire_minute=90)
    {
        $userToken = new static;
        $userToken->user_id = $user_id;
        $userToken->token = Hash::make(str_random(24));
        $userToken->ip = $ip;
        $userToken->user_agent = $user_agent;
        $userToken->expire_at = Carbon::now()->addMinute($expire_minute);
        $userToken->status = 1;
        if($userToken->save()){
            return $userToken->token;
        }
        return false;
    }

    public function user_id()
    {
        return $this->hasOne(User::class,'user_id','id');
    }

    public static function getErrorToken()
    {
        return [
            'status'    =>  0,
            'message'   =>  'Token is invalid.'
        ];
    }
}

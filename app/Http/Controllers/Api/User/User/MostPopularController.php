<?php

namespace App\Http\Controllers\Api\User\User;

use App\UserGift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MostPopularController extends Controller
{
    public function last_week()
    {
        return UserGift::join('users','users.id','=','user_gifts.user_id')->select('users.name',DB::raw('count(1)*10 AS score'))->where('user_gifts.status',1)->get()->toJson();
    }
}

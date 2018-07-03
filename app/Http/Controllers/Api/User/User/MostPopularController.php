<?php

namespace App\Http\Controllers\Api\User\User;

use App\UserGift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MostPopularController extends Controller
{
    public function last_week()
    {
        $lastWeekCache = \Illuminate\Support\Facades\Cache::get('most_popular_last_week');
        if(!$lastWeekCache){
            $lastWeekCache = UserGift::join('users','users.id','=','user_gifts.user_id')->select('users.name',DB::raw('count(1)*10 AS score'))->where('user_gifts.status',1)->get()->toJson();
            Cache::put('most_popular_last_week', $lastWeekCache, 60);
        }
        return $lastWeekCache;
    }
}

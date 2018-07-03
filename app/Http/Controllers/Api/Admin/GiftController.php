<?php

namespace App\Http\Controllers\Api\Admin;

use App\Setting;
use App\UserGift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class GiftController extends Controller
{
    public function reset_daily_gift_limit(Request $request)
    {
        $this->validate($request, [
            'limit' => 'required|integer'
        ]);

        $settings = Setting::where('id',1)->first();
        if(!$settings){
            $settings = new Setting();
            $settings->id = 1;
        }
        $settings->daily_gift_limit = $request->input('limit',1);
        if($settings->save()){
            $log = new Logger('reset_daily_gift_limit');
            $log->pushHandler(new StreamHandler('../storage/logs/monolog.log'));
            $log->info('daily send gift limit',['ip' => $request->ip(), 'new_limit' => $settings->daily_gift_limit]);
            return response()->json(['status' => 1, 'message' => 'update daily gift send limit.'],200);
        }

        return response()->json(['status' => 0, 'message' => 'unexpected error.'],400);
    }

    public function pending_list()
    {
        return UserGift::select('user_gifts.id as id','users.name as sender_name','gifts.name as gift_name','user_gifts.created_at')->join('users','users.id','user_gifts.sender_id')->join('gifts','gifts.id','user_gifts.gift_id')->where('gifts.status',1)->where('user_gifts.status',0)->orderBy('user_gifts.created_at','DESC')->get()->toJson();
    }
}
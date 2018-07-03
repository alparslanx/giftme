<?php

namespace App\Http\Controllers\Api\User\User;

use App\Log;
use App\Setting;
use App\User;
use App\UserGift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    public function approved_list()
    {
        return UserGift::select('user_gifts.id as id','users.name as sender_name','gifts.name as gift_name','user_gifts.updated_at')->join('users','users.id','user_gifts.sender_id')->join('gifts','gifts.id','user_gifts.gift_id')->where('user_gifts.user_id',Auth::user()->id)->where('gifts.status',1)->where('user_gifts.status',1)->orderBy('user_gifts.updated_at','DESC')->get()->toJson();
    }

    public function pending_list()
    {
        return UserGift::select('user_gifts.id as id','users.name as sender_name','gifts.name as gift_name','user_gifts.updated_at')->join('users','users.id','user_gifts.sender_id')->join('gifts','gifts.id','user_gifts.gift_id')->where('user_gifts.user_id',Auth::user()->id)->where('gifts.status',1)->where('user_gifts.status',0)->orderBy('user_gifts.updated_at','DESC')->get()->toJson();
    }


    public function list()
    {
        return UserGift::select('user_gifts.id as id','users.name as sender_name','gifts.name as gift_name','user_gifts.updated_at')->join('users','users.id','user_gifts.sender_id')->join('gifts','gifts.id','user_gifts.gift_id')->where('user_gifts.user_id',Auth::user()->id)->where('gifts.status',1)->orderBy('gifts.name','ASC')->groupBy('user_gifts.gift_id')->get()->toJson();
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'to' => 'required|email'
        ]);


        $user = User::where('email',$request->input('to'))->first();
        if(!$user){
            return response()->json(['status' => 0, 'message' => 'user not found.'],400);
        }

        $gift = UserGift::where('id',$request->input('id',1))->where('user_id',Auth::user()->id)->where('status',1)->first();
        if(!$gift){
            return response()->json(['status' => 0, 'message' => 'gift not found.'],400);
        }


        $dailyUniqueGiftsend = UserGift::where('created_at','>=',Carbon::yesterday())->where('sender_id',Auth::user()->id)->where('user_id',$user->id)->get();
        if($dailyUniqueGiftsend->count() < Setting::daily_send_gift_limit()){
            $gift->user_id = $user->id;
            $gift->sender_id = Auth::user()->id;
            if($gift->save()){

                Log::add([
                    'user_id'   =>  $request->user()->id,
                    'ip'        =>  $request->ip(),
                    'module_name'=> 'send_gift',
                    'old_data'  =>  [],
                    'new_data'  =>  $gift,
                    'process'   =>  'insert'
                ]);

                return response()->json(['status' => 1, 'message' => 'gift sent.'],200);
            }
        }else{
            return response()->json(['status' => 0, 'message' => 'unique user daily limit 1.'],400);
        }
        return response()->json(['status' => 0, 'message' => 'unexpected error.'],400);
    }

    public function change_status(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'status' => 'required|in:1,2'
        ]);

        $id = $request->input('id',0);
        $status = $request->input('status',0);

        $userGift = UserGift::where('id',(int)$id)->where('status',0)->where('user_id',Auth::user()->id)->first();

        if(!$userGift){
            return response()->json(['status' => 0, 'message' => 'access danied.'],400);
        }

        $oldUserGift = $userGift;

        $userGift->status = (int)$status;
        if($userGift->save()){

            Log::add([
                'user_id'   =>  $request->user()->id,
                'ip'        =>  $request->ip(),
                'module_name'=> 'change_gift',
                'old_data'  =>  $oldUserGift,
                'new_data'  =>  $userGift,
                'process'   =>  'update'
            ]);

            return response()->json(['status' => 1, 'message' => 'successful'],200);
        }

        return response()->json(['status' => 0, 'message' => 'unknown error...'],200);
    }
}

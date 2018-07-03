<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public static function daily_send_gift_limit()
    {
        $settings = Setting::where('id',1)->first();
        if(!$settings){
            return 1;
        }
        return $settings->daily_gift_limit;
    }
}

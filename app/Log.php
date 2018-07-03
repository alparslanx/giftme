<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public static function add($array=array())
    {
        $logModel = new static;
        $logModel->user_id = !empty($array['user_id']) ? (int)$array['user_id'] : 0;
        $logModel->ip = !empty($array['ip']) ? $array['ip'] : '';
        $logModel->module_name = !empty($array['module_name']) ? $array['module_name'] : '';
        $logModel->old_data = !empty($array['old_data']) ? $array['old_data'] : '';
        $logModel->new_data = !empty($array['new_data']) ? $array['new_data'] : '';
        $logModel->process = !empty($array['process']) && in_array($array['process'],['update','insert','delete']) ? $array['process'] : '';
        return $logModel->save();
    }
}

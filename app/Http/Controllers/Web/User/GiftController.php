<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GiftController extends Controller
{
    public function index()
    {
        return view('web.gift.index');
    }


    public function pending()
    {
        return view('web.gift.pending');
    }

    public function send()
    {
        return view('web.gift.send');
    }
}

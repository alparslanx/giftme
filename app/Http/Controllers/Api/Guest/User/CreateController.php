<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Log;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class CreateController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:25',
            'lastname' => 'required|min:3|max:25',
            'password' => 'required|min:5',
            'password2' => 'required|min:5|same:password',
            'email' => 'required|unique:users,email|email|min:5|max:255',
        ]);

        $user = new User();
        $user->name = Str::lower($request->input('name'));
        $user->lastname = Str::lower($request->input('lastname'));
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if($user->save()){
            Log::add([
                'user_id'   =>  $user->id,
                'ip'        =>  $request->ip(),
                'module_name'=> 'user',
                'old_data'  =>  [],
                'new_data'  =>  $user,
                'process'   =>  'insert'
            ]);
            Auth::attempt(['email' => $user->email, 'password' => $request->input('password')],1);
            return response()->json(['message'=> 'Successful', 'status' => 1], 200);
        }
        return response()->json(['message'=>'Unsuccessful', 'status' => 0], 400);
    }
}
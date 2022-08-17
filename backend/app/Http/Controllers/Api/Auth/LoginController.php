<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $user = $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!Auth::attempt($user)){
            return response()->json(['msg' =>  'زانیاریەکانت هەڵەیە']);
        }

        $token = Auth::user()->createToken('onlineshopping_2022_16_8')->accessToken;

        return response()->json(['user' =>  Auth::user(), 'token' => $token]);
    }
}

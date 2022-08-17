<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request){
        $user = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'min:6|confirmed',
            'address' => 'required',
            'phone_number' => 'required|unique:users,phone_number'
        ]);

        User::create($user);

        Auth::attempt(['email' => $user['email'], 'password' => $user['password']]);

        $token = Auth::user()->createToken('onlineshopping_2022_16_8')->accessToken;

        return response()->json(['user' =>  Auth::user(), 'token' => $token]);
    }
}

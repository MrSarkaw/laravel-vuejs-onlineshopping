<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        Auth::user()->token()->revoke();

        return response()->json([
            'msg' => 'successfully logout'
        ]);
    }

    public function getUser(){
        return response()->json([
            'user' => Auth::user()
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login(Request $request) {
        $values = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $login = Auth::attempt($values);
        session()->regenerate();
        return response()->json('You have Successfully Signed in.', 200);
    }
}

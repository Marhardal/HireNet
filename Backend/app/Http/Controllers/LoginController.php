<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $values = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $login = Auth::attempt($values);
        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    public function Logout(Request $request)
    {
        Auth::guard('web')->logout();
        request()->user()->currentAccessToken()->delete();
        return response()->json(['message' => request()->user()->currentAccessToken()]);
    }

    public function User(){
        $user = request()->user();
        // $resume = Resume::where('user_id', $user->id)->certificates;
        return response()->json(['user' => $user, 'role' => $user->role], 200);
    }
}

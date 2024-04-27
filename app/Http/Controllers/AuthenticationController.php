<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'username' => 'required|unique:users|max:24',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image_path' => "profile_pictures/profile.jpg",
            'role_id' => 2,
        ]);

        return response()->json([
            "data" => [
                "message" => "Register Success!"
            ]
        ]);
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required|max:16',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) { 
            $token = $request->user()->createToken('token');
 
            return response()->json([
                "data" => [
                    "message" => "Login Success!",
                    "token" => $token->plainTextToken
                ]
            ]);
        }

        return response()->json([
            "data" => [
                "message" => "Login Failed!"
            ]
        ]);
    }
    
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "data" => [
                "message" => "Logout success!"
            ]
        ]);
    }
}

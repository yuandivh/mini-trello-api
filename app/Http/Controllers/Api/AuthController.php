<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller

{
    //
    public function register(RegisterRequest $request){
        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);

        return response()->json([
            "message"=>"User registered successfully",
            "user"=>$user
        ],201);
    }


    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)){
            return response()->json([
                "message"=>"Invalid credentials"
            ],401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken("api_token")->plainTextToken;

        return response()->json([
            "message"=>"User logged in successfully",
            "token"=>$token
        ],200);
    }

    public function logout (Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
           "message"=>"User logged out successfully"
        ],200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'full_name' => $request->full_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar,
            'status' => User::GUEST
        ]);
        return response()->json([
            'message' => 'User registered successfully.',
            'data' => $user->only('id', 'full_name','username','email','status')
        ],Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user =  Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ],Response::HTTP_OK);
    }

    public function logout(LogoutRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        Token::where('tokenable_id', $user->id)->delete();

        return response()->json([
            "message" => "Successfully logout"
        ], Response::HTTP_OK);
    }
}

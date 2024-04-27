<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    public function getProfile():JsonResponse
    {
        $user = auth()->user();

        return response()->json($user, Response::HTTP_OK);
    }

    public function updateProfile(UpdateProfileRequest $request, User $user):JsonResponse
    {
        if(!$user){
            return response()->json('User not found.', Response::HTTP_NOT_FOUND);
        }
        $user->update([
            'full_name' => $request->has('full_name') ? $request->full_name : $user->full_name,
            'username' => $request->has('username') ? $request->username : $user->username,
            'email' => $request->has('email') ? $request->email : $user->email,
            'avatar' => $request->has('avatar') ? $request->avatar : $user->avatar
        ]);
        return response()->json(['Profile updated successfully', $user], Response::HTTP_OK);
    }


}

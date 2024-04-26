<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = auth()->user();

        return response()->json($user, Response::HTTP_OK);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = User::findOrFail(auth()->user()->id);
        } catch (ModelNotFoundException $e) {
            return response()->json('User not logged in.', Response::HTTP_UNAUTHORIZED);
        }

        $user->update([
            'full_name' => isset($request->full_name) ? $request->full_name : $user->full_name,
            'username' => isset($request->username) ? $request->username : $user->username,
            'email' => isset($request->email) ? $request->email : $user->email,
            'avatar' => isset($request->avatar) ? $request->avatar : $user->avatar
        ]);

        return response()->json(['Profile updated successfully', $user], Response::HTTP_OK);
    }


}

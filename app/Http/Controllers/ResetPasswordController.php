<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ResetPasswordLink;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LinkEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResetPasswordController extends Controller
{
    public function changePassword(ResetPasswordRequest $request):JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "message" => "Password has been changed"
        ], Response::HTTP_OK);
    }
    public function resetPassword(ResetPasswordRequest $request):JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            "message" => "Password has been changed"
        ], Response::HTTP_OK);
    }

    public function sendLinkResetPassword(LinkEmailRequest $request):JsonResponse
    {
        $url = URL::temporarySignedRoute('user.reset-password-mail',
            now()->addMinutes(10), ['email' => $request->email]);

        Mail::to($request->email)->send(new ResetPasswordLink($url));

        return response()->json([
            'message' => 'Reset password link sent on your email'
        ], Response::HTTP_OK);
    }

}

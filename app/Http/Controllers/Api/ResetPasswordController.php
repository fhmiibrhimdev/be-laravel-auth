<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return response()->json(['reset_token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = $this->broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? response()->json(['message' => trans($response)])
                    : response()->json(['error' => trans($response)], 400);
    }

    private function broker()
    {
        return Password::broker();
    }

    private function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        event(new PasswordReset($user));
    }
}

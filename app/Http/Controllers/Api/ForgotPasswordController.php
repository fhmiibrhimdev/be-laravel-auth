<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset password link sent to your email.']);
        }

        return response()->json(['message' => 'Failed to send reset password link.'], 400);
    }

    private function broker()
    {
        return Password::broker();
    }
}

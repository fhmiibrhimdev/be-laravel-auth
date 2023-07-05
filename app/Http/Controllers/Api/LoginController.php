<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if(!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Your email or password is wrong!'
            ], 401);
        }

        $user = auth()->user();

        if (!$user->active) {
            return response()->json([
                'success' => false,
                'message' => 'Your account is not active. Please contact the administrator.'
            ], 403);
        }

        $role = '';
        if ($user->hasRole('admin')) {
            $role = 'admin';
        } else if ($user->hasRole('user')) {
            $role = 'user';
        }

        if ($remember) {
            $rememberToken = Str::random(60);
            $user->forceFill([
                'remember_token' => hash('sha256', $rememberToken),
            ])->save();

            $cookie = cookie('remember_token', $rememberToken, 1440); // 1 hari (1440 menit)

            return response()->json([
                'success'   => true,
                'user'      => $user,
                'role'      => $role, 
                'token'     => $token
            ])->cookie($cookie);
        }

        return response()->json([
            'success' => true,
            'user'    => $user,   
            'role'    => $role, 
            'token'   => $token   
        ], 200);
    }
}
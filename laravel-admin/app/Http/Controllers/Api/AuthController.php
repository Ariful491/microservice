<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return response([
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = auth()->user();
        $token = $user->createToken('admin')->accessToken;
        $cookie = cookie('jwt', $token, 3600);

        return response([
            'token' => $token
        ])->withCookie($cookie);

    }


    public function logout()
    {
        $cookie = Cookie::forget('jwt');
       // auth()->logout();

        return response([
            'message' => 'Success'
        ])->withCookie($cookie);

    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'password');
        $user = new User();
        $user->fill($data);
        $user->save();

        return response($user, Response::HTTP_CREATED);
    }
}

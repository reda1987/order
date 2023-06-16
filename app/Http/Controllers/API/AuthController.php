<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateRegisterRequest;
use App\Http\Requests\CreateLoginRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{    
        
    /**
     * Register a User.
     * @param  App\Http\Requests\CreateRegisterRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(CreateRegisterRequest $request)
    {        
        $user = User::create($request->validated());
        return response()->json($user, 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return App\Http\Requests\CreateLoginRequest
     */
    public function login(CreateLoginRequest $request)
    {
        $token = auth()->attempt($request->validated());
        return $this->createNewToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}

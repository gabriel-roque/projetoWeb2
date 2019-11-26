<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validateData = $request->all();

        $validateData['password'] = bcrypt($request->password);

        $user = User::create($validateData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['user' => $user, 'access_token' => $accessToken]);

    }

    public function login(Request $request)
    {

        $validateData = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|',
        ]);

        if(!auth()->attempt($validateData)){
            return  response(['message'=> 'Login invalido']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user'=> auth()->user(), 'access_token' => $accessToken]);
    }
    public function loginw(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

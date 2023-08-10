<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginPostRequest;
use App\Http\Requests\API\V1\UserPostRequest;
use App\Http\Resources\API\V1\LoginResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserPostRequest $request)
    {
        $validatedData = $request->validated();

        $user            = new User();
        $user->firstname = $validatedData['name'];
        $user->lastname  = $validatedData['name'];
        $user->password  = $validatedData['password'];
        $user->email     = $validatedData['email'];
        $user->save();

        return response()->json(['data' => (object) []], 201);
    }

    public function login(LoginPostRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user        = User::where('email', $credentials['email'])->first();
            $accessToken = $user->createToken('auth-token')->plainTextToken;

            return new LoginResource(['access_token' => $accessToken]);
        } else {
            return error_response_handling(401);
        }
    }
}

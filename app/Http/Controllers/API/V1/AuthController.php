<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserPostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(UserPostRequest $request)
    {
        $validatedData = $request->validated();

        // set the password using bcrypt & remove the password confirmation
        Arr::set($validatedData, 'password', bcrypt($validatedData['password']));
        $fixedUser = Arr::except($validatedData, ['password_confirmation']);

        User::create($fixedUser);

        return response()->json(['data' => (object) []]);
    }
}

<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserPostRequest;
use App\Models\User;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    public function register(UserPostRequest $request)
    {
        $validatedData = $request->validated();

        $user              = new User;
        $firstName         = $user->getFirstName($validatedData['name']);
        $lastName          = $user->getLastName($validatedData['name']);
        $encryptedPassword = $user->getEncryptedPassword($validatedData['password']);

        // set new value for firtsname, lastname, and password fields
        Arr::set($validatedData, 'firstname', $firstName);
        Arr::set($validatedData, 'lastname', $lastName);
        Arr::set($validatedData, 'password', $encryptedPassword);

        $user->create($validatedData);

        return response()->json(['data' => (object) []], 201);
    }
}

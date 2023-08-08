<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\UserPostRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(UserPostRequest $request)
    {
        $validatedData = $request->validated();

        // preparation code to separate firstname & lastname
        $nameArray           = Str::of($validatedData['name'])->explode(' ');
        $nameFlattenArray    = Arr::flatten($nameArray);
        $firstNameCollection = collect(Arr::except($nameFlattenArray, [count($nameFlattenArray) - 1]));

        // get firstname & lastname
        $firstName = $firstNameCollection->implode(' ');
        $lastName  = Arr::last($nameFlattenArray);

        // update password encryption
        Arr::set($validatedData, 'password', Hash::make($validatedData['password']));

        // add firstname & lastname
        Arr::set($validatedData, 'firstname', $firstName);
        Arr::set($validatedData, 'lastname', $lastName);

        // remove name field
        $fixedUser = Arr::except($validatedData, ['name']);

        User::create($fixedUser);

        return response()->json(['data' => (object) []], 201);
    }
}

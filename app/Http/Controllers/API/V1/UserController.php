<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
// use App\Http\Resources\API\V1\UserCollection;
use App\Http\Resources\API\V1\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(5));
    }
}

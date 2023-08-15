<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(5));
    }

    public function detail(User $user)
    {
        return new UserResource($user);
    }
}

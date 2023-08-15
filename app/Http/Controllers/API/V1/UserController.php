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
        // $currentToken = Auth::user()->currentAccessToken();
        // $token = $user->tokens()->find($currentToken);

        // if ($token->isEmpty()) {
        //     return error_response_handling(401);
        // } else {
        //     return new UserResource($user);
        // }
    }
}

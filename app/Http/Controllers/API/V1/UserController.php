<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = new User();

        if ($request->search) {
            $users = $users->whereHas('addresses', function ($query) use ($request) {
                $query->where('street', 'LIKE', "%$request->search%");
            });
        }

        $users = $users->paginate(5)->withQueryString();

        return UserResource::collection($users);
    }

    public function detail(User $user)
    {
        return new UserResource($user);
    }
}

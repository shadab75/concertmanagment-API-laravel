<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return response()->json([
            'data'=>UserResource::collection(User::all())
        ],200);
    }

    public function show(User $user)
    {
        return response()->json([
           'data'=>New UserResource($user)
        ],200);

    }
}

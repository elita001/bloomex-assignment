<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\UserResource;
use App\Models\User;

class UserController
{
    /**
     * Returns the list of users in JSON format
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {
        return UserResource::collection(User::with('userAddress')->with('userPhones')->get());
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserAddressController extends Controller
{
    public function countries() {
        return response()->json((new UserRepository())->getCountries());
    }
}

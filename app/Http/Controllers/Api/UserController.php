<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Eager load roles so that each user includes a roles array.
        return response()->json(User::with('roles')->get());
    }
}

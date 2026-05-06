<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        // For now, just show the current user's profile
        // In the future, this will show other users' profiles
        return view('users.show');
    }
}

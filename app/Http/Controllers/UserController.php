<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
{
    $users = User::all(); // Retrieve all users
    return view('dashboard', compact('users'));
}
}

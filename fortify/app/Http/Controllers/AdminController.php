<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        // get all users except admin
        $users = User::where('role', '!=', 2)->get();
        // return view('admin.dashboard');
        return view('admin.dashboard', compact('users'));
    }
}

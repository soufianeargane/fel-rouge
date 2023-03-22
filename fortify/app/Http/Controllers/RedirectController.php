<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    //
    public function redirect()
    {
        if (Auth::user()->role == 2) {
            return redirect()->route('admin');
        } elseif (Auth::user()->role == 1) {
            # code...
            return redirect()->route('owner');
        } else {
            return redirect()->route('store');
        }
    }
}

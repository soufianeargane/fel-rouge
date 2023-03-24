<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserController extends Controller
{
    //
    public function index()
    {
        $accepted_stores = Store::where('status', '1')->get();
        // dd($accepted_stores);
        return view('client.store', compact('accepted_stores'));
    }

    
}

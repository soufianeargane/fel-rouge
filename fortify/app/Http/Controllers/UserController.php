<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use Termwind\Components\Dd;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $accepted_stores = Store::where('status', '1')->get();
        // dd($accepted_stores);
        $cities = City::all();
        return view('client.store', compact('accepted_stores', 'cities'));
    }

    
}

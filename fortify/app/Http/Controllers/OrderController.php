<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        // get id of store
        $store_id = $request->store_id;
        $user_id = auth()->user()->id;
        $total_price = $request->total_price;
        $order = $request->order;
        return response()->json([
            'status' => 'success',
            'order' => $order[0]['id'],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Mail\NewOrder;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    //
    public function store(Request $request)
    {
        // get id of store
        $store_id = $request->store_id;
        $user_id = auth()->user()->id;
        // $total_price = $request->total_price;
        $order = $request->order;
        $total_price = 0;
        foreach ($order as $key => $value) {
            $total_price += $value['price'] * $value['quantity'];
        }

        // create order
        $new_order = Order::create([
            'user_id' => $user_id,
            'store_id' => $store_id,
            'total_price' => $total_price
        ]);

        // attach products to order
        foreach ($order as $item){
            $product_id = $item['id'];
            // return $product_id;
            $quantity = $item['quantity'];
            // return $quantity;
            $new_order->products()->attach($product_id, ['quantity' => $quantity]);

            // update quantity of product
            $product = Product::find($product_id);
            $product->quantity -= $quantity;
            $product->save();
        }


        $user = auth()->user();

        // get email of store owner
        $store = Store::find($store_id);
        $store_owner = $store->user;
        $store_owner_email = $store_owner->email;

        // send email to store owner
        Mail::to($store_owner_email)->send(new NewOrder($user));

        return response()->json([
            'status' => 'success',
            'store_owner_email' => 'email sent to store owner'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Store;
use App\Mail\NewOrder;
use App\Models\Product;
use App\Mail\OrderAccepted;
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

    public function index(){
        // get all orders of owner
        $user_id = auth()->user()->id;
        //get store of owner
        $store = Store::where('user_id', $user_id)->first();
        $store_id = $store->id;
        $orders = Order::where('store_id', $store_id)
                ->with('products', function ($query) {
                    $query->withPivot('quantity');
                })
                ->get();
        return view('owner.orders', compact('orders'));
    }

    public function show($id)
    {
        $products = Order::findOrFail($id)
                        ->products()
                        ->withPivot('quantity')
                        ->get();
        return response()->json([
            'status' => 'success',
            'data' => $products // update variable name here
        ]);
    }


    public function downloadPdf(Request $request)
    {
        // Get the HTML content of the table from the "html" query parameter
        $html = $request->input('html');

        // Create new instance of Dompdf class
        $pdf = new Dompdf();

        // Load HTML content into Dompdf instance
        $pdf->loadHtml($html);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render PDF
        $pdf->render();

        // style the pdf

        // make font size bigger of table in pdf
        $pdf->set_option('defaultFont', 'Courier');
        $pdf->set_option('defaultFont', 'Courier');
        $pdf->set_option('isFontSubsettingEnabled', true);
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);

        // Generate response with PDF file as download attachment
        return $pdf->stream('table.pdf');
    }


    public function action(Request $request)
    {
        # code...
        if ($request->status == 1) {
            // accept order
            $order = Order::find($request->order_id);
            $order->status = 1;
            $order->save();

            // get email of user who made order
            $user = $order->user;
            $user_email = $user->email;
            $user_name = $user->name;

            // title of store
            $store = $order->store;
            $store_name = $store->title;

            // send email to user
            Mail::to($user_email)->send(new OrderAccepted($store_name, $order->id, $order->total_price, $user_name ));

            return redirect()->back()->with('success', 'Order accepted');


        }else if ($request->status == 2) {
            // reject order
            $order = Order::find($request->order_id);
            $order->status = 2;
            // get quantity of products in order
            $products = $order->products;
            foreach ($products as $product) {
                # code...
                $product_id = $product->id;
                $quantity = $product->pivot->quantity;
                // update quantity of product
                $product = Product::find($product_id);
                $product->quantity += $quantity;
                $product->save();
            }
            $order->save();

            return redirect()->back()->with('success', 'Order rejected');
        }
        else {
            # code...
            return abort(404);
        }
    }
}

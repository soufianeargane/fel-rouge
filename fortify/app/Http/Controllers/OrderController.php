<?php

namespace App\Http\Controllers;

use stdClass;
use Throwable;
use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Store;
use App\Mail\NewOrder;
use App\Models\Product;

use App\Mail\OrderAccepted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        foreach ($order as $item) {
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

    public function index()
    {
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
            Mail::to($user_email)->send(new OrderAccepted($store_name, $order->id, $order->total_price, $user_name));

            return redirect()->back()->with('success', 'Order accepted');


        } else if ($request->status == 2) {
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
        } else {
            # code...
            return abort(404);
        }
    }


    public function oneOrder($id, $store_id)
    {
        # code...
        $user_id = auth()->user()->id;

        // get all products of store where deleted_at is null
        $store = Store::where('id', $store_id)->first();
        $store_id = $store->id;
        $Products = Product::where('store_id', $store_id)->whereNull('deleted_at')->get();

        // get first order of user and products in order
        $order = Order::where('id', $id)
            ->with('products', function ($query) {
                $query->withPivot('quantity');
            })
            ->first();


        // return view('client.orders', compact('order'));
        $orderArr = [];
        foreach ($order->products as $product) {
            $obj = new stdClass();
            $obj->id = $product->id;
            $obj->name = $product->name;
            $obj->price = $product->price;
            $obj->quantity = $product->pivot->quantity;
            $obj->original_qty = $product->pivot->quantity;
            $orderArr[] = $obj;
        }
        return view('client.order-edit', [
            'order' => json_encode($orderArr),
            'products' => $Products,
            'order_id' => $id,
        ]);
    }

    public function userOrders()
    {
        # code...
        $user_id = auth()->user()->id;
        $orders = Order::where('user_id', $user_id)
            ->with('products', function ($query) {
                $query->withPivot('quantity');
            })
            ->get();
        return view('client.orders', compact('orders'));


    }

    public function updateOrder(Request $request, $id)
    {
        # code...
        $order = Order::findOrFail($id);
        $order_data = $request->order;
        $total_price = 0;
        try {
            //code...
            // update order total price
            $products = $order->products;
            foreach ($products as $product) {
                # code...
                $product_id = $product->id;
                $quantity = $product->pivot->quantity;
                // update quantity of product
                $product = Product::find($product_id);
                // return $product;
                $product->quantity += $quantity;
                $product->save();
            }
            $order->products()->detach();

            // attach the new products to the order
            foreach ($order_data as $product_data) {

                $product = Product::findOrFail($product_data['id']);
                $quantity = $product_data['quantity'];
                // update the product quantity
                $product->quantity -= $quantity;
                $product->save();
                // attach the product to the order
                $order->products()->attach($product->id, ['quantity' => $quantity]);

                // update the total price of the order
                $total_price += $product->price * $quantity;
            }
            $order->total_price = $total_price;
            return response()->json(['message' => 'Order updated successfully'], 200);
        } catch (Throwable $th) {

            return response()->json(['message' => 'Failed to update order'], 500);
        }
    }
}



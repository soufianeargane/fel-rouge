<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index()
    {   
        $user_id = Auth::id();
        // get all categories
        $categories = Category::all();
        $products = Product::whereHas('store', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->with('category')->get();
        // $ss = $products->toArray();
        return view('owner.products', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        // return 5;
        $request->validate([
            'name' => 'required',
            'price' => 'required | numeric',
            'quantity' => 'required | numeric ',
            'category_id' => 'required | numeric',
            'image' => 'required | image | mimes:jpeg,png,jpg,gif,svg | max:2048',
        ]);

        $user_id = Auth::id();
        $store = Store::where('user_id', $user_id)->first();
        $store_id = $store->id;

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->store_id = $store_id;
        // save image using move public_path('images')
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/products'), $image_name);
        $product->image = $image_name;
        $product->save();

        session()->flash('success', 'Produit ajouté avec succès');
        return redirect()->back();
    }
}

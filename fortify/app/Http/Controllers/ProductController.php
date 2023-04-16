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
        
        // $products = Product::whereHas('store', function ($query) use ($user_id) {
        //     $query->where('user_id', $user_id);
        // })->with('category')->get();
        // $ss = $products->toArray();
        $store = Store::where('user_id', auth()->user()->id)
                ->where('status', 1)
                ->whereNull('deleted_at')
                ->first();
        $products = Product::where('store_id', $store->id)
                ->with('category')
                ->get();
    
        // get all categories
        $categories = Category::all();
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
        $store = Store::where('user_id', $user_id)
                ->where('status', 1)
                ->whereNull('deleted_at')
                ->first();
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

    public function delete($id)
    {
        # code...
        $product = Product::find($id);
        $this->authorize('delete', $product);
        $product->delete();
        session()->flash('success', 'Produit supprimé avec succès');
        return redirect()->back();
    }

    public function show($id)
    {
        # code...
        $product = Product::find($id);
        // $this->authorize('view', $product);
        return response()->json([
            'product' => $product,
        ]);

    }

    public function update(Request $request){
        // return $request->product_id;
        $product = Product::find($request->product_id);
        $this->authorize('delete', $product);
        $validate = $request->validate([
            'name' => 'required',
            'price' => 'required | numeric',
            'quantity' => 'required | numeric ',
            'category_id' => 'required | numeric',
        ]);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;

        $image = $request->file('image');
        if($image){
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/products'), $image_name);
            $product->image = $image_name;
        }
        $product->save();
        session()->flash('success', 'Produit modifié avec succès');
        return redirect()->back();
    }
}

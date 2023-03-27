<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Validation\Rules\PhoneNumber;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('client.store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('client.create-store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'title' => 'required',
            'phone' => [
                'required',
                'regex:/^(?:\+212|0)[1-9][\d]{8}$/'
            ],
            'city' => 'required',
            'neighborhood' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/store'), $new_name);
        $form_data = array(
            'title' => $request->title,
            'phone' => $request->phone,
            'city' => $request->city,
            'neighborhood' => $request->neighborhood,
            'image' => $new_name,
            'user_id' => auth()->user()->id,
        );
        Store::create($form_data);
        // session flash success
        // return redirect()->route('store')->with('message', 'your request was added successfully. you will be informed via email if you get accepted .');
        // return view('client.store')->with('message', 'your request was added successfully. you will be informed via email if you get accepted .');
        session()->flash('message', 'your request was added successfully. you will be informed via email if you get accepted .' );
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        // get all products of this store
        $products = $store->products;
        return view('client.store-products', compact('products', 'store'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}

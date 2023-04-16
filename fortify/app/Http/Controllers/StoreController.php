<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $accepted_stores = Store::where('status', '1')
            ->whereNull('deleted_at')
            ->get();
        return response()->json([
            'stores' => $accepted_stores,
        ]);
        // // dd($accepted_stores);
        // return view('client.store', compact('accepted_stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        // check if the user has a store with status 0
        $store = $user->stores()->where('status', 0)->first();

        // if the user has a store with status 0, redirect them to the special view
        if ($store) {
            $title = 'Waiting for Approval';
            $discription = 'You Have a Pending Request, Please Wait for Approval';
            return view('client.refuse', compact('title', 'discription'));
        }
        // get all cities
        $cities = City::all();

        return view('client.create-store', compact('cities'));
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
            'city_id' => 'required|numeric',
            'neighborhood' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Invalid phone number format. It must be a moroccan phone number',
        ]);

        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img/store'), $new_name);
        $form_data = array(
            'title' => $request->title,
            'phone' => $request->phone,
            'neighborhood' => $request->neighborhood,
            'image' => $new_name,
            'user_id' => auth()->user()->id,
            'city_id' => $request->city_id,
        );
        Store::create($form_data);
        // session flash success
        return redirect()->route('user')->with('message', 'your request was added successfully. you will be informed via email if you get accepted .');
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
    public function update(Request $request)
    {
        //
        $validate = $request->validate([
            'title' => 'required',
            'phone' => [
                'required',
                'regex:/^(?:\+212|0)[1-9][\d]{8}$/'
            ],
            'city_id' => 'required|numeric',
            'neighborhood' => 'required',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Invalid phone number format. It must be a moroccan phone number',
        ]);

        $user_id = auth()->user()->id;
        // get store of this user and not deleted
        $store = Store::where('user_id', $user_id)->where('deleted_at', null)->first();
        if(!$store){
            return abort(403, 'store not found');
        }
        $store->title = $request->title;
        $store->phone = $request->phone;
        $store->city_id = $request->city_id;
        $store->neighborhood = $request->neighborhood;
        if($request->image){
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/store'), $new_name);
            $store->image = $new_name;
        }
        $store->save();
        // session flash success
        return redirect()->back()->with('message', 'your store was updated successfully');
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

    public function details($id)
    {
        // get the store with the given id
        $store = Store::find($id);
        if(!$store){
            return abort(403, 'store not found');
        }

        // check if the store is accepted
        if($store->status != 1){
            return abort(403, 'store not found');
        }

        // check if the store is deleted
        if($store->deleted_at != null){
            return abort(403, 'store not found');
        }

        // get all products of this store
        $products = $store->products;

        return view('client.store-details', compact('products', 'store'));
    }


    public function adminStore()
    {
        # code...
        $stores = Store::with('city')
                ->where('status', '!=', '0')
                ->get();
        return view('admin.stores', compact('stores'));
    }

    public function allDetails($id)
    {
        # code...
        /*
        total profit from last month:
            $last_month_orders = $store->orders()
                ->whereBetween('created_at', [now()->subMonth(), now()])
                ->get();

            foreach ($last_month_orders as $order) {
                $total_orders++;
                if ($order->status == 1) {
                    $total_profit += $order->total_price;
                    $total_orders_accepted++;
                } else {
                    $total_orders_rejected++;
                }
            }

            $products = $store->products;
            $product_count = $products->count();

            // $total_profit contains the total profit of the store from last month
         */
        // ===================================================

        $store = Store::find($id);
        if(!$store){
            return abort(404, 'store not found');
        }
        $total_profit = 0;
        $total_orders = 0;
        $total_orders_accepted = 0;
        $total_orders_rejected = 0;

        foreach($store->orders as $order){
            $total_orders++;
            if($order->status == 1){
                $total_profit += $order->total_price;
                $total_orders_accepted++;
            }else{
                $total_orders_rejected++;
            }
        }
        $products = $store->products;
        $product_count = $products->count();

        return view('admin.store-alldetails', compact('store', 'total_profit', 'total_orders', 'total_orders_accepted', 'total_orders_rejected', 'product_count'));

        // count of products


        // return view('admin.store-details', compact('store'));
    }

    public function deleteStore(Request $request)
    {
        $store = Store::find($request->store_id);
        if (! $store) {
            # code...
            return abort(404, 'store not found');
        }

        // get orders of this store where status is 0
        $orders = $store->orders()->where('status', 0)->get();
        $size = $orders->count();
        if($size > 0){
            $title = 'Request denied';
            $discription = 'You can not delete This Store because it has orders that are not Accepted or Rejected';
            return view('client.refuse', compact('title', 'discription'));
        }

        // get user with this store
        $user = User::find($store->user_id);
        $user->role = 0;
        $user->save();



        $store->status = 2;
        $store->deleted_at = now();
        $store->save();

        return redirect()->back()->with('message', 'store deleted successfully');
    }


    public function filterStores($id){
        $stores = Store::where('city_id', $id)->whereNull('deleted_at')->get();
        return response()->json([
            'stores' => $stores,
        ]);
    }

    public function ownerStore()
    {
        # code...
        // $store = Store::where('user_id', auth()->user()->id)->first();
        $store = Store::where('user_id', auth()->user()->id)->whereNull('deleted_at')->first();
        $cities = City::all();

        if(!$store){
            return abort(404, 'store not found');
        }
        // dd($store);
        return view('owner.store-info', compact('store', 'cities'));
    }

    public function deleteOneStore(Request $request){
        $store = Store::where('user_id', auth()->user()->id)
            ->whereNull('deleted_at')
        ->first();
        if(!$store){
            return abort(404, 'store not found');
        }

        // get orders of this store where status is 0
        $orders = $store->orders()->where('status', 0)->get();
        $size = $orders->count();
        if($size > 0){
            $title = 'Request denied';
            $discription = 'You can not delete Your Store because it has orders that are not Accepted or Rejected';
            return view('client.refuse', compact('title', 'discription'));
        }

        $store->status = 2;
        $store->deleted_at = now();
        $store->save();

        $user = User::find($store->user_id);
        $user->role = 0;
        $user->save();

        // logout
        Auth::logout();

        return redirect()->route('landing')->with('message', 'store deleted successfully');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    //
    public function index()
    {
        $user_id = auth()->user()->id;
        $stores = DB::table('stores')->where('user_id', $user_id)->where('status',1)->get();
        dd($stores);
        // $storeId = ; 

        $store = Store::with('ratings.user')->where('id', $storeId)->first();

        if ($store) {
            $commentsData = [];
            foreach ($store->ratings as $rating) {
                $commentsData[] = [
                    'id' => $rating->id,
                    'rating' => $rating->rating,
                    'comment' => $rating->comment,
                    'created_at' => $rating->created_at->diffForHumans(),
                    'user_name' => $rating->user->name,
                    'store_name' => $store->title,
                ];
            }
        } else {
            // Store not found, handle this case as needed
        }

        return view('owner.shop');
    }
}

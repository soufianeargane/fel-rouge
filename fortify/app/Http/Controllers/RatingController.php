<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use User model
use App\Models\User;

class RatingController extends Controller
{
    //


    public function storeRating(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'store_id' => 'required|integer',
            'comment' => 'required|string',
        ]);
        // return $request->comment;
        $store_id = $request->store_id;
        // return $store_id;
        $user = Auth::user();
        
        $order = $user->orders()->where('store_id', $store_id)->first();
        if (!$order) {
            return response()->json(['message' => 'You need to make an order from this store to rate it']);
        }

        return 'yess';

        // Insert the rating and comment into the database using the Laravel Rateable package

    }
}

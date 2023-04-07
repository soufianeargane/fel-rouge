<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
// use User model
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        $store = $store = Store::findOrFail($store_id);
        if(!$store) {
            return response()->json(['message' => 'Store not found']);
        }
        // $store->rate($request->rating, $user, [
        //     'comment' => $request->comment,
        // ]);
        $store->rate($request->rating, $request->comment);

        // return response()->json(['message' => 'Rating submitted successfully']);
        // retturn all ratings for the store
        return response()->json([
            'message' => 'Rating submitted successfully',
            'all ratings' => $store->ratings
        ]);


        // Insert the rating and comment into the database using the Laravel Rateable package

    }


    public function showRating($storeId)
    {
        // return $storeId;
        $store = Store::with('ratings.user')->findOrFail($storeId);
        // return $store->ratings;
        $averageRating = $store->averageRating;

        $latestComments = $store->ratings()->with('user')->orderByDesc('created_at')->take(3)->get();
        $latestCommentsData = [];

        foreach ($latestComments as $comment) {
            $latestCommentsData[] = [
                'comment' => $comment->comment,
                'user_name' => $comment->user->name,
            ];
        }
        // $averageRating without the decimal point
        $averageRating = (int) $averageRating;
        return response()->json([
            'average_rating' => $averageRating,
            'latest_comments' => $latestCommentsData,
        ]);
    }
}

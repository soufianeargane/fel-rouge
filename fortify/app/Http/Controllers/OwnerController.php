<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    //
    public function index()
    {
        $user_id = auth()->user()->id;
        $store = Store::where('user_id', $user_id)->where('status', 1)->first();
        // dd($store);
        $products = $store->products;
        $orders = $store->orders ;

        if ($store) {
            $averageRating = $store->averageRating;
            $comments = Store::with('ratings.user')->where('id', $store->id)->first();

            if ($comments) {
                $commentsData = [];
                foreach ($store->ratings as $rating) {
                    $commentsData[] = [
                        'rating' => $rating->rating,
                        'comment' => $rating->comment,
                        'created_at' => $rating->created_at->diffForHumans(),
                        'user_name' => $rating->user->name,
                    ];
                }
            }
        }

        // get status of orders
        $orders = $store->orders ;
        $statusCounts = [
            'pending' => 0,
            'accepted' => 0,
            'rejected' => 0,
        ];
        foreach ($orders as $order) {
            if ($order->status == 0) {
                $statusCounts['pending']++;
            } elseif ($order->status == 1) {
                $statusCounts['accepted']++;
            } elseif ($order->status == 2) {
                $statusCounts['rejected']++;
            }
        }


        return view('owner.shop', compact('store', 'commentsData', 'averageRating', 'statusCounts'));
    }
}

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
        $store = Store::where('user_id', $user_id)->where('status', 1)->whereNull('deleted_at')->first();

        // dd($store);
        $products = $store->products;
        $total_products = count($products);

        $orders = $store->orders ;
        $total_orders = count($orders);

        $total_revenue = 0;
        foreach ($orders as $order) {
            if ($order->status == 1) {
                # code...
                $total_revenue += $order->total_price;
            }
        }

        if ($store) {
            $averageRating = $store->averageRating;
            // $comments = Store::with('ratings.user')->where('id', $store->id)->orderByDesc('created_at')->take(3)->get();
            $comments = $store->ratings;

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

        // dd $commentsData
        
        // dd $comments;

        // get last 3 elements is array if array has more than 3 elements
        if (count($commentsData) > 3) {
            $commentsData = array_slice($commentsData, -3);
        }
        // $commentsData = array_slice($commentsData, -3);
        // dd($commentsData);


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


        return view('owner.shop', compact('store', 'commentsData', 'averageRating', 'statusCounts', 'total_products', 'total_orders', 'total_revenue'));
    }
}

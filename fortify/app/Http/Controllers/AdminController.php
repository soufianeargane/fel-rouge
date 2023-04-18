<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Mail\AcceptStoreEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        // get ip adress of logged in user
        // $ip = request()->ip();
        // $ip = $request->ip();
        // dd($ip);
        

        // get all users except admin
        $users = User::where('role', '!=', 2)->get();

        $lastMonth = Carbon::now()->subMonth();
        // $userStats = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        // ->where('created_at', '>', $lastMonth)
        // ->groupBy('date')
        // ->orderBy('date')
        // ->get();

        $year = Carbon::now()->year;

        // Initialize an array to store the monthly user signups count
        $monthlySignups = [];
        $monthlyOrders = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Count the user signups for the given month
            $signups = User::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->count();

            $orders = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->count();

            // Add the signups count to the array
            $monthlySignups[] = $signups;
            $monthlyOrders[] = $orders;
        }


        $topStores = Store::withCount('orders')
            ->withSum('orders', 'total_price')
            ->orderBy('orders_sum_total_price', 'desc')
            ->limit(3)
            ->get();
            // $topStores = Store::with('orders')->get();
        // dd($topStores);

        // return view('admin.dashboard');
        return view('admin.dashboard', compact('users', 'monthlySignups', 'monthlyOrders', 'topStores'));
    }

    public function demandes()
    {
        // get all stores where status is 0
        $pending_stores = Store::where('status', 0)->get();

        // return view('admin.dashboard');
        return view('admin.demandes', compact('pending_stores'));
    }
    public function action($id, $act)
    {
        // accept the store
        if ($act == 1) {
            # code...
            $store = Store::find($id);
            if($store){
                $store->status = 1;
                $store->save();

                // update the user role to 1
                $user = User::find($store->user_id);
                $user->role = 1;
                $user->save();
                // send a mail to the owner of the store

                Mail::to($store->user->email)->send(new AcceptStoreEmail($store->user->name, $store->title));

                return redirect()->back()->with('success', 'the store has been accepted with success');
                // return $store->user->email;
            }else{
                abort(404);
            }

        } elseif($act == 2){

            $store = Store::find($id);
            if($store){
                $store->status = 2;
                $store->save();
                return redirect()->back()->with('success', 'the store has been declined with success');
            }else{
                abort(404);
            }
        }
    }

}

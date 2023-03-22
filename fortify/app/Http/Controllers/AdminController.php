<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Mail\AcceptStoreEmail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //
    public function index()
    {
        // get all users except admin
        $users = User::where('role', '!=', 2)->get();
        // return view('admin.dashboard');
        return view('admin.dashboard', compact('users'));
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

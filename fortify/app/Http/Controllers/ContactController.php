<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name'       => 'required',
            'email'      => 'required|email',
            'phone' => [
                'required',
                'regex:/^(?:\+212|0)[1-9][\d]{8}$/'
            ],
            'subject'    => 'required',
            'message'    => 'required',
        ], [
            'phone.required' => 'Phone number is required',
            'phone.regex' => 'Invalid phone number format. It must be a moroccan phone number',
        ]);


        $contact            = new Contact();
        $contact->name      = $request->name;
        $contact->email     = $request->email;
        $contact->phone     = $request->phone;
        $contact->subject   = $request->subject;
        $contact->message   = $request->message;
        $contact->save();



        $user = User::where('role', 2)->first();

        // send email
        Mail::to($user->email)->send(new ContactMail($contact->name));

        return redirect()->back()->with('success', 'Message envoyé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();

        return view('panel.contacts.index', compact('contacts'));
    }

    public function today() {
        $date = date('d-m-y');
        $contacts = Contact::where('date', $date)->get();

        return view('panel.contact.today', compact('contacts'));
    }

    public function store(Request $request) {
        $contact = new Contact;
        $contact->name = $request->input('name');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->save();

        $notification = [
            'message'   =>   'Message sent successfully',
            'alert-type'    =>   'success'
        ];

        return redirect()->back()->with($notification);
    }
}

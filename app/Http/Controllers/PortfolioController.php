<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;
use App\Models\Contact;
use App\Models\ContactForm;

class PortfolioController extends Controller
{
    public function Portfolio()
    {
        $images = Multipic::all();
        return view('pages.portfolio', compact('images'));
    }

    public function Contact()
    {
        $contact = Contact::first();
        return view('pages.contact', compact('contact'));
    }

    public function ContactForm(Request $request)
    {
        $contact = new ContactForm;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return Redirect()->route('contact')->with('success', 'Message sent successfully!');    
    }
}

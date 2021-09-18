<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllContact()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|unique:contacts|max:100',
            'email' => 'required|unique:contacts|max:100',
            'number' => 'required|unique:contacts|max:20',
        ]);

        $contact = new Contact;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->number = $request->number;
        $contact->save();

        return Redirect()->back()->with('success', 'Contact Add Successfully!');
    }

    public function Edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'address' => 'required|max:100',
            'email' => 'required|max:100',
            'number' => 'required|max:20',
        ]);

        $contact = Contact::find($id);
        if ($contact) {
            $contact->address = $request->address;
            $contact->email = $request->email;
            $contact->number = $request->number;
            $contact->update();

            return Redirect()->route('all.contact')->with('success', 'Contact Update Successfully!');
        }
    }

    public function Delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return Redirect()->back()->with('success', 'Contact Delete Successfully!');
    }

    public function AdminMessage()
    {
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function DeleteMessage($id)
    {
        $message = ContactForm::find($id);
        $message->delete();
        return Redirect()->back()->with('success', 'Message Delete Successfully!');
    }
}

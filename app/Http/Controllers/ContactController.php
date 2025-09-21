<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    function index()
    {

        $contacts = Contact::all(); // Récupérer tous les contacts
        return view('contact.index', ['contacts' => $contacts]);

    }

    function create()
    {
        return view('contact.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'objet' => ['required', 'max:255'],
            'contenu' => ['required'],
            'email' => ['required', 'email:rfc']
        ]);
        $contact = Contact::create(request(['objet', 'contenu', 'email']));

        Mail::to('admin@lvm.net')->queue(
            new \App\Mail\ContactMail($contact)
        );


        return redirect('/contact/create')->with("message", "Votre message a été envoyé avec succès !");
    }


}
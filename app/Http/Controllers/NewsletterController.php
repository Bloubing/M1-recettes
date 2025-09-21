<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Newsletter;
class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:rfc,dns']
        ]);
        Newsletter::firstOrCreate(['email' => request('email')]);
        return view(view: 'vitrine');
    }

    public function update(Request $request)
    {
        if (request('abonnement') == "abonnement") {
            Newsletter::firstOrCreate(['email' => request('email')]);
        } else {
            Newsletter::where('email', request()->user()->email)->delete();
        }
        return view(view: 'vitrine');
    }

}
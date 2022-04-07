<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Models\Contactrequest;

class ContactFormController extends Controller
{
    public function index()
    {
        return view('contact.contact');
    }

    public function store(ContactFormRequest $request)
    {
        Contactrequest::create($request->all());

        return back()->with('success','Verzoek succesvol ingediend');
    }
}

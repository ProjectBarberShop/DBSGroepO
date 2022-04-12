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

    public function getContactRequests() {
        $contactRequestdata = Contactrequest::paginate(10);

        return view('cms/contactverzoeken.index', compact('contactRequestdata'));
    }

    public function destroy($id)
    {
        Contactrequest::find($id)->delete();
        return redirect('cms/contactverzoeken');
    }
}

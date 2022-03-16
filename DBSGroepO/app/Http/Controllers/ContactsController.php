<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Contracts\View\View;

class ContactsController extends Controller
{
    public function index()
    {
        $contactsdata = Contact::all();
        return view('cms.contactpersonen.index', compact('contactsdata'));
    }

    public function store(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
        ]);
        
        $contactsdata = new Contact;
        $contactsdata->firstname = $request->input('firstname');
        $contactsdata->preposition = $request->input('preposition');
        $contactsdata->lastname = $request->input('lastname');
        $contactsdata->email = $request->input('email');
        $contactsdata->phonenumber = $request->input('phonenumber');
        $contactsdata->is_published = isset($request['ispublished']) ? true : false;
        $contactsdata->save();

        return redirect(route('contactpersonen.index'));
    }

    public function edit($id)
    {        
        $contactdata = Contact::find($id);
        return view('cms.contactpersonen.edit', compact('contactdata'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
        ]);

        $webpage = Contact::find($id);
        $webpage->firstname = $request->input('firstname');
        $webpage->preposition = $request->input('preposition');
        $webpage->lastname = $request->input('lastname');
        $webpage->email = $request->input('email');
        $webpage->phonenumber = $request->input('phonenumber');
        $webpage->is_published = isset($request['ispublished']) ? true : false;
        $webpage->save();

        return redirect()->route('contactpersonen.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function destroy(int $id) {
        Contact::find($id)->delete();
        return redirect(route('contactpersonen.index'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * Create a new controller instance.
     *
     * @return void
     */

     /**
     * Show the form to create a new blog post.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact.contact');
    }

    public function store(ContactFormRequest $request)
    {
        $firstname = $request->input('firstname');
        $preprosition = $request->input('preprosition');
        $lastname = $request->input('surname');
        $email = $request->input('email');
        $phonenumber = $request->input('phonenumber');
        $title = $request->input('title');
        $message = $request->input('message');
        $currentdatetime = Carbon::now();
        $currentdatetime->toDateTimeString();

        $data=array(
                'firstname' => $firstname,
                'preprosition' => $preprosition,
                'lastname' => $lastname,
                'email' => $email,
                'message' => $message,
                'phonenumber' => $phonenumber,
                'title' => $title,
                'created_at' => $currentdatetime,
                'updated_at' => $currentdatetime
            );

        \DB::table('contact-requests')->insert($data);

        return back()->with('success','Verzoek succesvol ingediend');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletterdata = Newsletter::all();
        return view('cms.nieuwsbrieven.index', compact('newsletterdata'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagepath' => 'mimes:jpeg,bmp,png',
            'title' => 'required',
            'message' => 'required',
        ]);

        $newsletterdata = new Newsletter;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $file = $image->getClientOriginalExtension();
            $filepath = $image->move('/images', $file);
            $newsletterdata->imagepath = $filepath;
        };
        $newsletterdata->title = $request->input('title');
        $newsletterdata->message = $request->input('message');
        $newsletterdata->is_published = isset($request['ispublished']) ? true : false;
        $newsletterdata->save();

        return redirect(route('nieuwsbrieven.index'));
    }

    public function getNews() {
        $newsletterdata = Newsletter::where('is_published', true)->orderBy('created_at', 'desc')->get();
        return view('nieuws.index', compact('newsletterdata'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $newsletterdata = Newsletter::find($id);
        return view('cms.nieuwsbrieven.edit', compact('newsletterdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'imagepath' => 'mimes:jpeg,bmp,png',
            'title' => 'required',
            'message' => 'required',
        ]);

        $newsletter = Newsletter::find($id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $file = $image->getClientOriginalExtension();
            $filepath = $image->move('/images', $file);
            $newsletter->imagepath = $filepath;
        };
        $newsletter->title = $request->input('title');
        $newsletter->message = $request->input('message');
        $newsletter->is_published = isset($request['ispublished']) ? true : false;
        $newsletter->save();

        return redirect()->route('nieuwsbrieven.index')->with('success','Pagina succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Newsletter::find($id)->delete();
        return redirect(route('nieuwsbrieven.index'));
    }
}

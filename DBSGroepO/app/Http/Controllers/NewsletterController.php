<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Image;
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
        $imagesdata = Image::all();
        $newsletterdata = Newsletter::with('image')->orderBy('created_at', 'desc')->get();

        return view('cms.nieuwsbrieven.index', compact(['newsletterdata', 'imagesdata']));
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
            'imageId' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);

        $newsletterdata = new Newsletter;
        $newsletterdata->image_id = $request->input('imageId');
        $newsletterdata->title = $request->input('title');
        $newsletterdata->message = $request->input('message');
        $newsletterdata->is_published = isset($request['ispublished']) ? true : false;
        $newsletterdata->save();

        return redirect(route('nieuwsbrieven.index'));
    }

    public function getNews() {
        $newsletterdata = Newsletter::join('image', 'image.id', '=', 'newsletter.image_id')
        ->join('newsletter as n', 'n.id', '=', 'newsletter.id')
        ->where('n.is_published', true)->orderBy('n.created_at', 'desc')->get();

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
        $imagesdata = Image::all();
        $newsletterdata = Newsletter::with('image')->find($id);

        return view('cms.nieuwsbrieven.edit', compact(['newsletterdata', 'imagesdata']));
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
            'imageId' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);

        $newsletter = Newsletter::find($id);
        $newsletter->image_id = $request->input('imageId');
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

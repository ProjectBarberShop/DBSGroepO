<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webpages;
use Illuminate\Support\Str;

class WebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Webpages::all();

        return view('cms.webpages.index' ,['webpages' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.webpages.create');
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
           'template_id' => 'required',
           'main_text' => 'required',
           'slug' => 'required',
       ]);

       foreach ($request->multiInput as $key => $value) {
           $value->
            Webpages::create($value);
        }
       $webpage = new Webpages;
       $webpage = Str::slug($request->input('title'));
       $webpage = $request->input('template_id');
       $webpage = $request->input('title_card');
       $webpage = $request->input('card_images');
       $webpage = $request->input('colom_title_text');
       $webpage = $request->input('main_text');
       $webpage = $request->input('colomn_text');

       Webpages::create($webpage);

       return redirect()->route('paginas.index')->with('success','Pagina succesvol toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pagecontent = Webpages::all()->where('slug', $slug);
        return view('contentpage' , compact('pagecontent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Webpages::find($id);
        return view('cms.webpages.edit' , compact('page'));
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
            'body' => 'required',
            'title' => 'required'
        ]);
        $webpage = Webpages::find($id);
        $webpage->body = $request->input('body');
        $webpage->slug = Str::slug($request->input('title'));
        $webpage->save();
        return redirect()->route('paginas.index')->with('success','Pagina succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

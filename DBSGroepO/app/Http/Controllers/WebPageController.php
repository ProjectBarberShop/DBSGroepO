<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webpages;
use App\Models\colom_context as context_colomn;
use App\Models\colom_context_webpages;
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
           'main_text' => 'required',
           'slug' => 'required',
           'multiInput.*.colom_title_text' => 'required',
           'multiInput.*.colomn_text' => 'required',
       ]);
       $webpage = new Webpages;
       $webpage->template_id = 1;
       $webpage->slug = Str::slug($request->input('slug'));
       $webpage->main_text = $request->input('main_text');
       $webpage->save();
       $webpageID = Webpages::latest('id')->first();
       if($request->multiInput != null) {
        foreach($request->multiInput as $key => $value) {
            context_colomn::create($value);
            $contextID = context_colomn::latest('id')->first();
            $webpagecontexttable = new colom_context_webpages;
            $webpagecontexttable->webpages_id = $webpageID->id;
            $webpagecontexttable->colom_context_id = $contextID->id;
            $webpagecontexttable->save();
        }
    }

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
        $pagecontent = Webpages::with('ColomContext' , 'youtube')->where('slug' , $slug)->get();
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
        Webpages::find($id)->delete();

        return redirect()->route('paginas.index');
    }
}

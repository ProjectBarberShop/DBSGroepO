<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use App\Models\Webpages;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webpageTitles = Youtube::with('Webpage')->get();
        return view('cms.youtube.index' ,['webpageTitles' => $webpageTitles]);
    }


    public function create()
    {
        $webpage = Webpages::all();
        return view('cms.youtube.create' , ['webpage' => $webpage]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'youtube_video_key' => 'required',
            'webpageID' => 'required',
        ]);
        $youtube = new Youtube;
        $youtube->youtube_video_key = $request->input('youtube_video_key');
        $youtube->save();
        $youtube->Webpage()->attach($request->input('webpageID'));
        return redirect()->route('youtube.index')->with('success','Youtube video succesvol toegevoegd');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMultiple(Webpages $pagina)
    {
        return view('cms.youtube.createMultiple' , ['pageID' => $pagina->id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request , $pageID)
    {
        $request->validate([
            'multiInput.*.youtube_video_key' => 'required',
        ]);
        foreach($request->multiInput as $key => $value) {
            $youtube = Youtube::create($value);
            $youtube->Webpage()->attach($pageID);
        }
        return redirect()->route('youtube.index')->with('success','Youtube video succesvol toegevoegd');
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
        $youtube = Youtube::find($id);
        $webpage = Webpages::all();

        return view('cms.youtube.edit' , ['youtube' => $youtube , 'webpage' => $webpage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $webpage)
    {
        $request->validate([
            'youtube_video_key' => 'required',
            'webpageID' => 'required',
        ]);
        $youtube = Youtube::find($id);
        $youtube->youtube_video_key = $request->input('youtube_video_key');
        $youtube->save();
        $youtube->Webpage()->wherePivot('webpages_id' , $webpage)->wherePivot('youtube_id' , $id)->updateExistingPivot($webpage, ['webpages_id' => $request->input('webpageID')]);

        return redirect()->route('youtube.index')->with('success','Youtube video succesvol bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Youtube::find($id)->delete();
        return redirect(route('youtube.index'));
    }
}

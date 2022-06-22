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

    public function edit($id)
    {
        $youtube = Youtube::with('Webpage')->find($id);
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

    public function editYoutube($webpage) {
        $pagecontent = Webpages::with('youtube')->where('id' , $webpage)->get();
        return view('cms.webpages.edit_youtube' , compact('pagecontent'));
    }

    public function updateAndInsert(Request $request , $webpage) {
        $request->validate([
            'multiInput.*.youtube_video_key' => 'required',
            'oldInput.*.youtube_video_key' => 'required',
        ]);

        if($request->multiInput != null) {
            foreach($request->multiInput as $key => $value) {
                $youtube = Youtube::create($value);
                $youtube->Webpage()->attach($webpage);
                $youtube->save();
            }
        }
        if($request->oldInput != null) {
            foreach($request->oldInput as $key => $value) {
                    $youtube = Youtube::find($key);
                    $youtube->youtube_video_key = $value['youtube_video_key'];
                    $youtube->save();
            }
        }
        return redirect()->route('imageWebpage.editImage' , $webpage);
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

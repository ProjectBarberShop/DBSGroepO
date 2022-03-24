<?php

namespace App\Http\Controllers;

use App\Models\Webpages;
use App\Models\Youtube;
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
        $videos = Youtube::all();
        return view('cms.youtube.index' ,['videos' => $videos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $webpage = Webpages::all();
        return view('cms.youtube.create' , ['webpage' => $webpage]);
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
            'multiInputYoutube.*.YoutubeKey' => 'required',
            'multiInput.*.Webpage' => 'required',
        ]);
        foreach($request->multiInputYoutube as $key => $value) {
            $youtube = new Youtube;
            $youtube->youtube_video_key = $value;
            $youtube->save();
            
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
        //
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
        //
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

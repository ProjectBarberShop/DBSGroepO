<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use App\Models\Webpages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YoutubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webpageTitles = DB::table('youtube_webpage')
        ->join('youtube', 'youtube.id', '=', 'youtube_webpage.youtube_id')
        ->join('webpage', 'webpage.id', '=', 'youtube_webpage.webpages_id')
        ->select('webpage.slug' , 'youtube.youtube_video_key' , 'webpage.id')
        ->get();
        return view('cms.youtube.index' ,['webpageTitles' => $webpageTitles]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $webpage = Webpages::all();
        if($webpage->count() > 0) {
            return view('cms.youtube.create' , ['webpage' => $webpage]);
        } else {
            return redirect()->route('youtube.index');
        }
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
            'multiInput.*.youtube_video_key' => 'required',
            'multiWebpage.*.Webpage' => 'required',
        ]);
        foreach($request->multiInput as $key => $value) {
            $youtube = Youtube::create($value);

            foreach($request->multiWebpage as $v => $vv) {
                $youtube->WebPageYoutubeLink()->attach($vv);
            }

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

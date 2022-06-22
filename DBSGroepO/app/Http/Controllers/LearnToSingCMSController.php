<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\LearnToSing;
use Illuminate\Http\Request;
use App\Models\LearnToSingCat;

class LearnToSingCMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses = LearnToSing::with('image')->paginate(5);

        return view('cms.learntosing.index', [ 'courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cms.learntosing.create', ['categories' => LearnToSingCat::all(), 'imagesdata' => Image::paginate(5)]);
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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'max:255',
            'image_id' => 'required'
        ]);

        $attributes = $request->all();

        if(!isset($attributes['price'])) $attributes['price'] = 0;
        LearnToSing::create($attributes);

        return redirect('cms/learntosing-beheer')->with('success', 'Cursus succesvol aangemaakt');
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
        return view('cms.learntosing.edit', ['course' => LearnToSing::findOrFail($id), 'imagesdata' => Image::paginate(5), 'categories' => LearnToSingCat::all()]);
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
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'max:255',
            'image_id' => 'required'
        ]);

        $attributes = $request->all();

        if(!isset($attributes['price'])) $attributes['price'] = 0;
        LearnToSing::find($id)->update($attributes);

        return redirect('cms/learntosing-beheer')->with('success', 'Cursus succesvol Bijgewerkt');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LearnToSing::destroy($id);

        return back()->with('success', 'Cursus is verwijderd');
    }
}

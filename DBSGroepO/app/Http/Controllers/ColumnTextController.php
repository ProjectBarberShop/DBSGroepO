<?php

namespace App\Http\Controllers;

use App\Models\Webpages;
use Illuminate\Http\Request;
use App\Models\colom_context;

class ColumnTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function edit($webpage)
    {
        $pagecontent = Webpages::with('ColomContext')->where('id' , $webpage)->get();
        return view('cms.webpages.edit_colomn_text' , compact('pagecontent'));
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
    public function destroy($id , $webpage)
    {
        colom_context::find($id)->delete();
        $pagecontent = Webpages::with('ColomContext')->where('id' , $webpage)->get();
        return view('cms.webpages.edit_colomn_Text' , compact('pagecontent'));
    }
}

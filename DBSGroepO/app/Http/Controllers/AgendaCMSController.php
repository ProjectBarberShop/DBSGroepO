<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class AgendaCMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->input("category") != "") {
            $cats[] = $request->input("category");
            $agendapunten = Agendapunt::whereHas('Category', function($q) use($cats) {
                $q->whereIn('category_id', $cats);
            })->paginate(5);
        }
        else {
            $agendapunten = Agendapunt::with('Category')->paginate(5);
        }
        $categories = Category::get();
        return view('cms.agenda.index', compact('agendapunten', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('cms.agenda.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agendapunt = Agendapunt::create($request->all());
        $agendapunt->Category()->attach($request->category);
        return redirect('/cms/agenda');
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
        Agendapunt::destroy($id);
        return redirect('/cms/agenda');
    }
}

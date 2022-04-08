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
            // $agendapunten = DB::table('agenda')
            //  ->join('agendapunt_category', 'agenda.id', '=', 'agendapunt_category.agendapunt_id')
            //  ->join('category', 'category.id', '=', 'agendapunt_category.category_id')
            //  ->where('agendapunt_category.category_id', '=', $request->input("category"))
            //  ->select('agenda.*', 'category.title as category_title')
            //  ->get();
            $agendapunten = Agendapunt::with(["Category"=>function($query) use($request) {
                $query->where('id', '=', $request->input("category"));
            }])->get();
        }
        else {
            $agendapunten = Agendapunt::with('Category')->get();
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
        return view('cms.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Agendapunt::create($request->all());
        return view('cms.agenda.index');
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
        //
    }
}

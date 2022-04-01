<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->category != '0') {
                $data = DB::table('agenda')
                ->join('agenda_category', 'agenda.id', '=', 'agenda_category.agendapunt_id')
                ->join('category', 'category.id', '=', 'agenda_category.category_id')
                ->where('agenda_category.category_name', '=', $request->category)
                ->select('agenda.*')
                ->get();
            }
            else {
                $data = Agendapunt::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)->first()->get();
            }

            return response()->json($data);
        }
        $categories = Category::all();
        return View('agenda.index', compact('categories'));
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

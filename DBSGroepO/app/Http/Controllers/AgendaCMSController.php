<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Category;
use Carbon\Carbon;
use Database\Seeders\AgendaSeeder;
use Illuminate\Contracts\View\View;
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
            })->where('isArchived', false)->paginate(5);
        }
        else {
            $agendapunten = Agendapunt::with('Category')->where('isArchived', false)->paginate(5);
        }
        $categories = Category::with("Agenda")->get();
        return view('cms.agenda.index', compact('agendapunten', 'categories'));
    }

    public function ArchiveAll() {
        Agendapunt::where('end', '<', Carbon::now())->update(['isArchived' => true]);
        return redirect()->back();
    }

    public function ArchiveSingle($id) {
        Agendapunt::where('id', $id)->update(['isArchived' => true]);
        return redirect()->back();
    }

    public function getArchived() {
        $agendapunten = Agendapunt::where('isArchived', True)->paginate(5);
        return view('cms.agenda.archive', compact('agendapunten'));
    }

    public function deleteArchived($id) {
        Agendapunt::destroy($id);
        return redirect()->back();
    }

    public function deleteAllArchived() {
        Agendapunt::where('isArchived', true)->delete();
        return redirect()->back();
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
        $request->validate([
            'end' => [
                'after_or_equal:start'
            ]
        ]);

        $agendapunt = Agendapunt::create($request->all());
        $temp = Category::find($request->category);
        $agendapunt->color = $temp->color;
        $agendapunt->Category()->attach($request->category);
        $agendapunt->save();
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
        $agendapunt = Agendapunt::find($id);

        $agendapunt->start = strtotime($agendapunt->start);
        $agendapunt->start = date('Y-m-d\TH:i', $agendapunt->start);
        $agendapunt->end = strtotime($agendapunt->end);
        $agendapunt->end = date('Y-m-d\TH:i', $agendapunt->end);
        
        $categories = Category::all();

        return view('cms.agenda.edit', compact('agendapunt', 'categories'));
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
            'end' => [
                'after_or_equal:start'
            ]
        ]);

        $agenda = Agendapunt::find($id);
        $agenda->update($request->all());
        $agenda->Category()->detach();
        $agenda->Category()->attach($request->category);
        $temp = Category::find($request->category);
        $agenda->color = $temp->color;
        $agenda->save();
        return redirect('/cms/agenda');
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

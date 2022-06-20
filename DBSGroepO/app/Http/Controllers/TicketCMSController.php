<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TicketCMSController extends Controller
{
    public function index()
    {
        $agendadata = Agendapunt::where('start', '>', Carbon::now())->orderBy('start', 'asc')->paginate(5);

        return view('cms.boeking.index', compact('agendadata'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'amount' => 'required|not_in:0',
            'agenda' => 'not_in:0'
        ]);

        $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find(($request->agenda));
        $agendapunt->amount_of_tickets = intval($request->input('amount'));
        $agendapunt->is_published = isset($request['ispublished']) ? true : false;
        $agendapunt->save();

        return redirect()->route('cms.boeking.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function destroy($id)
    {
        $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find($id);
        $agendapunt->amount_of_tickets = 0;
        $agendapunt->is_published = false;
        $agendapunt->save();

        return redirect()->route('cms.boeking.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function edit($id)
    {
        $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find($id);

        return view('cms.boeking.edit', compact('agendapunt'));
    }
}

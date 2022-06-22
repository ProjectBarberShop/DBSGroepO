<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TicketCMSController extends Controller
{
    public function index()
    {
        // $ticketAmount = Ticket::with('agendaItem')->where('agenda_id', 6)->count();
        $agendadata = Agendapunt::where('start', '>', Carbon::now())->orderBy('start', 'asc')->paginate(5);
        // $ticketdata = Ticket::with('agenda');
        $ticketdata = Ticket::with('agendaItem')->get();

        return view('cms.tickets.index', compact('ticketdata', 'agendadata'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'amount' => 'required|not_in:0',
            'price' => 'required',
            'agenda' => 'not_in:0',
        ]);

        // $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find(($request->agenda));

        $ticket = new Ticket;
        $ticket->agenda_id = intval($request->input('agenda'));
        $ticket->amount_of_tickets = intval($request->input('amount'));
        $ticket->price = intval($request->input('price'));
        $ticket->is_published = isset($request['ispublished']) ? true : false;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function destroy($id)
    {
        $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find($id);
        $agendapunt->amount_of_tickets = 0;
        $agendapunt->is_published = false;
        $agendapunt->save();

        return redirect()->route('tickets.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function edit($id)
    {
        $agendapunt = Agendapunt::where('start', '>', Carbon::now())->find($id);

        return view('cms.tickets.edit', compact('agendapunt'));
    }
}

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
        $agendadata = Agendapunt::where('start', '>', Carbon::now())->orderBy('start', 'asc')->paginate(5);
        $agenda = Agendapunt::where('start', '>' , Carbon::now())->orderBy('start', 'asc')->get();
        $ticketdata = Ticket::all();

        return view('cms.tickets.index', compact('ticketdata', 'agendadata' , 'agenda'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|not_in:0',
            'price' => 'required',
            'agenda' => 'not_in:0',
        ]);
        $ticket = new Ticket;
        $ticket->agenda_id = $request->input('agenda');
        $ticket->amount_of_tickets = $request->input('amount');
        $ticket->price = $request->input('price');
        $ticket->is_published = isset($request['ispublished']) ? true : false;
        $ticket->save();

        return redirect()->route('tickets.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function destroy($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function edit($id)
    {
        $tickets = Ticket::find($id);
        $agendapunt = Agendapunt::find($tickets->agenda_id);

        return view('cms.tickets.edit', compact('agendapunt' , 'tickets'));
    }


    public function update(Request $request , $id) {
        $request->validate([
            'amount' => 'required|not_in:0',
            'price' => 'required',
            'agenda' => 'not_in:0',
        ]);
        $ticket = Ticket::find($id);
        $ticket->amount_of_tickets = $request->input('amount');
        $ticket->price = $request->input('price');
        $ticket->is_published = isset($request['ispublished']) ? true : false;
        $ticket->update();

        return redirect()->route('tickets.index')->with('success','Pagina succesvol bijgewerkt');
    }
}

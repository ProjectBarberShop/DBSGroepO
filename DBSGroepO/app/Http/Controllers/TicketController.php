<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PDF;

class TicketController extends Controller
{
    public function index()
    {
        $agendadata = Agendapunt::where('is_published', true)
        ->where('start', '>', Carbon::now())
        ->orderBy('start', 'asc')
        ->where('amount_of_tickets', '>', 0)
        ->paginate(5);

        return view('boeking.index', compact('agendadata'));
    }

    public function send(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'postalcode' => 'required',
            'place' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'amount' => 'required|gt:0'
        ]);

        $ticket = Ticket::find($id);
        if($ticket != null && $ticket->email == $request->input('email')) {
            return redirect()->route('boeking.index')->with('success','Pagina succesvol bijgewerkt');
        }

        $data["name"] = $request->input('name');
        $data["address"] = $request->input('address');
        $data["postalcode"] = $request->input('postalcode');
        $data["place"] = $request->input('place');
        $data["phonenumber"] = $request->input('phonenumber');
        $data["email"] = $request->input('email');
        $data["amount"] = $request->input('amount');
        $data["email_from"] = "Tickets van info@duketownbarbershopsingers.nl";

        $event = Agendapunt::find($id);
        $data["title"] = $event->title;
        $data["start"] = $event->start;
        $data["end"] = $event->end;
        $data["description"] = $event->description;
        $data["price"] = $event->price;
        $data["total_price"] = $event->price * $request->input('amount');

        $ticket = new Ticket;
        $ticket->agenda_id = $event->id;
        $ticket->email = $data["email"];
        $ticket->total_price = $data["total_price"];
        $ticket->save();

        view('pdfTicket', compact('data'));

        $pdf = PDF::loadView('pdfTicket', $data);

        Mail::send('emailTicket', $data, function($message)use($data,$pdf) {
            $message->from('info@duketownbarbershopsingers.nl', env('APP_NAME'))
            ->to($data["email"])
            ->subject($data["email_from"])
            ->attachData($pdf->output(), "barbershop_ticket.pdf");
        });

        return redirect()->route('boeking.index')->with('success','Pagina succesvol bijgewerkt');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Ticket;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PDF;

class TicketController extends Controller
{
    public function index()
    {
        $agendadata = Agendapunt::where('start', '>', Carbon::now())
        ->orderBy('start', 'asc')->get();
        $ticketdata = Ticket::where('is_published', true)->where('amount_of_tickets', '>', 0)->paginate(5);

        return view('boeking.index', compact('agendadata' , 'ticketdata'));
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
        $ticket->amount_of_tickets = $ticket->amount_of_tickets - $request->input('amount');
        $ticket->save();

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
        $data["price"] = $ticket->price;
        $data["total_price"] = $ticket->price * $request->input('amount');

        $userTicket = new UserTicket();
        $userTicket->ticket_id = $ticket->id;
        $userTicket->name = $request->input('name');
        $userTicket->address = $request->input('address');
        $userTicket->postalcode = $request->input('postalcode');
        $userTicket->place = $request->input('place');
        $userTicket->phonenumber = $request->input('phonenumber');
        $userTicket->email = $request->input('email');
        $userTicket->amount_of_tickets = $request->input('amount');
        $userTicket->save();

        view('pdfTicket', compact('data'));

        $pdf = PDF::loadView('pdfTicket', $data);

        Mail::send('emailTicket', $data, function($message)use($data,$pdf) {
            $message->from('info@duketownbarbershopsingers.nl', env('APP_NAME'))
            ->to($data["email"])
            ->subject($data["email_from"])
            ->attachData($pdf->output(), "barbershop_ticket.pdf");
        });

        return redirect()->route('boeking.index')->with('success','Tickets succesvol besteld');
    }
}

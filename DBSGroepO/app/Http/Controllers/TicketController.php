<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use PDF;

class TicketController extends Controller
{
    public function index()
    {
        $agendadata = Agendapunt::where('is_published', true)->where('start', '>', Carbon::now())->orderBy('start', 'asc')->paginate(5);

        return view('boeking.index', compact('agendadata'));
    }

    public function send(Request $request) {
        $data["email"] = 'mch.vermeer@student.avans.nl';
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('pdf.test', $data);

        Mail::send('mails.mail', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
        });


        dd('Mail send successfully');

        // return redirect()->route('boeking.index')->with('success','Pagina succesvol bijgewerkt');
    }
}

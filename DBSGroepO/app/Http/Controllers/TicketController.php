<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use Mail;

class TicketController extends Controller
{
    // public function index()
    // {
    //     $agendadata = Agendapunt::where('is_published', true)->where('start', '>', Carbon::now())->orderBy('start', 'asc')->paginate(5);

    //     return view('boeking.index', compact('agendadata'));
    // }

    public function sent() {
        $data["email"] = 'mch.vermeer@student.avans.nl';
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('mail', $data);

        Mail::send('mail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });

        dd('Mail sent successfully');

        // return redirect()->route('boeking.index')->with('success','Pagina succesvol bijgewerkt');
    }
}

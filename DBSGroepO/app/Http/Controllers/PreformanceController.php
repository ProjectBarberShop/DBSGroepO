<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendapunt;

class PreformanceController extends Controller
{
    public function index(Request $request)
    {
        
        $preformances = Agendapunt::all(); 
        return view('preformance.preformance', ['optredens'=>$preformances]);
    }
}

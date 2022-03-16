<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PreformanceController extends Controller
{
    public function index(Request $request)
    {
        
        $preformances = DB::table('agenda')->get();
        return view('preformance.preformance', ['optredens'=>$preformances]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PreformanceController extends Controller
{
    public function index(Request $request)
    {
        
        $preformances = DB::select('select * from agenda');
        return view('preformance.preformance', ['optredens'=>$preformances]);
    }
}

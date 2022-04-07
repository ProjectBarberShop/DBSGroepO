<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendapunt;

class PerformanceController extends Controller
{
    public function index()
    {
        $preformances = Agendapunt::join('agendapunt_category', 'agenda.id', '=', 'agendapunt_category.agendapunt_id')
        ->join('category', 'category.id', '=', 'agendapunt_category.category_id')
        ->where('agendapunt_category.category_id', '=', 1);
        return view('performance.performance', ['optredens'=>$preformances->get()]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliderImages = Image::where('useInSlider', '=', true)->get();
        return view('Home.Home', ['slider' => $sliderImages]);
    }
}

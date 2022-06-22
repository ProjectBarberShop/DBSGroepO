<?php

namespace App\Http\Controllers;

use App\Models\LearnToSing;
use App\Models\LearnToSingCat;
use Illuminate\Http\Request;

class LearntosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->coursesearch)) {
            $courses = LearnToSing::with('image')->whereRaw('LOWER(title) LIKE ? ',[trim(strtolower($request->coursesearch)).'%']);
        }
        else {
            $courses = LearnToSing::with('image');
        }
        if(isset($request->category)) {
            $courses = $courses->where('category_id', $request->category);
        }
        $courses = $courses->paginate(6);
        $coursecategories = LearnToSingCat::all();
        return view('learntosing.index', compact('courses', 'coursecategories'));
    }

}

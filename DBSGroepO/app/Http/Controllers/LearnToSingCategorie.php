<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LearnToSingCat;

class LearnToSingCategorie extends Controller
{

    public function index()
    {
        $data = LearnToSingCat::all();
        return view('cms.learntosingcat.index' ,['categories' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required'
            ]
        ]);
        LearnToSingCat::create($request->all());
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => [
                'required'
            ]
        ]);
        $cat = LearnToSingCat::find($id);
        $cat->update($request->all());
        return redirect()->route('categorie.index')->with('success', 'Learn to sing categorie sucesvol bijgewerkt');
    }

    public function destroy($id)
    {
       LearnToSingCat::destroy($id);
       return redirect()->route('categorie.index');
    }
}

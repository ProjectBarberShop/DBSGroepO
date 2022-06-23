<?php

namespace App\Http\Controllers;

use App\Models\Agendapunt;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'color' => ['required']
        ]);
        Category::create($request->all());
        return redirect()->back();
    }
    public function updatetext(Request $request) {
        // Category::all()->where('id', $request->id)->first()->update(['title' => $request->text]);
        $cat = Category::find($request->cat_id);
        $catreg = strip_tags($request->text);
        $cat->title = $catreg;
        $cat->save();
    }
    public function updatecolor(Request $request) {
        $cat = Category::find($request->cat_id);
        $agendapunten = Agendapunt::whereHas('Category', function($query) use ($request) {
            $query->where('category_id', $request->cat_id);
        })->get();
        foreach($agendapunten as $agendapunt) {
            $agendapunt->color = $request->color;
            $agendapunt->save();
        }

        $cat->color = $request->color;
        $cat->save();
    }
    public function destroy($id)
    {
        Category::destroy($id);
        return back();
    }
}

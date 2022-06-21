<?php

namespace App\Http\Controllers;

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
        $cat->title = $request->text;
        $cat->save();
    }
    public function updatecolor(Request $request) {
        $cat = Category::find($request->cat_id);
        $cat->color = $request->color;
        $cat->save();
    }
    public function destroy($id)
    {
        Category::destroy($id);
        return back();
    }
}

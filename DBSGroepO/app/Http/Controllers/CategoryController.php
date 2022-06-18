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
    public function destroy($id)
    {
        Category::destroy($id);
        return back();
    }
}

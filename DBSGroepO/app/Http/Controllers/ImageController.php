<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class imageController extends Controller
{

    public function index(Request $request)
    {
        $images = Image::query();
        
        if($request->filled('search')){
            $images->where('title', 'like', '%' . $request->search . '%')->get();
        }   
        return view('cms.image.index', ['images'=>$images->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required',
        ]);
        
        $imagedata = new Image;
        $imagedata->title = $request->input('title');
        $img = $request->file('photo');
        $contentsImg = $img->openFile()->fread($img->getSize());
        $imagedata->photo = $contentsImg;
        $imagedata->useInSlider = false;
        $imagedata->save();

        return redirect(route('fotos.index'));
    }

    public function update(Request $request, $id)
    {
        $img = Image::find($id);
        if($img->useInSlider){
            $img->useInSlider = false;
        }else{
            $img->useInSlider = true;
        }
        $img->save();
        return redirect(route('fotos.index'));
    }

    public function destroy($id)
    {
        Image::find($id)->delete();
        return redirect(route('fotos.index'));
    }
}

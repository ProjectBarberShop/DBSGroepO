<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\webpages;

class imageController extends Controller
{

    public function index(Request $request)
    {
        $categories = Image::select('category')->distinct()->get();
        $images = Image::query();

        if($request->filled('search')){
            $images->where('title', 'like', '%' . $request->search . '%')->get();
        }
        if($request->filled('filter')){
            $images->where('category', '=', $request->filter)->get();
        }
        return view('cms.image.index', ['images'=>$images->get(), 'categories'=> $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required|max:294|image',
            'category' => 'required',
        ]);

        $imagedata = new Image;
        $imagedata->title = $request->input('title');
        $img = $request->file('photo');
        $contentsImg = $img->openFile()->fread($img->getSize());
        $imagedata->photo = $contentsImg;
        $imagedata->useInSlider = false;
        $imagedata->category = $request->input('category');
        $imagedata->save();
        if($request->filled('webpage')){$imagedata->webpages()->attach($request->webpage);}

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

    public function show($id)
    {
        $image = Image::find($id);
        return view('cms.image.Details', compact('image'));
    }

    public function destroy($id)
    {
        Image::find($id)->delete();
        return redirect(route('fotos.index'));
    }

    public function createMultiple(Webpages $pagina)
    {
        $images = Image::all();
        return view('cms.image.createMultiple' , ['pageID' => $pagina->id, 'afbeeldingen'=> $images]);
    }

    public function storeMultiple(Request $request , $pageID)
    {
        $request->validate([
            'multiInput.*.image_id' => 'required',
        ]);
        foreach($request->multiInput as $key => $value) {
            $page = Webpages::find($pageID);
            $page->Image()->attach($value);
        }
        return redirect(route('paginas.index'))->with('success','afbeelding succesvol toegevoegd');
    }

    public function editImage($webpage) {
        $pagecontent = Webpages::with('Image')->where('id' , $webpage)->get();
        $images = Image::all();
        return view('cms.webpages.edit_image' , ['pagecontent' => $pagecontent , 'afbeeldingen' => $images]);
    }

    public function updateImage(Request $request, $webpage)
    {
        $request->validate([
            'multiInput.*.image_id' => 'required',
            'oldInput.*.image_id' => 'required',
        ]);

        if($request->multiInput != null) {
            foreach($request->multiInput as $key => $value) {
                $image = Webpages::find($webpage);
                $image->Image()->attach($value);
                $image->save();
            }
        }
        if($request->oldInput != null) {
            foreach($request->oldInput as $key => $value) {
                    $image = Image::find($key);
                    // $image->Webpages()->attach($webpage);
                    $image->Webpages()->wherePivot('webpages_id' , $webpage)->wherePivot('image_id' , $image->id)->updateExistingPivot($image->id, ['image_id' => $key]);
                    $image->save();
            }
        }

        return redirect()->route('paginas.index')->with('success','Alles is succesvol bijgewerkt indien er dingen verwijdert moeten worden kan dat via de show');
    }
}

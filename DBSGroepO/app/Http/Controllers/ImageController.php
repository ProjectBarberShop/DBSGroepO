<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Tag;
use App\Models\Image;
use App\Models\webpages;
use Illuminate\Http\Request;

class imageController extends Controller
{

    public function index(Request $request)
    {
        $labels = Tag::all();
        $images = Image::query();

        if($request->filled('search')){
            $images->where('title', 'like', '%' . $request->search . '%')->paginate(20);
        }
        if($request->filled('filter')){
            $images->where('tagName', '=', $request->filter)->paginate(20);
        }
        return view('cms.image.index', ['images'=>$images->paginate(20), 'labels'=> $labels]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'photo' => 'required|max:294|image',
            'tag' => 'required',
        ]);

        try{
            $tag = new Tag;
            if(Tag::where('tag', $request->input('tag'))->count() === 0){
                $tag->tag = $request->input('tag');
                $tag->save();
            }
            $imagedata = new Image;
            $imagedata->title = $request->input('title');
            $img = $request->file('photo');
            $contentsImg = $img->openFile()->fread($img->getSize());
            $imagedata->photo = $contentsImg;
            $imagedata->useInSlider = false;
            $imagedata->tagName = $request->input('tag');
            $imagedata->save();
            if($request->filled('webpage')){$imagedata->webpages()->attach($request->webpage);}
        } catch (Throwable $e) {

        }
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
        if($request->multiInput != null){
        $request->validate([
            'multiInput.*.image_id' => 'required'
        ]);
            $page = Webpages::where('id' , $pageID)->with('Image')->first();
            foreach($request->multiInput as $key => $value) {
                foreach($page->Image as $image) {
                    if($image->id == $value['image_id']) {
                        return redirect(route('Afbeelding.createMultiple' , $pageID))->withErrors(['error' => 'De gekozen afbeeldingen zijn helaas al gekozen voor deze pagina. Kies een andere afbeelding of maak een nieuwe afbeelding aan bij foto\'s.']);
                    }
                }
                if(!$page->Image->contains($value['image_id'])){
                    $page->Image()->attach($value);
                }
            }


        return redirect(route('paginas.index'))->with('success','afbeelding succesvol toegevoegd');
        }else{
            $images = Image::all();
            return view('cms.image.createMultiple' , ['pageID' => $pageID, 'afbeeldingen'=> $images]);
        }
    }

    public function editImage($webpage) {
        $pagecontent = Webpages::with('Image')->where('id' , $webpage)->get();
        $images = Image::all();
        return view('cms.webpages.edit_image' , ['pagecontent' => $pagecontent , 'afbeeldingen' => $images]);
    }

    public function updateImage(Request $request, $webpageID)
    {
        $request->validate([
            'multiInput.*.image_id' => 'required',
            'oldInput.*.image_id' => 'required',
        ]);
        if($request->oldInput != null) {
            $webpage = Webpages::find($webpageID);
            foreach($request->oldInput as $key => $value) {
                $test = $webpage->Image()->wherePivot('webpages_id' , $webpageID)->wherePivot('image_id' , $value['image_id'])->updateExistingPivot($value['image_id'], ['image_id' => $value['image_id']]);
            }
        }
        if($request->multiInput != null) {
            $webpage = Webpages::find($webpageID);
            $page = Webpages::find($webpageID)->with('Image')->first();
            foreach($request->multiInput as $key => $value) {
                    if(!$page->Image()->where('image_id', $value['image_id'])->exists()){
                        $webpage->Image()->attach($value['image_id']);
                    } else {
                        return redirect(route('imageWebpage.editImage' , $webpageID))->withErrors(['error' => 'Aii niet alle images zijn geupdate omdat je deze al gekoppeld zijn aan de webpage\'s.']);
                    }
                }
            }
     return redirect()->route('paginas.index')->with('success','Alles is succesvol bijgewerkt indien er dingen verwijdert moeten worden kan dat via de show');
    }
}

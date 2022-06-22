<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Template;
use App\Models\Webpages;
use App\Models\NavbarItem;
use Illuminate\Support\Str;
use App\Models\DropdownItem;
use Illuminate\Http\Request;
use App\Models\colom_context_webpages;
use App\Models\colom_context as context_colomn;

class WebPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Webpages::all();
        $templates = count(glob("assets/images/Templates/*.jpg"));

        return view('cms.webpages.index' ,['webpages' => $data, 'templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navitems = NavbarItem::all();
        return view('cms.webpages.create', ['navItems' => $navitems]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
           'main_text' => 'required',
           'slug' => ['required', 'max:50'],
           'multiInput.*.colom_title_text' => 'required',
           'multiInput.*.colomn_text' => 'required',
       ]);
       $webpage = new Webpages;
       $webpage->template_id = 1;
       $webpage->slug = Str::slug(preg_replace('[^a-zA-Z0-9 -]','-',$request->input('slug')));
       $webpage->main_text = $request->input('main_text');
       $webpage->save();
       $webpageID = Webpages::latest('id')->first();
       if($request->multiInput != null) {
        foreach($request->multiInput as $key => $value) {
            context_colomn::create($value);
            $contextID = context_colomn::latest('id')->first();
            $webpagecontexttable = new colom_context_webpages;
            $webpagecontexttable->webpages_id = $webpageID->id;
            $webpagecontexttable->colom_context_id = $contextID->id;
            $webpagecontexttable->save();
        }
    }
       if($request->input('navItem') == 0){
           $navItem = new NavbarItem();
           $navItem->name = $request->input('slug');
           $navItem->link = $webpage->slug;
           $navItem->save();
       }
       else{
           $dropdownItem = new DropdownItem();
           $dropdownItem->name = $request->input('slug');
           $dropdownItem->link = $webpage->slug;
           $dropdownItem->navbar_item_id = $request->input('navItem');
           $dropdownItem->save();
       }

       return redirect()->route('paginas.index')->with('success','Pagina succesvol toegevoegd');
    }


    public function duplicatePage($pageId) {
        $webpage = Webpages::with('ColomContext' , 'Image' , 'youtube' , 'newsletter')->find($pageId);
        $navigation = NavbarItem::where('link' , $webpage->slug)->get();

        $allWebpages = Webpages::all();
        $newWebpage = $webpage->replicate();
        foreach($allWebpages as $page) {
            if($page->slug === $webpage->slug.''."-kopie") {
                return redirect()->route('paginas.index')->with('warning','sorry deze pagina is al gekopieerd');
            }
        }
        $newWebpage->slug = $webpage->slug .''. "-kopie";
        $newWebpage->save();
        $this->duplicateRelations($webpage , $newWebpage);
        $this->duplicateNavigation($navigation , $webpage);

        return redirect()->route('paginas.index')->with('success','Pagina succesvol gekopieerd');

    }

    public function duplicateRelations($webpage , $newWebpage) {
        foreach($webpage->ColomContext as $context) {
            $newWebpage->ColomContext()->attach($context);
        }
        foreach($webpage->Image as $image) {
            $newWebpage->Image()->attach($image);
        }
        foreach($webpage->youtube as $youtube) {
            $newWebpage->youtube()->attach($youtube);
        }
        foreach($webpage->newsletter as $newsletter) {
            $newWebpage->newsletter()->attach($newsletter);
        }
    }

    public function duplicateNavigation($navigation , $webpage) {
        if($navigation->count() !== 0) {
            foreach($navigation as $item) {
                $findNavigation = NavbarItem::find($item->id);
                $newNavigation = $findNavigation->replicate();
                $newNavigation->link = $webpage->slug .''. "-kopie";
                $newNavigation->save();
            }
        } else {
            $dropdownItem = DropdownItem::where('link' , $webpage->slug)->get();
            foreach($dropdownItem as $item) {
                $findDropdownItem = DropdownItem::find($item->id);
                $newDropdownItem = $findDropdownItem->replicate();
                $newDropdownItem->link = $webpage->slug .''. "-kopie";
                $newDropdownItem->save();
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pagecontent = Webpages::with('ColomContext' , 'youtube' , 'Image')->where('slug' , $slug)->get();
        $templateID = 0;
        foreach($pagecontent as $content) {
            $templateID = $content->template_id;
        }
        if($pagecontent->isEmpty()) abort(404);
        return view('templates.template'.$templateID , compact('pagecontent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Webpages::find($id);

        $navitems = NavbarItem::all();
        $selected = DropdownItem::where('link', $page->slug)->first()->navbar_item_id ?? 0;
        return view('cms.webpages.edit' , compact('page', 'navitems', 'selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
            'title' => ['required', 'max:50']
        ]);
        $webpage = Webpages::find($id);
        $webpage->main_text = $request->input('body');
        $webpage->slug = Str::slug(preg_replace('[^a-zA-Z0-9 -]','-',$request->input('title')));

        $navItem = DropdownItem::where('link', $webpage->getOriginal('slug'))->first() ?? NavbarItem::where('link', $webpage->getOriginal('slug'))->first();
        $navItem->link = $webpage->slug;
        $navItem->save();
        $this->changeNavItem($navItem, $request->input('navItem'));
        $webpage->save();
        return redirect()->route('editColomText.edit' , $webpage);
    }

    public function updateTemplate(Request $request, $id) {
        $request->validate([
            'imageId' => 'required',
        ]);
        $webpage = Webpages::find($id);
        $webpage->template_id = $request->input('imageId');
        $webpage->save();

        return redirect()->route('paginas.index')->with('success','Pagina succesvol bijgewerkt');
    }

    public function removeTemplate($id)
    {
        $webpage = Webpages::find($id);
        if(!empty($webpage->template_id)) {
            $webpage->template_id = 0;
        }
        $webpage->save();

        return redirect(route('paginas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $webpage =  Webpages::find($id);
        $navItem = DropdownItem::where('link', $webpage->getOriginal('slug'))->first() ?? NavbarItem::where('link', $webpage->getOriginal('slug'))->first();
        $navItem->delete();
        $webpage->delete();
        return redirect()->route('paginas.index');
    }

    private function changeNavItem($item, $navItemId){
        if($item->getTable() == "dropdownitems"){
            if($item->navbar_item_id != $navItemId){
                if($navItemId == 0){
                    NavbarItem::create([
                        'name' => $item->name,
                        'link' => $item->link

                    ]);
                    $item->delete();
                }
                else{
                    $item->navbar_item_id = $navItemId;
                    $item->save();
                }
            }
        }
        else{
            if($navItemId != 0){
                DropdownItem::create([
                    'name' => $item->name,
                    'link' => $item->link,
                    'navbar_item_id' => $navItemId
                ]);
                $item->delete();
            }
        }
    }

    public function showAllImagesWebpage($id) {

        $webpage = Webpages::find($id);
        $images = $webpage->Image;
        return view('cms.webpages.images' , compact('images' , 'webpage'));
    }

    public function destroyImage($webpageID , $imageId) {
        $webpage = Webpages::find($webpageID);
        $webpage->Image()->detach($imageId);
        return redirect()->route('paginas.index')->with('success','Afbeelding succesvol losgekoppeld van pagina '. $webpage->title);
    }
}

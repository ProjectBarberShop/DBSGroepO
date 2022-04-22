<?php

namespace App\Http\Controllers;

use App\Models\DropdownItem;
use App\Models\NavbarItem;
use Illuminate\Http\Request;
use App\Models\Webpages;
use App\Models\colom_context as context_colomn;
use App\Models\colom_context_webpages;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

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

        return view('cms.webpages.index' ,['webpages' => $data]);
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
           'slug' => 'required',
           'multiInput.*.colom_title_text' => 'required',
           'multiInput.*.colomn_text' => 'required',
       ]);
       $webpage = new Webpages;
       $webpage->template_id = 1;
       $webpage->slug = Str::slug($request->input('slug'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pagecontent = Webpages::with('ColomContext' , 'youtube')->where('slug' , $slug)->get();
        if($pagecontent->isEmpty()) abort(404);
        return view('contentpage' , compact('pagecontent'));
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
            'title' => 'required'
        ]);
        $webpage = Webpages::find($id);
        $webpage->main_text = $request->input('body');
        $webpage->slug = Str::slug($request->input('title'));

        $navItem = DropdownItem::where('link', $webpage->getOriginal('slug'))->first() ?? NavbarItem::where('link', $webpage->getOriginal('slug'))->first();
        $navItem->link = $webpage->slug;
        $navItem->save();
        $this->changeNavItem($navItem, $request->input('navItem'));
        $webpage->save();
        return redirect()->route('paginas.index')->with('success','Pagina succesvol bijgewerkt');
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
}

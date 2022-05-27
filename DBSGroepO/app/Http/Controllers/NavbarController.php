<?php

namespace App\Http\Controllers;

use App\Models\NavbarItem;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navitems = NavbarItem::orderBy('number')->get();
        return view('cms.navbar.index', compact('navitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required',
        ]);
        $navitem = new NavbarItem();
        $link = $request->input('link');
        $navitem->name = $request->input('name');
        $navitem->number = NavbarItem::count() + 1;
        if(!(empty($link))){
            $navitem->link = $request->input('link');
        }
        $navitem->save();

        return redirect(route('navbar.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $navdata = NavbarItem::find($id);
        return view('cms.navbar.edit', compact('navdata'));
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
            'name' => 'required',
        ]);

        NavbarItem::where('id', $id)->update([
            'name' => $request->input('name'),
            'link' => $request->input('link'),
        ]);

        return redirect(route('navbar.index'));
    }

    public function changeOrder(Request $request, $id) {
        $navbaritem = NavbarItem::find($id);
        $number = $request->higher ? $request->higher + 1 : $request->lower - 1;
        $higher = isset($request->higher);

        $findNavbaritem = NavbarItem::where('number', $number)->first();
        $findNavbaritem->update(['number'=> $higher ? $findNavbaritem->number - 1 : $findNavbaritem->number + 1]);
        $navbaritem->update(['number' => $number]);

        return redirect(route('navbar.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $navbaritem = NavbarItem::find($id);
        $navbaritems = NavbarItem::where('number' , '>' , $navbaritem->number)->get();

        NavbarItem::find($id)->delete();
        foreach($navbaritems as $item) {
            $item->update(['number'=> $item->number - 1]);
        }
        return redirect(route('navbar.index'));
    }
}

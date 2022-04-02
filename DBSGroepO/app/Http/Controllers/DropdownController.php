<?php

namespace App\Http\Controllers;

use App\Models\DropdownItem;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
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

        $dropdownItem = new DropdownItem();
        $link = $request->input('link');
        $dropdownItem->name = $request->input('name');
        $dropdownItem->navbar_item_id = $request->input('navItemId');
        if(!(empty($link))){
            $dropdownItem->link = $link;
        }
        $dropdownItem->save();

        return redirect(route('navbar.edit', $request->input('navItemId')));
    }

    public function destroy(int $id) {

        $item =  DropdownItem::find($id);
        $navItemId = $item->navbar_item_id;
        $item->delete();
        return redirect(route('navbar.edit', $navItemId));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Database\Seeders\FooterSeeder;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerdata = Footer::all()->first();

        return view('cms.footer.index', compact('footerdata'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footerdata = Footer::find($id);
        return view('cms.footer.edit', compact('footerdata'));
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
            'address' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'secretaryemail' => 'required',
            'kvk' => 'required',
            'facebookurl' => 'required',
        ]);

        Footer::where('id', $id)->update([
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'phonenumber' => $request->input('phonenumber'),
            'secretaryemail' => $request->input('secretaryemail'),
            'kvk' => $request->input('kvk'),
            'facebookurl' => $request->input('facebookurl')

        ]);

        return redirect('cms/footer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

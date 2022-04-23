<?php

namespace App\Http\Controllers;

use App\Models\Webpages;
use Illuminate\Http\Request;
use App\Models\colom_context;

class ColumnTextController extends Controller
{

    public function edit($webpage)
    {
        $pagecontent = Webpages::with('ColomContext')->where('id' , $webpage)->get();
        return view('cms.webpages.edit_colomn_text' , compact('pagecontent'));
    }

    public function updateAndStore(Request $request, $webpage)
    {
        $request->validate([
            'collomMainText.*.colom_title_text' => 'required',
            'collomMainText.*.id' => 'required',
            'collomMainText.*.colomn_text' => 'required',
            'multiInput.*.colom_title_text' => 'required',
            'multiInput.*.colomn_text' => 'required'
        ]);
        if($request->multiInput != null) {
            foreach($request->multiInput as $key => $value) {
                $colomContext = colom_context::create($value);
                $colomContext->Webpages()->attach($webpage);
                $colomContext->save();
            }
        }
        if($request->collomMainText != null) {
            foreach($request->collomMainText as $key => $value) {
                    $colomContext = colom_context::find($key);
                    $colomContext->colom_title_text = $value['colom_title_text'];
                    $colomContext->colomn_text = $value['colomn_text'];
                    $colomContext->save();
            }
        }
        return redirect()->route('youtubeWebpage.editYoutube' , $webpage);
    }

    public function destroy($id , $webpage)
    {
        colom_context::find($id)->delete();
        $pagecontent = Webpages::with('ColomContext')->where('id' , $webpage)->get();
        return view('cms.webpages.edit_colomn_Text' , compact('pagecontent'));
    }
}

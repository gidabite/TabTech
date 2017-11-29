<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use App\Category;
class AjaxController extends Controller
{
    public function category(Request $request)
    {
        if (Input::get('name') != null){

            $category = Category::where('name', Input::get('name'))->first();

            if ($category != null) {
                $answer = "";
                $characteristics = json_decode($category->json_characteristics);

                foreach($characteristics as $key => $char) {
                    $answer .= '<div style = "margin-top: 10px;" class="row form-group" style="margin-bottom: 0px;">';
                    $answer .= '    <label for="char" class="col-md-2 control-label">'.(!is_array($char)?htmlspecialchars($char):htmlspecialchars($char[0])).'</label>';
                    $answer .= '        <div class="col-md-8">';
                    if (!is_array($char))
                        $answer .= '<input required class="form-control" aria-describedby = "sizing-addon2" placeholder = "Text" name = "char'.$key.'" type = "text" >';
                    else {
                        $answer .= '<select required id = "select' . $key . '" aria-describedby = "sizing-addon2" name = "char'.$key.'" class="form-control" >';

                        foreach ($char[1] as $key2 => $elem) {

                            $answer .= '<option value = "'.htmlspecialchars($elem).'" >'.htmlspecialchars($elem).'</option>';
                        }
                        $answer .='</select >';
                    }
                    $answer .= '         </div >';
                    $answer .= '                    </div >';
                }

                return response()->json(array('msg' => $answer), 200);
            }
            else return response()->json(array('msg'=> ''), 200);
        }
        else return response()->json(array('msg'=> ''), 200);

    }
    public function image(Request $request)
    {
        $this->validate($request, [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('img') && $request->file('img')->isValid()) {
            $file = $request->file('img');
            $destinationPath = public_path('images/tmp/');
            $ext = $file->extension();
            $path = $file->move($destinationPath);
            return response()->json(array('msg' => "/images/tmp/".$file->getFilename()), 200);
        }
        return response()->json(array('msg' => "ddd"), 200);

    }
}

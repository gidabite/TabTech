<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Input;
use App\Category;
use Auth;
use DB;

class AjaxController extends Controller
{
    public function category(Request $request)
    {
        if (Auth::check() && Auth::user()->isManager) {
            if (Input::get('name') != null) {

                $category = Category::where('name', Input::get('name'))->first();
                if ($category != null) {
                    $answer = "";
                    $characteristics = json_decode($category->json_characteristics);

                    foreach ($characteristics as $key => $char) {
                        $answer .= '<div style = "margin-top: 10px;" class="row form-group" style="margin-bottom: 0px;">';
                        $answer .= '    <label for="char" class="col-md-2 control-label">' . (!is_array($char) ? htmlspecialchars($char) : htmlspecialchars($char[0])) . '</label>';
                        $answer .= '        <div class="col-md-8">';
                        if (!is_array($char))
                            $answer .= '<input required class="form-control" aria-describedby = "sizing-addon2" placeholder = "Text" name = "char' . $key . '" type = "text" >';
                        else {
                            $answer .= '<select required id = "select' . $key . '" aria-describedby = "sizing-addon2" name = "char' . $key . '" class="form-control" >';

                            foreach ($char[1] as $key2 => $elem) {

                                $answer .= '<option value = "' . htmlspecialchars($elem) . '" >' . htmlspecialchars($elem) . '</option>';
                            }
                            $answer .= '</select >';
                        }
                        $answer .= '         </div >';
                        $answer .= '                    </div >';
                    }

                    return response()->json(array('msg' => $answer), 200);
                } else return response()->json(array('msg' => ''), 200);
            } else return response()->json(array('msg' => ''), 200);
        }
    }
    public function image(Request $request)
    {
        if (Auth::check() && Auth::user()->isManager) {
            $this->validate($request, [
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($request->hasFile('img') && $request->file('img')->isValid()) {
                $file = $request->file('img');
                $destinationPath = public_path('images/tmp/');
                $ext = $file->extension();
                $path = $file->move($destinationPath);
                return response()->json(array('msg' => "/images/tmp/" . $file->getFilename()), 200);
            }
            return response()->json(array('msg' => "ddd"), 200);
        }
    }

    public function stars(Request $request)
    {
        if (Auth::check()) {
            if (Input::has('stars') && Input::has('id')) {
                if (Input::get('stars') >= 1 && Input::get('stars') <= 5 || Product::find(Input::get('id')) != null) {
                    if (DB::table('reviews')->select('stars')->where('id_user', Auth::user()->id)->where('id_product',Input::get('id'))->first() == null){
                        DB::table('reviews')->insert(['id_user' => Auth::user()->id, 'id_product' => Input::get('id'), 'stars' => Input::get('stars')]);
                    } else {
                        DB::table('reviews')->where('id_user', Auth::user()->id)->where('id_product', Input::get('id'))->update(['stars' => Input::get('stars')]);
                }

                    return response()->json(array('msg' => (int)(DB::table('reviews')->where('id_product', Input::get('id'))->avg('stars')), 'count' => DB::table('reviews')->where('id_product', Input::get('id'))->count().' customer review. You reviews: '.Input::get('stars')), 200);
                }
            }
            return response()->json(array('msg' => 0), 200);
        }
        return response()->json(array('msg' => 0), 200);

    }

    public function manager(){
        if (Auth::check() && Auth::user()->isAdmin) {
            if (Input::has('id')){
                $user = User::find(Input::get('id'));
                if ($user != null){
                    if ($user->isManager){
                        $user->isManager = 0;
                    } else $user->isManager = 1;
                    $user->save();
                }
            }
        }
        return response()->json(array('msg' => 0), 200);
    }
}

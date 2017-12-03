<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use App\Category as Category;
use Session;
use Grandcategory;
use Validator;
use Illuminate\Validation\Rule;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->isAdmin){
            return view('home.categories.create');
        } else return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->isAdmin){
            if (Input::get('name') != "" && Input::get('grandcategory')) {
                $i = 0;
                $char = (array)null;
                while ($name = Input::get("char" . $i)) {

                    $select = Input::get("select" . $i);
                    if ($select == "list") {
                        $elements = (array)null;
                        $j = 0;
                        while ($name_el = Input::get("elem_" . $i . "_" . $j)) {
                            $elements[$j] = $name_el;
                            $j++;
                        }
                        $char[$i] = [$name, $elements];
                    } else {
                        $char[$i] = $name;
                    }
                    $i++;
                }
                $json_category = json_encode($char);
                if ($json_category != "[]") {
                    $category = new Category;
                    $category->name = Input::get('name');
                    $category->json_characteristics = $json_category;
                    $category->save();

                    Validator::make($request->all(), [
                        'grandcategory' => [
                            'required',
                            Rule::in(DB::table('grandcategories')->pluck ('name')->toArray()),
                        ],
                    ])->validate();
                    $id_grand = $category = Grandcategory::where('name', Input::get('grandcategory'))->first()->id;
                    DB::table('grand_sub_categories')->insert([
                        ['id_sub' => DB::table('categories')->max('id'), 'id_grand' => $id_grand]
                    ]);


                    Session::flash('message', 'Subcategory successfully created!');
                }
            }
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            $category = Category::find($id);
            if ($category != null){
                $id_grand = DB::table('grand_sub_categories')->select('id_grand')->where('id_sub', $id)->first()->id_grand;
                if ($grandcategory = DB::table('grandcategories')->select('name')->where('id', $id_grand)->first() != null) {
                    $characteristics = json_decode($category->json_characteristics);
                    return view('home.categories.show', ['id' => $category->id, 'name' => $category->name, 'characteristics' => $characteristics]);
                } else {
                    Session::flash('message', 'Category #'.$id.' has errors! Update it!');
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->isAdmin){
            $category = Category::find($id);
            if ($category != null && $id != 1) {
                $characteristics = json_decode($category->json_characteristics);
                return view('home.categories.edit', ['id' => $category->id, 'name' => $category->name, 'characteristics' => $characteristics]);
            }
        }
        return redirect()->route('home');
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
        if (Auth::check() && Auth::user()->isAdmin){
            if (Input::get('name') != "" && Input::get('grandcategory')) {
                $i = 0;
                $char = (array)null;
                while ($name = Input::get("char" . $i)) {

                    $select = Input::get("select" . $i);
                    if ($select == "list") {
                        $elements = (array)null;
                        $j = 0;
                        while ($name_el = Input::get("elem_" . $i . "_" . $j)) {
                            $elements[$j] = $name_el;
                            $j++;
                        }
                        $char[$i] = [$name, $elements];
                    } else {
                        $char[$i] = $name;
                    }
                    $i++;
                }
                $json_category = json_encode($char);
                if ($json_category != "[]") {
                    $category = Category::find($id);
                    if ($category != null && $id != 1) {
                        $category->name = Input::get('name');
                        $category->json_characteristics = $json_category;
                        $category->save();

                        Validator::make($request->all(), [
                            'grandcategory' => [
                                'required',
                                Rule::in(DB::table('grandcategories')->pluck ('name')->toArray()),
                            ],
                        ])->validate();
                        $id_grand = $category = Grandcategory::where('name', Input::get('grandcategory'))->first()->id;
                        DB::table('grand_sub_categories')
                            ->where('id_sub', $id)
                            ->update(['id_grand' => $id_grand]);

                        Session::flash('message', 'Cubcategory successfully updated!');
                    }
                }
            }
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            $category = Category::find($id);
            if ($category != null && $id != 1) {
                $category->delete();
                Session::flash('message', 'Subcategory successfully deleted!');
            }
        }
        return redirect()->route('home');
    }
}

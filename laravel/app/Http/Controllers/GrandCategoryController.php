<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Grandcategory;
use Auth;
use DB;
use Validator;
use Input;
use Session;

class GrandCategoryController extends Controller
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
            return view('home.grandcategories.create');
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
            Validator::make($request->all(), [
                'name' => 'required|filled|string|max:255',
                'description' => 'required|filled|string',
            ])->validate();
            $grandcategory = new Grandcategory;
            $grandcategory->name = Input::get('name');
            $grandcategory->description = Input::get('description');
            $grandcategory->save();
            Session::flash('message', 'Category successfully created!');

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
        $grandcategory = Grandcategory::find($id);
        if ($grandcategory != null) {
            $characteristics = json_decode($grandcategory->json_characteristics);
            return view('home.grandcategories.show', [
                'id' => $grandcategory->id,
                'name' => $grandcategory->name,
                'description' => $grandcategory->description
            ]);
        }
        return redirect()->route('home');
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
            $grandcategory = Grandcategory::find($id);
            if ($grandcategory != null) {
                return view('home.grandcategories.edit', ['id' => $grandcategory->id, 'name' => $grandcategory->name, 'description' => $grandcategory->description]);
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
                    $grandcategory = Grandcategory::find($id);
                    if ($grandcategory != null) {
                        $grandcategory->name = Input::get('name');
                        $grandcategory->description = Input::get('description');
                        $grandcategory->save();
                        Session::flash('message', 'Category successfully updated!');
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
            $grandcategory = Grandcategory::find($id);
            if ($grandcategory != null) {
                $grandcategory->delete();
                Session::flash('message', 'Category successfully deleted!');
            }
        }
        return redirect()->route('home');
    }
}

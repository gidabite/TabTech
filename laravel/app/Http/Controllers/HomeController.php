<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use Input;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isManager) {
            return view('home.manager');
        } else if (Auth::user()->isAdmin){
            return view('home.admin');
        } else
            return view('home.user');
    }

    public function update(Request $request){
        if (Auth::check()) {
            Validator::make($request->all(), [
                'name' => 'required|filled|string|max:255',
                'address' => 'string|Nullable',
            ])->validate();
            Auth::user()->name = Input::get('name');
            Auth::user()->address = Input::get('address');
            Auth::user()->save();
            Session::flash('message', 'Data saved successfully');
        }
        return redirect()->route('home');
    }
}

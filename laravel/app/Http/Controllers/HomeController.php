<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        if (Auth::user()->verified == 1) {
            if (Auth::user()->isAdmin) {
                return view('home.admin');
            } else {
                return view('home.user');
            }
        } else {
            $email = Auth::user()->email;
            Auth::Logout();
            return redirect()->route('login', ['notVerified' => $email]);
        }
    }
}

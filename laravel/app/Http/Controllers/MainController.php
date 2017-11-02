<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class MainController extends Controller
{
    public function index()
    {
        if (!Auth::guest())
        {
            if (Auth::user()->verified == 1){


            } else Auth::Logout();
        }
        return view('welcome');
    }
}

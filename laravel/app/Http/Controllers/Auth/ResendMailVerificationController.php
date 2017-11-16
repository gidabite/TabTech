<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendVerificationEmail;
use App\User;
use Input;

class ResendMailVerificationController extends Controller
{
    public function index()
    {
        $user = User::where('email', Input::get('email'))->first();
        if ($user != null) {
            dispatch((new SendVerificationEmail($user))->delay(10));
            return redirect()->route('login');
        }
    }
}

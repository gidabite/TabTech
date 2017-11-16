<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Input;
use DB;
use Session;
use Hash;
use Illuminate\Http\Request;
use Validator;

class ResetPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showSecretQuestion(){

        if (Input::has('email')){
            $user = DB::table('users')->where('email', '=', Input::get('email'))->get();
            if (count($user) != 0){
                $token_check = bcrypt(str_random(64));
                $db_token = DB::table('password_resets')->where('email', '=', Input::get('email'))->get();
                if (count($db_token) == 0){
                    DB::table('password_resets')->insert(
                        ['email' => Input::get('email'), 'token_check' => $token_check]
                    );
                } else {
                    DB::table('password_resets')
                        ->where('email', Input::get('email'))
                        ->update(['token_check' => $token_check]);
                }
                $question = $user[0]->secret_question;
                return view("auth.passwords.secret", ['question' => $question, 'token' => $token_check]);
            }else {
                Session::flash('message', 'Email не найден!');
                return redirect()->route("password.request");
            }
        } else {
            Session::flash('message', 'Email не найден!');
            return redirect()->route("password.request");
        }
    }
    public function checkAnswer(){
        if (Input::has('token_check') && Input::has('answer')){
            $db_token = DB::table('password_resets')->where('token_check', '=', Input::get('token_check'))->get();
            if (count($db_token) != 0){
                $user = DB::table('users')->where('email', '=', $db_token[0]->email)->get();
                if (count($user) != 0) {
                    if (Hash::check(Input::get('answer'), $user[0]->answer))
                    {
                        $token_reset = bcrypt(str_random(64));
                        DB::table('password_resets')
                            ->where('email', $db_token[0]->email)
                            ->update(['token_reset' => $token_reset]);
                        return view("auth.passwords.reset", ['token' => $token_reset]);
                    } else{
                        Session::flash('message', 'Ошибка проверки секретоного вопроса!');
                        return redirect()->route("password.request");
                    }
                } else{
                    Session::flash('message', 'Ошибка проверки секретоного вопроса!');
                    return redirect()->route("password.request");
                }
            }else{
                Session::flash('message', 'Ошибка проверки секретоного вопроса!');
                return redirect()->route("password.request");
            }
        }
    }
    public function updatePassword(Request $request)
    {
        if (Input::has('captcha')) {
            $rules = ['captcha' => 'required|captcha'];
            $validator = Validator::make(Input::all(), $rules);
            if (!$validator->fails()) {
                if (Input::has('token_reset')) {
                    if (Input::has('email')) {
                        $db_token = DB::table('password_resets')->where('email', '=', Input::get('email'))->get();
                        if (count($db_token) != 0) {
                            if ($db_token[0]->token_reset == Input::get('token_reset')) {
                                if (Input::has('password') && Input::has('password_confirmation') && Input::get('password') == Input::get('password_confirmation')) {
                                    $validator = Validator::make($request->all(), [
                                        'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!$#%]).*$/|confirmed']);
                                    if (!$validator->fails()) {
                                        DB::table('users')
                                            ->where('email', Input::get('email'))
                                            ->update(['password' => bcrypt(Input::get('password'))]);
                                        return redirect()->route("login");
                                    } else {
                                        Session::flash('message', 'Пароль имеет ошибки в формате!');
                                        return view("auth.passwords.reset", ['token' => $db_token[0]->token_reset]);
                                    }

                                } else {
                                    Session::flash('message', 'Пароли не совпадают!');
                                    return view("auth.passwords.reset", ['token' => $db_token[0]->token_reset]);
                                }
                            } else {
                                Session::flash('message', $db_token[0]->token_reset . '/n/r' . Input::get('token_reset'));
                                return redirect()->route("password.request");
                            }
                        } else {
                            Session::flash('message', 'Невозможно сменить пароль!');
                            return redirect()->route("password.request");
                        }
                    } else {
                        Session::flash('message', 'Невозможно сменить пароль!');
                        return redirect()->route("password.request");
                    }
                } else {
                    Session::flash('message', 'Невозможно сменить пароль!');
                    return redirect()->route("password.request");
                }
            } else {
                Session::flash('message', 'Введен неправильный код с картинки!');
                return view("auth.passwords.reset", ['token' => Input::has('token_reset')]);
            }
        } else {
            Session::flash('message', 'Введен неправильный код с картинки!');
            return view("auth.passwords.reset", ['token' => Input::has('token_reset')]);
        }
    }

}

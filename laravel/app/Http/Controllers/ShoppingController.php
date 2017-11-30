<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use Product;
use Input;

class ShoppingController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    public function add(){
        if (Auth::check()){
            if (Input::has('id')) {
                $product = Product::find(Input::get('id'));
                if ($product != null){
                    $shop_id = 'cart'.Auth::user()->id;
                    Cart::instance($shop_id)->restore($shop_id);
                    Cart::instance($shop_id)->add($product->id, $product->name, 1, $product->price);
                    var_dump(Cart::instance($shop_id)->content());
                    Cart::instance($shop_id)->store($shop_id);
                }
            }
            return redirect()->back();
        } else return redirect()->route('login');
    }

    public function decrease(){
        if (Auth::check()){
            if (Input::has('id')) {
                $product = Product::find(Input::get('id'));
                if ($product != null){
                    $shop_id = 'cart'.Auth::user()->id;
                    Cart::instance($shop_id)->restore($shop_id);
                    $rowId = Cart::instance($shop_id)->add($product->id, $product->name, 0, $product->price)->rowId;
                    Cart::instance($shop_id)->update($rowId, Cart::instance($shop_id)->get($rowId)->qty - 2);
                    var_dump(Cart::instance($shop_id)->content());
                    Cart::instance($shop_id)->store($shop_id);
                }
            }
            return redirect()->back();
        } else return redirect()->route('login');
    }

    public function delete(){
        if (Auth::check()){
            if (Input::has('id')) {
                $product = Product::find(Input::get('id'));
                if ($product != null){
                    $shop_id = 'cart'.Auth::user()->id;
                    Cart::instance($shop_id)->restore($shop_id);
                    $rowId = Cart::instance($shop_id)->add($product->id, $product->name, 1, $product->price)->rowId;
                    Cart::instance($shop_id)->remove($rowId);
                    var_dump(Cart::instance($shop_id)->content());
                    Cart::instance($shop_id)->store($shop_id);
                }
            }
            return redirect()->back();
        } else return redirect()->route('login');
    }

    public function basket(){
        if (Auth::check()){

                $shop_id = 'cart'.Auth::user()->id;

                Cart::instance($shop_id)->restore($shop_id);
                $content = Cart::instance($shop_id)->content();
                $count = Cart::instance($shop_id)->count();
                Cart::instance($shop_id)->store($shop_id);
                return view('shopping', ['items' => $content , 'count' => $count]);
        } else return redirect()->route('login');
    }
}

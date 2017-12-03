<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Cart;
use Product;
use Input;
use App\Order;
use Validator;
use Session;

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
                    $rowId = Cart::instance($shop_id)->add($product->id, $product->name, 1, $product->price)->rowId;
                    Cart::instance($shop_id)->update($rowId, Cart::instance($shop_id)->get($rowId)->qty - 2);
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
                    Cart::instance($shop_id)->remove($rowId);;
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
                return view('order.shopping', ['items' => $content , 'count' => $count]);
        } else return redirect()->route('login');
    }

    public function order(){
        if (Auth::check()){
            $shop_id = 'cart'.Auth::user()->id;
            Cart::instance($shop_id)->restore($shop_id);
            $content = Cart::instance($shop_id)->content();
            $count = Cart::instance($shop_id)->count();
            Cart::instance($shop_id)->store($shop_id);
            if ($count != 0 ){
                return view('order.order', ['items' => $content, 'count' => $count]);
            } else return redirect()->back();
        } else return redirect()->route('login');
    }

    public function pay(Request $request){
        if (Auth::check()) {
            Validator::make($request->all(), [
                'address' => 'required|string',
            ])->validate();
            $order = new Order;
            $order->id_user = Auth::user()->id;
            $order->address = Input::get('address');
            $shop_id = 'cart' . Auth::user()->id;
            Cart::instance($shop_id)->restore($shop_id);
            $count = Cart::instance($shop_id)->count();
            $total= 0;
            foreach (Cart::instance($shop_id)->content() as $item){
                $total +=$item->total/1.21;
            }
            $order->total = $total;
            $order->content = Cart::instance($shop_id)->content();
            Cart::instance($shop_id)->destroy();
            if ($count != 0) {
                $order->save();
                Session::flash('message', 'Order is processed');
                return redirect()->route('history');
            }
        }
        return redirect()->back();
    }
    public function history(){
        if (Auth::check()) {
            $orders = Order::where('id_user', Auth::user()->id)->get();
            return view('order.history', ['orders' => $orders]);
        }
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use App\Product as Product;
use Category;
use Session;
use  Validator;
use Illuminate\Validation\Rule;
use DB;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = preg_replace('%[^A-Za-zА-Яа-я0-9. ]%', '', (Input::get('q')));
        if (!Input::has('category_search') || Input::get('category_search') == 'All' || \App\Category::where('name', Input::get('category_search'))->first() == null){
            $products = Product::search($q, null, true)->get();
            return view('home.products.products', ['products' => $products]);
        } else {
            $products = Product::where('category', Input::get('category_search') )->search($q, null, true)->get();
            return view('home.products.products', ['products' => $products, 'curr_item' => Input::get('category_search')]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->isManager){
            return view('home.products.create');
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
        if (Auth::check() && Auth::user()->isManager){
            Validator::make($request->all(), [
                'name' => 'required|filled|string|max:255',
                'price' => 'required|filled|numeric|between:0,9999999.99',
                'description' => 'required|filled|string',
                'category' => 'required|filled|string|exists:categories,name'
            ])->validate();
            $category = Category::where('name', Input::get('category'))->first();
            if ($category != null) {
                $characteristics = json_decode($category->json_characteristics);

                $char_valid = (array)null;
                $char_array = (array)null;
                foreach ($characteristics as $key => $char){
                    if(!is_array($char)){
                        $char_valid['char'.$key] = 'string|Nullable';
                        $char_array['char'.$key] = Input::get('char'.$key);
                    }else {
                        $char_valid['char'.$key] = [
                            'required',
                            Rule::in($char[1]),
                        ];
                        $char_array['char'.$key] = Input::get('char'.$key);
                    }
                }
                Validator::make($request->all(),  $char_valid)->validate();
                $json_product = json_encode($char_array);
                if ($json_product != "[]") {
                    $product = new Product;
                    $product->name = Input::get('name');
                    $product->description = Input::get('description');
                    $product->price = Input::get('price');
                    $product->category = Input::get('category');
                    $nextId = DB::table('products')->max('id') + 1;
                    $product->json_characteristics = $json_product;
                    $product->save();
                    $count_img = 0;
                    for ($i = 1; $i <= 3; $i++) {

                        if ($request->hasFile('image'.$i) && $request->file('image'.$i)->isValid()) {
                            Validator::make($request->all(), [
                                'image'.$i => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                            ])->validate();
                            $count_img++;
                            $file = $request->file('image'.$i);
                            $destinationPath = public_path('images/products/' . $product->id . '/');
                            $ext = $file->extension();
                            $path = $file->move($destinationPath, $count_img . '.' . $ext);
                            $product['src_img_'.$i] = '/images/products/' .  $product->id . '/' . $count_img . '.' . $ext;
                        }
                    }
                    $product->save();
                }
                Session::flash('message', 'Product successfully created!');
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
        $product = Product::find($id);
            if ($product != null && Category::where('name', $product->category)->first() != null) {
                $characteristics = json_decode($product->json_characteristics);
                $stars = 0;
                if (Auth::check()){
                    $review = DB::table('reviews')->select('stars')->where('id_user', Auth::user()->id)->where('id_product',$id)->first();
                    if ($review != null){
                        $stars = $review->stars;
                    }
                }
                return view('home.products.show', [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'src_img_1' => $product->src_img_1,
                    'src_img_2' => $product->src_img_2,
                    'src_img_3' => $product->src_img_3,
                    'characteristics' => $characteristics,
                    'stars' => $stars
                ]);
            } else {
                if (Auth::check() && Auth::user()->isManager)
                    Session::flash('message', 'Product #s'.$id.' has errors! Update it!');
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
        if (Auth::check() && Auth::user()->isManager){
            $product = Product::find($id);
            if ($product != null) {
                $characteristics = json_decode($product->json_characteristics);
                return view('home.products.edit', [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'src_img_1' => $product->src_img_1,
                    'src_img_2' => $product->src_img_2,
                    'src_img_3' => $product->src_img_3,
                    'characteristics' => $characteristics
                ]);
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
        if (Auth::check() && Auth::user()->isManager){
            Validator::make($request->all(), [
                'name' => 'required|filled|string|max:255',
                'price' => 'required|filled|numeric|between:0,9999999.99',
                'description' => 'required|filled|string',
                'category' => 'required|filled|string|exists:categories,name'
            ])->validate();
            $category = Category::where('name', Input::get('category'))->first();
            if ($category != null) {
                $characteristics = json_decode($category->json_characteristics);

                $char_valid = (array)null;
                $char_array = (array)null;
                $messages = (array)null;
                foreach ($characteristics as $key => $char){
                    if(!is_array($char)){
                        $char_valid['char'.$key] = 'string';
                        $char_array['char'.$key] = Input::get('char'.$key);

                    }else {
                        $char_valid['char'.$key] = [
                            'required',
                            Rule::in($char[1]),
                        ];
                        $char_array['char'.$key] = Input::get('char'.$key);
                    }
                }
                Validator::make($request->all(),  $char_valid)->validate();
                $json_product = json_encode($char_array);
                if ($json_product != "[]") {
                    $product = Product::find($id);
                    $product->name = Input::get('name');
                    $product->description = Input::get('description');
                    $product->price = Input::get('price');
                    $product->category = Input::get('category');
                    $product->json_characteristics = $json_product;
                    $count_img = 0;
                    for ($i = 1; $i <= 3; $i++) {

                        if ($request->hasFile('image'.$i) && $request->file('image'.$i)->isValid()) {
                            Validator::make($request->all(), [
                                'image'.$i => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                            ])->validate();
                            $count_img++;
                            $file = $request->file('image'.$i);
                            $destinationPath = public_path('images/products/' . $id . '/');
                            $ext = $file->extension();
                            $path = $file->move($destinationPath, $count_img . '.' . $ext);
                            $product['src_img_'.$i] = '/images/products/' . $id . '/' . $count_img . '.' . $ext;
                        }
                    }
                    $product->save();
                }
                Session::flash('message', 'Product successfully updated!');
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
        if (Auth::check() && Auth::user()->isManager) {
            $product = Product::find($id);
            if ($product != null) {
                $p = false;
                if ($product->src_img_1 != null)
                {
                    unlink(public_path($product->src_img_1));
                    $p = true;
                }
                if ($product->src_img_2 != null)
                {
                    unlink(public_path($product->src_img_2));
                    $p = true;
                }
                if ($product->src_img_3 != null)
                {
                    unlink(public_path($product->src_img_3));
                    $p = true;
                }
                if ($p) rmdir(public_path('/images/products/'.$id.'/'));
                $product->delete();
                Session::flash('message', 'Product successfully deleted!');
            }
        }
        return redirect()->route('home');
    }
}

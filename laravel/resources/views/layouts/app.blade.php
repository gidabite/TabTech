<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset("/images/logo.png")}}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--jQuery(necessary for Bootstrap's JavaScript plugins)-->
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <!--Custom-Theme-files-->
    <!--theme-style-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--start-menu-->
    <script src="{{ asset('js/simpleCart.min.js') }}"> </script>
    <link href="{{ asset('css/memenu.css') }}" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{{ asset('js/memenu.js') }}"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>
    <!--dropdown-->
    <script src="{{ asset('js/jquery.easydropdown.js') }}"></script>
</head>
<body>
<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-6 top-header-left">
                <ul class="nav navbar-nav navbar-left">
                    <li><a class = "navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
                </ul>
            </div>
            @guest
                <div class="col-md-6 top-header-left">
                        <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                    </ul>
                </div>
                @else
            <div class="col-md-1 col-md-offset-1 top-header-right">
                <div class="cart box_1">
                    <a href="{{route('basket')}}">
                        <img src="{{asset("images/cart-1.png")}}" alt="" />
                    </a>
                    @php
                        Cart::instance('cart'.Auth::user()->id)->restore('cart'.Auth::user()->id);
                    @endphp
                    <p><a href="{{route('basket')}}" class="simpleCart_empty">{{Cart::instance('cart'.Auth::user()->id)->count()}} items</a></p>
                    @php
                        Cart::instance('cart'.Auth::user()->id)->store('cart'.Auth::user()->id);
                    @endphp
                    <div class="clearfix"> </div>
                </div>
            </div>
                    <div class="col-md-4 top-header-left">
                        <ul class="nav navbar-nav navbar-left">
                            <!-- Authentication Links -->
                            <li><a href="{{ route('history') }}">My history</a></li>
                            <li><a href="{{ route('home') }}">My account</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--bottom-header-->
<div class="header-bottom" >
    <div class="container">
        <div class="header">
            <div class="col-md-6 header-left">
                <div class="top-nav">
                    <ul class="memenu skyblue">
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li class="grid"><a href="#">Categories</a>
                            <div class="mepanel">
                                <div class="row">
                                    @foreach(DB::table('grandcategories')->pluck('name', 'id') as $id => $name)
                                        <div class="col1 me-one">
                                            <a href="/products?category_search=All&q={{$name}}" style = " text-decoration: none; "><h4>{{$name}}</h4></a>
                                            <ul>
                                                @php
                                                    $subs_id = DB::table('grand_sub_categories')->where('id_grand', $id)->pluck('id_sub');
                                                    $subs_name = DB::table('categories')->where('name', '!=', 'All')->whereIn('id', $subs_id)->pluck('name');
                                                @endphp
                                                @foreach($subs_name as $name_sub )
                                                    <li><a href="{{url('/products')}}?category_search={{$name_sub}}">{{$name_sub}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="grid"><a href="{{url('/products')}}">All Products</a>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    @php
                        $grandcategories = \App\Grandcategory::all();
                        $options = (array)null;
                        $options['All'] = 'All Products';
                        foreach ($grandcategories as $grandcategory){
                            $subcateg_id = DB::table('grand_sub_categories')->where('id_grand', $grandcategory->id)->pluck('id_sub');
                            $subcateg = DB::table('categories')->whereIn('id', $subcateg_id)->where('name', '!=', 'All')->pluck('name');
                            $cat = (array)null;
                            foreach ($subcateg as $key => $categ){
                                $cat[$categ] = $categ;
                            }
                             $options[$grandcategory->name] = ($cat);
                        }
                        $name = 'All'
                    @endphp
                    @isset($curr_item)
                        @php
                            $name=$curr_item;
                        @endphp
                    @endisset
                    {{Form::open(array('url' => '/products', 'id' => 'search', 'method' => 'get'))}}
                    {{Form::close()}}
                        {{Form::select('category_search', $options,  $name, array('form'=>'search', 'class' => 'form-control ', 'required'))}}
                        <span style="width:0px; padding: 0px; border-width: 0px" class="input-group-addon" title="* Price" id="priceLabel"></span>
                        <input class="form-control" name = 'q' placeholder='Search' type="text" value="{{Input::get('q')}}" form = 'search'>
                        <span class="input-group-btn">
                            <input class="btn btn-default" form = 'search' type="submit" value="Search" class="form-control">
                        </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
@yield('content')
<!--information-starts-->
<div class="information">
    <div class="container">
        <div class="infor-top">

            <br>

            <div class="@guest col-md-4 @else col-md-3 @endguest infor-left">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#"><span class="fb"></span><h6>Facebook</h6></a></li>
                    <li><a href="#"><span class="twit"></span><h6>Twitter</h6></a></li>
                    <li><a href="#"><span class="google"></span><h6>Google+</h6></a></li>
                </ul>
            </div>
            <div class="@guest col-md-4 @else col-md-3 @endguest infor-left">
                <h3>Information</h3>
                <ul>
                    <li><a href="/products"><p>Products</p></a></li>
                </ul>
            </div>
            @guest
                @else
                    <div class="col-md-3 infor-left">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="/home"><p>My Account</p></a></li>
                            <li><a href="/history"><p>My History</p></a></li>
                            <li><a href="/basket"><p>My Basket</p></a></li>
                        </ul>
                    </div>
            @endguest
            <div class="@guest col-md-4 @else col-md-3 @endguest infor-left">
                <h3>Store Information</h3>
                <h4>The company name,
                    <span>Lorem ipsum dolor,</span>
                    Glasglow Dr 40 Fe 72.</h4>
                <h5>+955 123 4567</h5>
                <p><a href="mailto:example@email.com">contact@example.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--information-end-->
</body>
</html>
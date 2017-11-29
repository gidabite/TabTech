@extends('layouts.app')

@section('content')
    <!--banner-starts-->
    <div class="bnr" id="home" style="margin-bottom:60px;">
        <div  id="top" class="callbacks_container">
            <ul class="rslides" id="slider4">
                <li>
                    <img src="{{asset('images/bnr-1.jpg')}}" alt=""/>
                </li>
                <li>
                    <img src="{{asset('images/bnr-2.jpg')}}" alt=""/>
                </li>
                <li>
                    <img src="{{asset('images/bnr-3.jpg')}}" alt=""/>
                </li>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!--banner-ends-->
    <!--Slider-Starts-Here-->
    <script src="js/responsiveslides.min.js"></script>
    <script>
        // You can also use "$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
    <!--End-slider-script-->
    <div class="product">
        <div class="container">
            <div class="product-top">
                @php
                    $products = DB::table('products')->latest()->limit(8)->get();
                @endphp
                <div class="product-one">
                    @for($i = 0; $i < 4 && $i < count($products); $i++)
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="{{ URL::to('products/' . $products[$i]->id) }}" class="mask"><img class="img-responsive zoom-img" src="{{$products[$i]->src_img_1}}" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>{{$products[$i]->name}}</h3>
                                    <p>Explore Now</p>
                                    <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ {{$products[$i]->price}}</span></h4>
                                </div>
                                <div class="srch">
                                    <span>Get me!</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="product-top">
                @php
                    $products = DB::table('products')->latest()->limit(8)->get();
                @endphp
                <div class="product-one">
                    @for($i = 4; $i < 8 && $i < count($products); $i++)
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="{{ URL::to('products/' . $products[$i]->id) }}" class="mask"><img class="img-responsive zoom-img" src="{{$products[$i]->src_img_1}}" alt="" /></a>
                                <div class="product-bottom">
                                    <h3>{{$products[$i]->name}}</h3>
                                    <p>Explore Now</p>
                                    <h4><a class="item_add" href="#"><i></i></a> <span class=" item_price">$ {{$products[$i]->price}}</span></h4>
                                </div>
                                <div class="srch">
                                    <span>Get me!</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--about-starts-->
    <div class="about">
        <div class="container">
            <div class="about-top grid-1">
                @foreach(DB::table('grandcategories')->pluck('name', 'description') as  $description => $name )
                <div class="col-md-4 about-left">
                    <figure class="effect-bubba">
                        <img class="img-responsive" src="images/abt-1.jpg" alt=""/>
                        <figcaption>
                            <h2>{{$name}}</h2>
                            <p>{{$description}}</p>
                        </figcaption>
                    </figure>
                </div>
                @endforeach
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--about-end-->
@endsection
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
                    $products = DB::table('products')->inRandomOrder()->limit(8)->get();
                @endphp
                <div class="product-one">
                    @for($i = 0; $i < 4 && $i < count($products); $i++)
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="{{ URL::to('products/' . $products[$i]->id) }}" class="mask"><img class="img-responsive zoom-img" src="{{$products[$i]->src_img_1}}" alt="" /></a>
                                <div class="product-bottom" style="padding-left:30px; padding-right: 30px">
                                    <h3>{{$products[$i]->name}}</h3>
                                    <p>{{$products[$i]->category}}</p>

                                    {{Form::open(array('url' => 'add')) }}
                                    <h4><button type="submit" style="background-color: white; outline:none;" class="item_add" href="#"><i></i><span class=" item_price">$ {{$products[$i]->price}} ADD</span></button></h4>
                                    {{Form::hidden('id', $products[$i]->id)}}
                                    {{Form::close()}}
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
                <div class="product-one">
                    @for($i = 4; $i < 8 && $i < count($products); $i++)
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="{{ URL::to('products/' . $products[$i]->id) }}" class="mask"><img class="img-responsive zoom-img" src="{{$products[$i]->src_img_1}}" alt="" /></a>
                                <div class="product-bottom ">
                                    <h3>{{$products[$i]->name}}</h3>
                                    <p>{{$products[$i]->category}}</p>
                                    {{Form::open(array('url' => 'add')) }}
                                    <h4><button type="submit" style="background-color: white; outline:none;" class="item_add" href="#"><i></i><span class=" item_price">$ {{$products[$i]->price}} ADD</span></button></h4>
                                    {{Form::hidden('id', $products[$i]->id)}}
                                    {{Form::close()}}
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
        <script>
            $(document).ready(function(){
                $('.product-one').each(function(){
                    var highestBox = 0;
                    var highestBox2 = 0;
                    $('h3', this).each(function(){
                        if($(this).height() > highestBox) {
                            highestBox = $(this).height();
                        }
                    });
                    $('img', this).each(function(){
                        if($(this).height() > highestBox2) {
                            highestBox2 = $(this).height();
                        }
                    });
                    $('h3',this).height(highestBox);
                    $('img', this).each(function(){
                        $(this).css('margin-top', (highestBox2-$(this).height())/2);
                        $(this).css('margin-bottom', (highestBox2-$(this).height())/2);
                    });

                });
            });
        </script>

        <div class="about">
            <div class="container">
                <div class="about-top grid-1">
                    @php
                        $i = 0
                    @endphp
                    @foreach(DB::table('grandcategories')->limit(3)->pluck('name', 'description') as  $description => $name )
                        @php
                            $i++;
                        @endphp

                        <a href="/products?category_search=All&q={{$name}}">
                            <div class="col-md-4 about-left">
                                <figure class="effect-bubba">
                                    <img class="img-responsive" src="images/abt-{{$i}}.jpg" alt=""/>
                                    <figcaption>
                                        <h2>{{$name}}</h2>
                                        <p>{{$description}}</p>
                                    </figcaption>
                                </figure>
                            </div>
                        </a>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!--about-starts-->
    <!--about-end-->
@endsection
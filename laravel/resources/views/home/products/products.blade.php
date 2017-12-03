@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/products')}}">Products</a></li>
                    @php
                        $name = 'All Products';
                    @endphp
                    @isset($curr_item)
                        @php
                            $name=$curr_item;
                        @endphp
                    @endisset
                    <li class="active">{{$name}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--prdt-starts-->
    <div class="prdt">
        <div class="container">
            <div class="prdt-top">
                <div class="col-md-12 prdt-left">
                 @if($products->count() != 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach($products as $product)
                        @if($i%4 == 0)
                            <div class="product-one">
                        @endif
                                <div class="col-md-3 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="{{ URL::to('products/' . $product->id) }}" class="mask"><img class="img-responsive zoom-img" src="{{$product->src_img_1}}" alt="" /></a>
                                        <div class="product-bottom">
                                            <h3>{{$product->name}}</h3>
                                            <p>{{$product->category}}</p>
                                            {{Form::open(array('url' => 'add')) }}
                                            <h4><button type="submit" style="background-color: white; outline:none;" class="item_add" href="#"><i></i><span class=" item_price">$ {{$product->price}} ADD</span></button></h4>
                                            {{Form::hidden('id', $product->id)}}
                                            {{Form::close()}}
                                        </div>
                                        <div class="srch srch1">
                                            <span>Get me!</span>
                                        </div>
                                    </div>
                                </div>
                        @if(($i%4 == 3) || ($i == $products->count() - 1))
                            @for($j = 0; $j < (4 - $i % 4) - 1; $j++)
                                <div class="col-md-4 product-left p-left"></div>
                            @endfor
                            <div class="clearfix"></div>
                            </div>
                        @endif
                        @php
                            $i++;
                        @endphp
                    @endforeach
                @else
                     <h2>Sorry, no results were found for your search.</h2>
                @endif
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
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--product-end-->
@endsection
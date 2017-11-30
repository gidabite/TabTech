@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-ckeckout-->
    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>CHECKOUT</h2>
            </div>
            <div class="ckeckout-top">
                <div class="cart-items">
                    <h3>My Shopping Bag ({{$count}})</h3>
                    <script>$(document).ready(function(c) {
                            $('.close1').on('click', function(c){
                                $('.cart-header').fadeOut('slow', function(c){
                                    $('.cart-header').remove();
                                });
                            });
                        });
                    </script>
                    <script>$(document).ready(function(c) {
                            $('.close2').on('click', function(c){
                                $('.cart-header1').fadeOut('slow', function(c){
                                    $('.cart-header1').remove();
                                });
                            });
                        });
                    </script>
                    <script>$(document).ready(function(c) {
                            $('.close3').on('click', function(c){
                                $('.cart-header2').fadeOut('slow', function(c){
                                    $('.cart-header2').remove();
                                });
                            });
                        });
                    </script>

                    <div class="in-check" >
                        <ul class="unit">
                            <li><span>Item</span></li>
                            <li><span>Product Name</span></li>
                            <li><span>Unit Price</span></li>
                            <li><span>Count</span></li>
                            <li> </li>
                            <div class="clearfix"> </div>
                        </ul>
                        @foreach($items as $item)
                            @php
                                $product = Product::find($item->id);
                            @endphp
                        <ul class="cart-header">
                            <div class="close1"> </div>
                            <li class="ring-in"><a href="/products/{{$item->id}}" ><img style="margin:auto" src="{{$product->src_img_1}}" class="img-responsive" alt=""></a>
                            </li>
                            <li><span style="    padding: 20px;" class="name">{{$product->name}}</span></li>
                            <li><span style="    padding: 20px;" class="cost">${{$product->price}}</span></li>
                            <li><span class="cost"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>{{$item->qty}}</span>
                                <span class="cost">Amount: ${{$item->total/1.21}}</span>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-ckeckout-->
@endsection
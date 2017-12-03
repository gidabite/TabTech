@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li class="active">History</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-ckeckout-->
    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>HISTORY</h2>
            </div>
            <div class="ckeckout-top">
                <div class="cart-items">

                    @php
                        $total = 0;
                    @endphp
                    @foreach($orders as $items)
                        @php
                            $i = 0;
                        @endphp
                    <div class="in-check" >
                        <ul class="unit">
                            <li><span>Content</span></li>
                            <li><span>Price</span></li>
                            <li><span>Total Price</span></li>
                            <li><span>Address</span></li>
                            <li> </li>
                            <div class="clearfix"> </div>
                        </ul>
                        <div class="col-md-9 cart-header">
                            <ul class="">
                        @foreach(json_decode($items->content, true) as $key => $item)
                            @php
                                $i++;
                                $product = Product::find($item['id']);
                                if ($product === null){
                                   continue;
                                }
                            @endphp
                                    <div class="row">
                                        <a href="/products/{{$product->id}}">
                                            <div class="col-md-1" style="    padding: 10px;" >
                                                <img style = "width:100%" src="{{$product->src_img_1}}">
                                            </div></a>
                                        <div class="col-md-3" style="    padding: 20px;" class="name">{{$product->name}}</div>
                                        <div style="    padding: 20px;" class="col-md-4">${{$product->price}}x{{$item['qty']}}</div>
                                        <div  style="    padding: 20px;" class="col-md-4">${{$item['subtotal']   }}</div>
                                    </div>
                        @endforeach

                            </ul>
                        </div>
                        <div class="col-md-3 cart-header">
                            <div class="row" style="height: 100%">
                                <div class="col-md-12" style="height: 100%">{{$items->address}}<br>{{$items->created_at}}</div>
                            </div>
                        </div>
                        <ul class="unit" style="margin-top: 10px">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 text-center">
                                    <span style="    font-size: 1.4em;  margin-top: 1.4em;">Total: ${{$items->total}}</span>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </ul>

                    </div>

                    @endforeach

                    <script>
                        $(document).ready(function(){
                            $('.in-check').each(function(){
                                var highestBox = 0;
                                $('.cart-header', this).each(function(){
                                    if($(this).height() > highestBox) {
                                        highestBox = $(this).height();
                                    }
                                });
                                $('.cart-header',this).height(highestBox);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!--end-ckeckout-->
@endsection
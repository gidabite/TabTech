@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li>
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
                    <div class="in-check" >
                        <ul class="unit">
                            <li><span>Item</span></li>
                            <li><span>Product Name</span></li>
                            <li><span>Unit Price</span></li>
                            <li><span>Count</span></li>
                            <li> </li>
                            <div class="clearfix"> </div>
                        </ul>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($items as $item)
                            @php
                                $product = Product::find($item->id);
                            @endphp
                        <ul class="cart-header">
                            {{Form::open(array('url' => 'delete', 'style' => 'display: inline;')) }}
                            {{Form::hidden('id', $product->id)}}
                            <button type="submit" style = "background-color: transparent; outline: none; color: #3c9eff; " class="btn close1"><span style="margin: 0px; font-size: 1.5em;" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></button>
                            {{Form::close()}} </span>
                            <li class="ring-in"><a href="/products/{{$item->id}}" ><img style="margin:auto" src="{{$product->src_img_1}}" class="img-responsive" alt=""></a>
                            </li>
                            <li><span style="    padding: 20px;" class="name">{{$product->name}}</span></li>
                            <li><span style="    padding: 20px;" class="cost">${{$product->price}}</span></li>
                            <li style="width: auto">
                                <span class="cost">
                                    {{Form::open(array('url' => 'add', 'style' => 'display: inline;')) }}
                                        {{Form::hidden('id', $product->id)}}
                                        <button type="submit" style = "background-color: transparent; outline: none;"class="btn"><span style="margin: 0px;" class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></button>
                                    {{Form::close()}}
                                    {{$item->qty}}
                                    {{Form::open(array('url' => 'decrease', 'style' => 'display: inline;')) }}
                                        {{Form::hidden('id', $product->id)}}
                                        <button type="submit" style = "background-color: transparent; outline: none;"class="btn"><span style="margin: 0px;" class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></button>
                                    {{Form::close()}} </span>
                                <span class="cost">
                                    Amount: ${{$item->total/1.21}}
                                    @php
                                        $total += $item->total/1.21;
                                    @endphp
                                </span>
                            </li>
                            <div class="clearfix"> </div>
                        </ul>
                        @endforeach
                        <ul class="unit" style="margin-top: 10px">
                            <div class="row">
                                    <div class="col-md-4 col-md-offset-4 text-center">
                                        <span style="    font-size: 1.4em;  margin-top: 1.4em;">Total: ${{$total}}</span>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <a type="submit" href="/order" style = "outline: none;"class="add-cart item_add">Pay for the order</a>
                                    </div>
                                </div>
                            <div class="clearfix"> </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-ckeckout-->
@endsection
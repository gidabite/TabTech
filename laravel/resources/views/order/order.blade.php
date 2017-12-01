@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="/basket">basket</a></li>
                    <li class="active">Order</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--start-ckeckout-->
    <div class="ckeckout">
        <div class="container">
            <div class="ckeck-top heading">
                <h2>ORDER</h2>
            </div>
            <div class="ckeckout-top">
                <div class="col-md-12 account-left">
                    <form class="form-horizontal" method="POST" action="{{ route('pay') }}">
                        {{ csrf_field() }}
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <div class="list">{{Auth::user()->name}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Address</label>

                                <div class="col-md-9">
                                    <textarea id = "name" rows = "7" style="resize: none;" name = "address" placeholder="Address" type="email" tabindex="3" required>@if(old('address')!== null){{old('address')}}@else{{ Auth::user()->address}}@endif</textarea>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Cart Contents</label>

                                <div class="col-md-9">
                                    <div class="list">
                                            @php
                                                $total = 0;
                                                $i = 0
                                            @endphp
                                            @foreach($items as $item)
                                                @php
                                                    $i++;
                                                    $product = Product::find($item->id);
                                                @endphp
                                                <div class="row">
                                                    <div style="    padding: 20px;" class="col-md-1">{{$i.'.'}}</div><div class="col-md-4" style="    padding: 20px;" class="name">{{$product->name}}</div><div style="    padding: 20px;" class="col-md-4">${{$product->price}}x{{$item->qty}}</div><div  style="    padding: 20px;" class="col-md-3">Amoumt: ${{$item->total/1.21}}</div>
                                                </div>
                                                @php
                                                    $total += $item->total/1.21;
                                                @endphp
                                            @endforeach
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Total</label>
                                <div class="col-md-9">
                                    <div class="list text-center">${{$total}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label"></label>
                                <div class="col-md-8 address text-center">
                                    <button type="submit" class="">
                                        Pay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                        <ul class="unit" style="margin-top: 10px">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 text-center">
                                    <span style="    font-size: 1.4em;  margin-top: 1.4em;">Total: ${{$total}}</span>
                                </div>
                                <div class="col-md-4 text-center">
                                    {{Form::open(array('url' => 'order', 'style' => 'display: inline;')) }}
                                        <button type="submit" style = "outline: none;"class="add-cart item_add">Pay for the order</button>
                                    {{Form::close()}}
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
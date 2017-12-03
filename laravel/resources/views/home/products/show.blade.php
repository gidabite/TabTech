@extends('layouts.app')

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/products')}}">Products</a></li>
                    <li><a href="{{url('/products')}}?category_search={{$category}}">{{$category}}</a></li>
                    <li class="active">{{$name}}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="single contact">
        <div class="container">
            <div class="single-main">
                <div class="col-md-9 col-md-offset-1 single-main-left">
                    <div class="sngl-top">
                        <div class="col-md-5 single-top-left">
                            <div class="flexslider">
                                <ul class="slides">
                                    @if($src_img_1 != null)
                                        <li data-thumb="{{$src_img_1}}">
                                            <div class="thumb-image"> <img style ="" src="{{$src_img_1}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                        </li>
                                    @endif
                                    @if($src_img_2 != null)
                                        <li data-thumb="{{$src_img_2}}">
                                            <div class="thumb-image"> <img src="{{$src_img_2}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                        </li>
                                    @endif
                                        @if($src_img_3 != null)
                                            <li data-thumb="{{$src_img_3}}">
                                                <div class="thumb-image"> <img src="{{$src_img_3}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                            </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- FlexSlider -->
                            <script src="{{asset('js/imagezoom.js')}}"></script>
                            <script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
                            <link rel="stylesheet" href="{{asset('css/flexslider.css')}}" type="text/css" media="screen" />

                            <script>
                                // Can also be used with $(document).ready()
                                $(window).load(function() {
                                    $('.flexslider').flexslider({
                                        animation: "slide",
                                        controlNav: "thumbnails"
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-md-7 single-top-right">
                            <div class="single-para simpleCart_shelfItem">
                                <h2>{{$name}}</h2>
                                <div class="star-on">
                                    <ul class="star-footer">
                                        <li><a href="#"><i id='star1' onclick="update_review(1)" onmouseout="onMouseOutStars()" onmouseover="onMouseOverStars(1)" class="glyphicon glyphicon-star-empty"> </i></a></li>
                                        <li><a href="#"><i id='star2' onclick="update_review(2)" onmouseout="onMouseOutStars()" onmouseover="onMouseOverStars(2)" class="glyphicon glyphicon-star-empty"> </i></a></li>
                                        <li><a href="#"><i id='star3' onclick="update_review(3)" onmouseout="onMouseOutStars()" onmouseover="onMouseOverStars(3)" class="glyphicon glyphicon-star-empty"> </i></a></li>
                                        <li><a href="#"><i id='star4' onclick="update_review(4)" onmouseout="onMouseOutStars()" onmouseover="onMouseOverStars(4)" class="glyphicon glyphicon-star-empty"> </i></a></li>
                                        <li><a href="#"><i id='star5' onclick="update_review(5)" onmouseout="onMouseOutStars()" onmouseover="onMouseOverStars(5)" class="glyphicon glyphicon-star-empty"> </i></a></li>
                                        <input type="hidden" value="{{$id}}" name="id">
                                    </ul>
                                    <div class="review">
                                        <a href="#"> {{DB::table('reviews')->where('id_product', $id)->count()}} customer review.@guest @else You review: {{$stars}} @endguest</a>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="border-top-buttom">
                                    <div class="row">

                                        <div class="row form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                            <label style="margin-left: 20px;" for="category" class="col-md-5 control-label">
                                                <h5>
                                                    {{$price}}$
                                                </h5></label>
                                            <div class="col-md-6">
                                                {{Form::open(array('url' => 'add', 'style' => 'display: inline;')) }}
                                                {{Form::hidden('id', $id)}}
                                                <button type="submit" class="add-cart item_add">ADD TO CART</button>
                                                {{Form::close()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p>{{$description}}</p>
                                <div class="border-top-buttom">
                                    <h5>Characteristics</h5>
                                </div>
                                <div id="characteristics">
                                    @php
                                        $category = json_decode(Category::where('name', $category)->first()->json_characteristics);
                                        $i = 0;
                                    @endphp
                                    @foreach($characteristics as $key => $char)
                                        <div class="row form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                            <label for="category" class="col-md-4 control-label">@if(!is_array($category[$i])) {{$category[$i]}} @else {{$category[$i][0]}} @endif</label>
                                            <div class="col-md-8">
                                                {{$char}}
                                            </div>
                                        </div>
                                        @php
                                            $i++
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <script>
        var stars = {{$stars}};
        $(document).ready(function () {
            onMouseOutStars();
        })
        function onMouseOverStars(i){
            $('.star-footer li a i').attr('class', 'glyphicon glyphicon-star-empty');
            $('.star-footer li:nth-child(-n+'+i+') a i').attr('class', 'glyphicon glyphicon-star');
        }
        function onMouseOutStars() {
            $('.star-footer li a i').attr('class', 'glyphicon glyphicon-star-empty');
            $('.star-footer li:nth-child(-n+'+stars+') a i').attr('class', 'glyphicon glyphicon-star');
        }
        function update_review(i){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'{{route('ajaxstars')}}',
                data:{'_token':'{{csrf_token()}}', 'stars':i, 'id':$('input[name=id]').val()},
                success:function(data){
                    stars = data.msg;
                    $('.review a').html(data.count);
                    onMouseOutStars();
                }
            });
        }
    </script>
@endsection
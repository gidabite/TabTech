@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        $(function() {

            var menu_ul = $('.menu_drop > li > ul'),
                menu_a  = $('.menu_drop > li > a');

            menu_ul.hide();

            menu_a.click(function(e) {
                e.preventDefault();
                if(!$(this).hasClass('active')) {
                    menu_a.removeClass('active');
                    menu_ul.filter(':visible').slideUp('normal');
                    $(this).addClass('active').next().stop(true,true).slideDown('normal');
                } else {
                    $(this).removeClass('active');
                    $(this).next().stop(true,true).slideUp('normal');
                }
            });

        });
    </script>
    {{ Form::open(array('route' => array('products.update', $id), 'method' => 'PUT', 'files' => true)) }}

    <div class="single contact">
        <div class="container">
            <div class="single-main">
                <div class="col-md-9 col-md-offset-1 single-main-left">
                    <div class="row">
                        {{ Form::submit('Update product', array('class' => 'btn btn-primary')) }}
                    </div>
                    <div class="sngl-top">
                        <div class="col-md-5 single-top-left">
                            <div class="flexslider">
                                <ul class="slides">
                                    <li data-thumb="{{$src_img_1}}">
                                        <div class="thumb-image"> <img src="{{$src_img_1}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                    </li>
                                    <li data-thumb="{{$src_img_2}}">
                                        <div class="thumb-image"> <img src="{{$src_img_2}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                    </li>
                                    <li data-thumb="{{$src_img_3}}">
                                        <div class="thumb-image"> <img src="{{$src_img_3}}" data-imagezoom="true" class="img-responsive" alt=""/> </div>
                                    </li>
                                </ul>
                            </div>
                            <div id="upload_img">
                                <div class="row form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                    <label for="image1" class="col-md-3 control-label">Image 1</label>
                                    <div class="col-md-9">
                                        {{Form::file('image1', array('onChange' => 'upload("1",this.value);'))}}
                                        @if ($errors->has('image1'))
                                            @foreach ($errors->get('image1') as $message)
                                            <span class="help-block has-error">
                                                <strong class="{{ $errors->has('image1') ? ' text-danger' : '' }}">{{ $message }}</strong>
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                    <label for="category" class="col-md-3 control-label">Image 2</label>
                                    <div class="col-md-9">
                                        {{Form::file('image2', array('onChange' => 'upload("2",this.value);'))}}
                                        @if ($errors->has('image2'))
                                            @foreach ($errors->get('image2') as $message)
                                                <span class="help-block has-error">
                                                <strong class="{{ $errors->has('image2') ? ' text-danger' : '' }}">{{ $message }}</strong>
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="margin-bottom: 0px; margin-top: 10px;">
                                    <label for="category" class="col-md-3 control-label">Image 3</label>
                                    <div class="col-md-9">
                                        {{Form::file('image3', array('onChange' => 'upload("3",this.value);'))}}
                                        @if ($errors->has('image3'))
                                            @foreach ($errors->get('image3') as $message)
                                                <span class="help-block has-error">
                                                <strong class="{{ $errors->has('image3') ? ' text-danger' : '' }}">{{ $message }}</strong>
                                            </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
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
                                <h2>{{Form::text('name', $name, array('value' => old('name'), 'class' => 'form-control', 'aria-describedby' => 'name-category', 'placeholder' => 'Enter product name', 'required'))}}</h2>
                                @if ($errors->has('name'))
                                    <span class="help-block has-error">
                                        <strong class="{{ $errors->has('name') ? ' text-danger' : '' }}">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <div class="star-on">
                                    <ul class="star-footer">
                                        <li><a href="#"><i> </i></a></li>
                                        <li><a href="#"><i> </i></a></li>
                                        <li><a href="#"><i> </i></a></li>
                                        <li><a href="#"><i> </i></a></li>
                                        <li><a href="#"><i> </i></a></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#"> 1 customer review </a>

                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="border-top-buttom">
                                    <div class="row">
                                        <h5>
                                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}" style="margin-bottom: 0px;">

                                                <label for="price" class="col-md-1 control-label">$</label>
                                                <div class="col-md-4">
                                                    {{Form::text('price', $price, array('value' => old('price'), 'class' => 'form-control col-md-4', 'aria-describedby' => 'price', 'placeholder' => 'Enter price', 'required'))}}
                                                </div>
                                            </div>
                                        </h5>
                                        <a href="#" class="col-md-4 add-cart item_add text-center">ADD TO CART</a>
                                        @if ($errors->has('price'))
                                            <br>
                                            <span class="help-block has-error">
                                                <strong class="{{ $errors->has('price') ? ' text-danger' : '' }}">{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <p>{{Form::textarea('description', $description, array('value' => old('description'), 'style' => 'margin-bottom: 10px', 'class' => 'form-control col-md-4', 'aria-describedby' => 'description', 'placeholder' => 'Enter description', 'required'))}}</p>
                                @if ($errors->has('description'))
                                    <br>
                                    <span class="help-block has-error">
                                                <strong class="{{ $errors->has('description') ? ' text-danger' : '' }}">{{ $errors->first('description') }}</strong>
                                            </span>
                                @endif
                                <div class="border-top-buttom">
                                    <h5>Characteristics</h5>
                                </div>
                                <div class="row form-group{{ $errors->has('category') ? ' has-error' : '' }}" style="margin-bottom: 0px; margin-top: 10px;">
                                    <label for="category" class="col-md-2 control-label">Category</label>
                                    <div class="col-md-8">
                                        @php
                                            $categories = DB::table('categories')->where('name' ,'!=', 'All')->pluck ('name');
                                            $assoc = array_combine($categories->toArray(),$categories->toArray());
                                        @endphp
                                        {{Form::select('category', $assoc, $category, array('placeholder' => 'Please select a category','onChange' => 'update_categoty()','class' => 'form-control ','aria-describedby' => 'category', 'required'))}}
                                        @if ($errors->has('category'))
                                            <br>
                                            <span class="help-block has-error">
                                                <strong class="{{ $errors->has('category') ? ' text-danger' : '' }}">{{ $errors->first('category') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="characteristics">
                                    @if($category != null)
                                        @php
                                            $category = Category::where('name', $category)->first();
                                        @endphp
                                        @if($category != null)
                                            @foreach(json_decode($category->json_characteristics) as $key => $char)
                                                <div class="row form-group{{ $errors->has('char'.$key) ? ' has-error' : '' }}" style="margin-bottom: 0px; margin-top: 10px;">
                                                    <label for="category" class="col-md-4 control-label">@if(!is_array($char)) {{$char}} @else {{$char[0]}} @endif</label>
                                                    <div class="col-md-6">
                                                        @if(!is_array($char))
                                                            <input value = "{{($characteristics->{'char'.$key})}}" class="form-control" aria-describedby="sizing-addon2" placeholder="Text" name=char{{$key}} type="text">
                                                        @else
                                                            {{Form::select('char'.$key, array_combine($char[1], $char[1]), $characteristics->{'char'.$key}, array('placeholder' => 'Please select a '.$char[0],'class' => 'form-control ','aria-describedby' => 'category', 'required'))}}
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif
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
    {{ Form::close() }}
    <script>
        function update_categoty(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'{{route('ajax')}}',
                data:{'_token':'{{csrf_token()}}', 'name':$("select[name=category]").val()},
                success:function(data){
                    $("#characteristics").html(data.msg);
                }
            });
        }
        function upload(name, path) {
            //$(".flexslider ol li:nth-child("+name+") img").attr('src',path)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var $input = $("input[name=image"+ name +"]");
            var fd = new FormData;

            fd.append('img', $input.prop('files')[0]);

            $.ajax({
                url: '{{route('ajaxImage')}}',
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    var src1 = $(".flexslider ol li:nth-child(1) img").attr('src');
                    var src2 = $(".flexslider ol li:nth-child(2) img").attr('src');
                    var src3 = $(".flexslider ol li:nth-child(3) img").attr('src');


                    var html =  '<ul class="slides">' +
                        '   <li data-thumb="' + src1 + '">' +
                        '       <div class="thumb-image"> <img src="' + src1 + '" data-imagezoom="true" class="img-responsive" alt=""/> </div>' +
                        '    </li>' +
                        '   <li data-thumb="' + src2 + '">' +
                        '       <div class="thumb-image"> <img src="' + src2 + '" data-imagezoom="true" class="img-responsive" alt=""/> </div>' +
                        '    </li>' +
                        '   <li data-thumb="' + src3 + '">' +
                        '       <div class="thumb-image"> <img src="' + src3 + '" data-imagezoom="true" class="img-responsive" alt=""/> </div>' +
                        '    </li>' +
                        '</ul>';
                    $(".flexslider").html(html);
                    $(".flexslider ul li:nth-child("+name+") div img").attr('src',data.msg);
                    $(".flexslider ul li:nth-child("+name+")").attr('data-thumb',data.msg);
                    $('.flexslider').removeData("flexslider");
                    $('.flexslider').flexslider({
                        animation: "slide",
                        controlNav: "thumbnails"
                    });

                }
            });
        }
    </script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container" onLoad="upd()">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <div class="row">
                            <div class="col-lg-2"><a href="{{URL::to('home')}}" class="pull-left btn btn-sm">Back to home</a>
                            </div>
                            <span class="col-lg-4 col-lg-offset-2">
                                Category #{{$id}}
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('route' => array('categories.update', $id), 'method' => 'PUT')) }}
                        <div class="input-group">
                            <span class="input-group-addon" id="name-category">Category name</span>
                            {{Form::text('name', $name, array('class' => 'form-control', 'aria-describedby' => 'name-category', 'readonly'))}}
                        </div>
                        <hr>
                        <h4>Characteristics</h4>
                        <div id="characteristics">
                            @foreach($characteristics as $key => $char)
                                        <div class="row">
                                            <div class="col-lg-8 col-lg-offset-2">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="min-width: 200px;"id="sizing-addon2">@if(!is_array($char)) {{$char}} @else {{$char[0]}} @endif</span>
                                                    @if(!is_array($char))
                                                        <input class="form-control" aria-describedby="sizing-addon2" placeholder="Text" name="char{{$key}}" type="text">
                                                    @else
                                                        <select id="select{{$key}}" aria-describedby="sizing-addon2" name="select{{$key}}" class="form-control">
                                                            @foreach($char[1] as $key2 => $elem)

                                                                <option value="{{$key2}}">{{$elem}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                    </div>
                                            </div>
                                        </div>
                                        <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <div class="row">
                            <div class="col-lg-2"><a href="{{URL::to('home')}}" class="pull-left btn btn-sm">Back to home</a>
                            </div>
                            <span class="col-lg-4 col-lg-offset-2">
                                New Category
                            </span>
                        </div>

                    </div>
                    <div class="panel-body">
                        {{ Form::open(array('url' => 'grandcategories', 'class' => "form-horizontal")) }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-6">
                                    {{Form::text('name', null, array('class' => 'form-control', 'aria-describedby' => 'name-category', 'placeholder' => 'Enter category name', 'required'))}}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Description</label>
                                <div class="col-md-6">
                                    {{Form::textarea('description', null, array('class' => 'form-control', 'aria-describedby' => 'name-category', 'placeholder' => 'Enter category description', 'required'))}}

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                            {{ Form::submit('Create', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <!--start-breadcrumbs-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-main">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end-breadcrumbs-->
    <!--contact-start-->
    <div class="contact" style="padding: 84px">
        <div class="container">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            <div class="contact-top heading">
                <h2>YOUR ACCOUNT</h2>
            </div>
            <div class="contact-text">
                <div class="col-md-6 col-md-offset-3 account-left">
                    <form class="form-horizontal" method="POST" action="{{ route('update') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input id = "name" name="name" placeholder="Name" type="text" tabindex="1" value = "@if(old('name')!== null){{old('name')}}@else{{ Auth::user()->name}}@endif" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Address</label>

                                <div class="col-md-9">
                                    <textarea id = "name" rows = "7" style="resize: none;" name = "address" placeholder="Address" type="email" tabindex="3">@if(old('address')!== null){{old('address')}}@else{{ Auth::user()->address}}@endif</textarea>

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="address col-md-offset-3 col-md-4">
                                <button type="submit" class="">
                                    Update
                                </button>
                            </div>
                            <div class="address col-md-5">
                                <input type="submit" form = updpass value="Change password">
                            </div>
                        </div>
                    </form>

                    <form class="form-horizontal" method="POST" id = 'updpass' action="{{ route('secret') }}">
                        {{ csrf_field() }}
                        {{Form::hidden('email', Auth::user()->email)}}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--contact-end-->
@endsection
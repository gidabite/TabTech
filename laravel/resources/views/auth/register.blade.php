@extends('layouts.app')

@section('content')
    <div class="register">
        <div class="container">
            <div class="register-top heading">
                <h2>REGISTER</h2>
            </div>
            <div class="register-main">
                <div class="col-md-6 col-md-offset-3 account-left">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input id = "name" name="name" placeholder="Name" type="text" tabindex="1" value = "{{old('name')}}" required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Email</label>

                                <div class="col-md-9">
                                    <input id = "name" name = "email" placeholder="Email address" type="email" tabindex="3" value = "{{old('email')}}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Password</label>

                                <div class="col-md-9">
                                    <input id = "name" placeholder="Password" name="password" type="password" tabindex="3" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="name" class="col-md-3 control-label">Confirm Password</label>

                                <div class="col-md-9">
                                    <input id = "name" placeholder="Confirm Password" name="password_confirmation" type="password" tabindex="3" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('secret_question') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="password" class="col-md-3 control-label">Secret Question</label>

                                <div class="col-md-9">
                                    <input id="password" placeholder="Secret Question" type="text" class="" name="secret_question" value = "{{old('secret_question')}}" required>

                                    @if ($errors->has('secret_question'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('secret_question') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}" style="margin-bottom: 0px;">
                            <div class="row">
                                <label for="password" class="col-md-3 control-label">Answer</label>

                                <div class="col-md-9">
                                    <input id="password" placeholder="Answer"  type="text" class="" name="answer" value = "{{old('answer')}}" required>

                                    @if ($errors->has('answe'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('answe') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="address col-md-offset-5 col-md-4">
                                <button type="submit" class="">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection

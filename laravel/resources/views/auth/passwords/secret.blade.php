@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('check') }}">
                            {{ csrf_field() }}
                            {{Form::hidden('token_check', $token)}}
                            <div class="form-group{{ $errors->has('secret-question') ? ' has-error' : '' }}">
                                <label for="secret-question" class="col-md-4 control-label">Secret Question</label>
                                <div class="col-md-6">
                                    <span id="secret-question" type="text">{{$question}}</span>
                                    @if ($errors->has('secret-question'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('secret-question') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                <label for="answer" class="col-md-4 control-label">Answer</label>
                                <div class="col-md-6">
                                    <input id="answer" type="text" class="form-control" name="answer" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Check Secret Question
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

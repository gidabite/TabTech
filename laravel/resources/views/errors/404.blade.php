@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-5">
            <h2>YOU SHALL NOT PASS!</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <video width="600" height="400" autoplay loop>
                <source src="{{asset('/video/ysnp.mp4')}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
            </video>
        </div>
    </div>
@endsection
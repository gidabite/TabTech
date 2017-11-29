@extends('layouts.app')

@section('content')
    <video width="320" height="240" controls>
        <source src="{{asset('/video/ysnp.mp4')}}" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
@endsection
@extends('admin.layout')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('carousel.name') !!}
    </p>
@stop

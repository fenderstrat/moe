@extends('admin.layout')

@section('title', __('carousel::carousel.index.title'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{  __('carousel::carousel.index.title') }}</h1>
    <div class="row">
        <div class="col-md-8">
            {!! Table::model($carousels)->name('carousel')->show('title', 'image')->render() !!}
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{  __('carousel::carousel.add.title') }}
                </div>
                <div class="card-body">
                        {!! Form::open(['route'=>'admin.carousel.store', 'class'=>'form-horizontal']) !!}
                            @include('carousel::admin.__form')
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

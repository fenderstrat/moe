@extends('admin.layout')

@section('title', __('carousel::carousel.add.title'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{  __('carousel::carousel.add.title') }}</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{  __('carousel::carousel.add.title') }}
                </div>
                <div class="card-body">
                    {{ Form::model($carousel, ['route' => 'admin.carousel.save', 'class' => 'form-horizontal']) }}
                        {!! Form::hidden('language', $carousel->language) !!}
                        {!! Form::hidden('carousel_id', $carousel->id) !!}
                        @include('carousel::admin.__form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

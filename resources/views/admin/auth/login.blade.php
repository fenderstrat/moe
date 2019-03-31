@extends('admin.auth.layout')
@section('content')
<div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ __('auth.login.greeting') }}</h1>
                </div>
                {!! Form::open()->method('post')->route('login') !!}
                    {!! Form::text('email', __('auth.login.email.label'))->type('email')->placeholder(__('auth.login.email.placeholder')) !!}
                    {!! Form::text('password', __('auth.login.password.label'))->type('password')->placeholder(__('auth.login.password.placeholder')) !!}
                    {!! Form::submit( __('auth.login.submit'))->attrs(['class'=>' btn-block'])->primary()->lg() !!}
                {!! Form::close() !!}
                <hr>
                {{-- <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection

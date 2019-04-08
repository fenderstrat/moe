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
                {!! Form::open(['route'=>'login', 'class'=>'user']) !!}
                    <div class="form-group">
                        {!! Form::email('email', old('email'), ['placeholder'=> __('auth.login.email.placeholder'), 'class'=>'form-control form-control-user']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::password('password', ['placeholder'=> __('auth.login.password.placeholder'), 'class'=>'form-control form-control-user']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit( __('auth.login.submit'), ['class'=>'btn btn-primary btn-user btn-block']) !!}
                    </div>
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

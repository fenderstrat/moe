{{-- title --}}
<div class="form-group">
    {!! Form::label('title', __('carousel::form.label.title'), ['class' => 'control-label']) !!}
    {!! Form::text('title',old('title'), ['placeholder' => __('carousel::form.placeholder.title'), 'class' => 'form-control']) !!}
    @if ($errors->has('title'))
        <div class="help-block text-danger">{{ $errors->first('title') }}</div>
    @endif
</div>

{{-- url --}}
<div class="form-group">
    {!! Form::label('url', __('carousel::form.label.url'), ['class' => 'control-label']) !!}
    {!! Form::text('url', old('url'), ['placeholder' => __('carousel::form.placeholder.url'), 'class' => 'form-control']) !!}
    @if ($errors->has('url'))
        <div class="help-block text-danger">{{ $errors->first('url') }}</div>
    @endif
</div>

{{-- description --}}
<div class="form-group">
    {!! Form::label('description', __('carousel::form.label.description'), ['class' => 'control-label']) !!}
    {!! Form::textarea('description',old('description'), ['placeholder' => __('carousel::form.placeholder.description'), 'class' => 'form-control', 'rows' => 3]) !!}
    @if ($errors->has('description'))
        <div class="help-block text-danger">{{ $errors->first('description') }}</div>
    @endif
</div>

{{-- image --}}
@if (request()->route()->getName() !== 'admin.carousel.add')
    <div class="form-group">
        {!! Form::label('image', __('carousel::form.label.image'), ['class' => 'control-label']) !!}
        <div class="input-group">
            {!! Form::text('image', old('image'), ['placeholder' => __('carousel::form.placeholder.image'), 'class' => 'form-control']) !!}
            <div class="input-group-append">
                {!! Form::button('<i class="fa fa-upload"></i>', ['class' => 'btn btn-light', 'id' => 'button-image']) !!}
            </div>
        </div>
        @if ($errors->has('image'))
            <div class="help-block text-danger">{{ $errors->first('image') }}</div>
        @endif
    </div>
@endif

{{-- submit --}}
<div class="form-group pull-right">
    {!! Form::submit(__('carousel::form.label.submit'), ['class' => 'btn btn-primary btn-lg btn-block']) !!}
</div>

{{-- css --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

{{-- js --}}
@push('js')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('button-image').addEventListener('click', (event) => {
                event.preventDefault();
                window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
            });
        });

        function fmSetLink($url) {
            document.getElementById('image').value = $url;
        }
    </script>

@endpush
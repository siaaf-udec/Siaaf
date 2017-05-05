<div class="form-group form-md-radios">
    <label for="form_control">{{ $label }}</label>

    {!! $input !!}

    @if ( !empty($errors) )
        @foreach ($errors as $error)
            <span class="help-block help-block-error">{{ $error }}</span>
        @endforeach
    @endif
</div>
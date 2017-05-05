<div {!! Html::classes(['form-group form-md-line-input', 'has-error' => $hasErrors]) !!}>
    <div class="input-icon">
        {!! $input !!}
        {{ Form::label($id, $label, ['class' => 'control-label']) }}
        @if (!empty($errors))
            @foreach ($errors as $error)
                <span id="{{ $id }}-error" class="help-block help-block-error">{{ $error }}</span>
            @endforeach
        @endif
        <span class="help-block">{{ $help }}</span>
        <i class="{{ $icon }}"></i>
    </div>
</div>
<div {!! Html::classes(['form-group form-md-line-input', 'has-error' => $hasErrors]) !!}>
    <div class="input-icon">
        {{ Form::label($id, $label, ['class' => 'control-label']) }}
        {!! $input !!}
        @if (!empty($errors))
            @foreach ($errors as $error)
                <span id="{{ $id }}-error" class="help-block help-block-error">{{ $error }}</span>
            @endforeach
        @endif
        <span class="help-block">@if(isset($help) || !empty($help)) {{ $help }} @endif</span>
    </div>
</div>
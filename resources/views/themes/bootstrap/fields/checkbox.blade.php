<div {!! Html::classes(['form-group form-md-checkboxes', 'has-error' => $hasErrors]) !!}>
    <div class="md-checkbox-inline">
        <div class="md-checkbox">

            {!! $input !!}

            <label for="{{ $id }}">
                <span></span>
                <span class="check"></span>
                <span class="box"></span> {{ $label }}
            </label>

            @if (!empty($errors))
                @foreach ($errors as $error)
                    <span id="{{ $id }}-error" class="help-block help-block-error">{{ $error }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>
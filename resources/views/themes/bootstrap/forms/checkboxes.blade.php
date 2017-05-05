<div class="md-checkbox-list">
    @foreach($checkboxes as $checkbox)
        <div class="md-checkbox">
            {!! Form::checkbox(
                $checkbox['name'],
                $checkbox['value'],
                $checkbox['checked'],
                ['id' => $checkbox['id'], 'class' => 'md-check']
            ) !!}
            <label for="{{ $checkbox['id'] }}">
                <span></span>
                <span class="check"></span>
                <span class="box"></span> {{ $checkbox['label'] }}
            </label>
        </div>
    @endforeach
</div>
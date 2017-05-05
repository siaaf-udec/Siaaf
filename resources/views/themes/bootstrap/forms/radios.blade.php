 <div class="md-radio-list">
    @foreach($radios as $radio)
        <div class="md-radio">
            {!! Form::radio(
                    $radio['name'],
                    $radio['value'],
                    $radio['selected'],
                    ['id' => $radio['id']]) !!}
            <label for="{{ $radio['id'] }}">
                <span></span>
                <span class="check"></span>
                <span class="box"></span> {{ $radio['label'] }} </label>
        </div>
    @endforeach
</div>
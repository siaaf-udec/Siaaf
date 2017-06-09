<table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="{{ $id }}">
    <thead>
    <tr>
        @forelse($columns as $key => $column)
            @php
                $props = '';
                $col = '';
            @endphp

            @if (is_array($column))
                @php $col = $key; @endphp

                @foreach($column as $k => $v)
                    @php
                        $props .= $k.'="'.$v.'"';
                    @endphp
                @endforeach
            @else
                @php $col = $column; @endphp
            @endif
            <th {{ $props }}>{{ $col }}</th>
        @empty
            <th>Sin datos</th>
        @endforelse
    </tr>
    </thead>
    <tfoot>
    <tr>
        @forelse($columns as $key => $column)
            @php
                $props = '';
                $col = '';
            @endphp

            @if (is_array($column))
                @php $col = $key; @endphp

                @foreach($column as $k => $v)
                    @php
                        $props .= $k.'="'.$v.'"';
                    @endphp
                @endforeach
            @else
                @php $col = $column; @endphp
            @endif
            <th {{ $props }}>{{ $col }}</th>
        @empty
            <th>Sin datos</th>
        @endforelse
    </tr>
    </tfoot>
</table>
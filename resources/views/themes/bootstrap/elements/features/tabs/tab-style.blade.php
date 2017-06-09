<div class="portlet-body">
    <div class="tabbable-line">
        <ul class="nav nav-tabs ">
            @foreach ($nav as $key => $value)
                @php
                    $cont =  count($value);
                    $temp = '';
                @endphp
                @switch( $cont )
                    @case( 1 )
                        <li>
                            <a href="#{{ $key }}" data-toggle="tab"> {{ $value[0] }} </a>
                        </li>
                        @breakswitch
                    @case( 2 )
                        <li class="@if(isset($value[1]['class'])){{ $value[1]['class'] }}@endif">
                            <a href="#{{ $key }}" data-toggle="tab"> {{ $value[0] }} </a>
                        </li>
                        @breakswitch
                    @default

                        @breakswitch
                @endswitch

            @endforeach

        </ul>
        {{$slot}}

    </div>
</div>


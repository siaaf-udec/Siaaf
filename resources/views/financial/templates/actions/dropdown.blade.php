<div class="btn-group pull-right">
    <button class="btn green btn-xs btn-outline dropdown-toggle" type="button" data-toggle="dropdown"> {{ __('financial.buttons.actions') }}
        <i class="fa fa-angle-down"></i>
    </button>
    <ul class="dropdown-menu pull-right" role="menu">
        @if( isset( $actions ) )
            @forelse( $actions as $action )
                <li>
                    {!! $action !!}
                </li>
                @empty
            @endforelse
        @endif
    </ul>
</div>
<div class="clearfix margin-bottom-5"> </div>
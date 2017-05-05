<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-3">
        <ul class="nav nav-tabs tabs-left">
            @foreach($tabs as $key => $tab)
                @if(empty($tab['submenu']))
                    <li class="@if($tab === reset($tabs)) {{ 'active' }} @else {{ 'fade' }} @endif">
                        <a href="#{{ $key }}" data-toggle="tab"> {{ $tab['title'] }} </a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            {{ $tab['title'] }}
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($tab['submenu'] as  $id => $submenu)
                                <li>
                                    <a href="#{{ $id }}" tabindex="-1" data-toggle="tab"> {{ $submenu['title'] }} </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-9">
        <div class="tab-content">
            @foreach($datas as $key => $data)
                <div class="tab-pane @if($data === reset($datas)) {{ 'active' }} @else {{ 'fade' }} @endif" id="{{ $key }}">
                    {{ $data['text'] }}
                </div>
            @endforeach
        </div>
    </div>
</div>
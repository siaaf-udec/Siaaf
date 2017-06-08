<ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true"
    data-slide-speed="200">
    @foreach ($items as $item)
        @php($i = "")
        @php($t = "")
        @if(!empty($item['submenu']))
            @foreach($item['submenu'] as $class)
                @if($class['class'] == 'start active open dropdown')
                    @php($i = "start active open")
                    @php($t = "open")
                @endif
            @endforeach
        @endif

        <li @if ($item['class'])
            class="nav-item {{ $i.' '.$item['class'] }}"
            @else class="nav-item"
            @endif id="menu_{{ $item['id'] }}">

            @if (empty($item['submenu']))
                <a href="{{ $item['url'] }}" class="nav-link">
                    <i class="{{ $item['icon'] }}"></i>
                    <span class="title">{{ $item['title'] }}</span>
                </a>
            @else
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="{{ $item['icon'] }}"></i>
                    <span class="title">{{ $item['title'] }}</span>
                    <span class="arrow @if ($item['class']) {{ $t.' '.$item['class'] }} @endif "></span>
                </a>
                <ul class="sub-menu">
                    @foreach ($item['submenu'] as $subitem)
                        @if (empty($subitem['submenu']))
                            <li @if ($subitem['class']) class="nav-item {{ $subitem['class'] }}"
                                @else class="nav-item" @endif">
                        <a href="{{ $subitem['url'] }}" class="nav-link">
                            <i class="{{ $subitem['icon'] }}"></i>
                            <span class="title">{{ $subitem['title'] }}</span>
                            @if ($subitem['class'])
                                <span class="selected"></span>
                            @endif
                        </a>
                        </li>
                        @else
                            <li @if ($subitem['class']) class="nav-item {{ $subitem['class'] }}"
                                @else class="nav-item" @endif">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="{{ $subitem['icon'] }}"></i>
                            <span class="title">{{ $subitem['title'] }}</span>
                            <span class="arrow @if ($subitem['class']) {{ $subitem['class'] }} @endif"></span>
                        </a>
                        <ul class="sub-menu">
                            @foreach($subitem['submenu'] as $thirdlevel)
                                <li @if ($thirdlevel['class']) class="nav-item {{ $thirdlevel['class'] }}"
                                    @else class="nav-item" @endif">
                                <a href="{{ $thirdlevel['url'] }}" class="nav-link">
                                    <i class="{{ $thirdlevel['icon'] }}"></i> {{ $thirdlevel['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                        </li>
                        @endif
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>

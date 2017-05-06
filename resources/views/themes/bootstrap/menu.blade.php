<ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true"
    data-slide-speed="200">
    @foreach ($items as $item)
        <li @if ($item['class']) class="nav-item {{ $item['class'] }}" @else class="nav-item"
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
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    @foreach ($item['submenu'] as $subitem)
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
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="javascript:;">Home</a>
            <i class="fa fa-angle-right"></i>
        </li>
        @for($i = 0; $i <= count(Request::segments()); $i++)
            <li>
                <a href="">{{ ucfirst( Request::segment($i) ) }}</a>
                @if($i < count(Request::segments()) & $i > 0)
                    <i class="fa fa-angle-right"></i>
                @endif
            </li>
        @endfor
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> Actions
                <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="javascript:;"><i class="icon-bell"></i> Acción</a>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-shield"></i> Otra action</a>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-user"></i> Algo más</a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="javascript:;"><i class="icon-bag"></i> Link separado</a>
                </li>
            </ul>
        </div>
    </div>
</div>
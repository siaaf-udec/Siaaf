<li class="nav-item {{ active(['access-control.*','roles.permissions.index'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-pencil-square-o"></i>
        <span class="title">Autoevaluacion</span>
        <span class="arrow {{ active(['autoevaluation.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        @permission('SUPERADMIN_MODULE')
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-screen-desktop "></i>
                <span class="title">Superadmin</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
        </li>
        @endpermission
        @permission(['PRIMARY_SOURCE_MODULE', 'SUPERADMIN_MODULE'])
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class=" icon-notebook "></i>
                <span class="title">Fuentes Primarias</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
        </li>
        @endpermission
        @permission(['SECONDARY_SOURCES_MODULE' , 'SUPERADMIN_MODULE'])
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-paper-clip "></i>
                <span class="title">Secundarias</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route("autoevaluation.documental.dependencia.index") }}"  class="nav-link nav-toggle">

                        <span class="title">Dependencias</span>
                    </a>
                </li>
            </ul>
        </li>
        @endpermission
    </ul>
</li>
=======
@permission('AUTOEVALUACION')
<li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-lock"></i>
            <span class="title">Autoevaluacion</span>
            <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
        </a>
        <ul class="sub-menu">
                <li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
                    <a href="{{ route('autoevaluacion.cna.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-lock"></i>
                        <span class="title">CNA</span>
                        <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item {{ active(['autoevaluacion.cna.index'], 'start active open') }}">
                            <a href="{{ route('autoevaluacion.cna.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-lock"></i>
                                <span class="title">Factor</span>
                                <span class="arrow {{ active(['access-control.*'], 'open') }}"></span>
                            </a>
                        </li>
                 </ul> 
                </li>
         </ul>       
</li>
@endpermission
>>>>>>> Stashed changes

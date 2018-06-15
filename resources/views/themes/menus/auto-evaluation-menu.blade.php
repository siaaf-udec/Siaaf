<li class="nav-item {{ active(['access-control.*','roles.permissions.index'], 'start active open') }}">

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

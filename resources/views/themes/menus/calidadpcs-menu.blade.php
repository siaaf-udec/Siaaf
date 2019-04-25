{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['calidadpcs.proyectosCalidad.*'], 'start active open') }}">
    <a href="{{ route('calidadpcs.proyectosCalidad.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-server"></i>
        <span class="title">Calidad PCS</span>
        <span class="arrow {{ active(['calidadpcs.proyectosCalidad.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">

        @permission('ADMIN_CALIDADPCS')
        <!--li class="nav-item {{ active(['calidadpcs.usuariosCalidadPcs.*'], 'start active open') }}">        
            <a href="{{ route('calidadpcs.usuariosCalidadPcs.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Usuarios</span>
            </a>        
        </li-->

        <li class="nav-item {{ active(['calidadpcs.proyectosCalidad.*'], 'start active open') }}">        
            <a href="{{ route('calidadpcs.proyectosCalidad.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-server"></i>
                <span class="title">Proyectos</span>
            </a>        
        </li>
    	@endpermission
        <!--
        <li class="nav-item {{ active(['parqueadero.correosCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueadero.correosCarpark.cerrarParqueadero') }}" class="nav-link nav-toggle">
                <i class="fa fa-bolt"></i>
                <span class="title">Etapa Ejecución</span>
            </a>        
        </li>
        </li><li class="nav-item {{ active(['parqueadero.correosCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueadero.correosCarpark.cerrarParqueadero') }}" class="nav-link nav-toggle">
                <i class="fa fa-video-camera"></i>
                <span class="title">Etapa Monitoreo y Control</span>
            </a>        
        </li>
        </li><li class="nav-item {{ active(['parqueadero.correosCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueadero.correosCarpark.cerrarParqueadero') }}" class="nav-link nav-toggle">
                <i class="fa fa-close"></i>
                <span class="title">Etapa Cierre</span>
            </a>        
        </li>
        -->
        
       
    </ul>
</li>

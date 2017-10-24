{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['parqueadero.*'], 'start active open') }}">
    <a href="{{ route('parqueadero.ingresosCarpark.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-motorcycle"></i>
        <span class="title">Parqueaderos</span>
        <span class="arrow {{ active(['parqueadero.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
    	@permission('ADMIN_CARPARK')

    	 <li class="nav-item {{ active(['parqueadero.usuariosCarpark.*'], 'start active open') }}">
    	   <a href="{{ route('parqueadero.usuariosCarpark.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Ver Usuarios</span>
            </a>    	    	
    	</li>

        <li class="nav-item {{ active(['parqueaderos.motosCarpark.*'], 'start active open') }}">
    	    <a href="{{ route('parqueadero.motosCarpark.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-motorcycle"></i>
                <span class="title">Ver Motocicletas</span>
            </a>
        </li>
        @endpermission
        @permission('FUNC_CARPARK')
        <li class="nav-item {{ active(['parqueaderos.ingresosCarpark.*'], 'start active open') }}">
            <a href="{{ route('parqueadero.ingresosCarpark.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-pencil-square-o"></i>
                <span class="title">Control De Ingresos</span>
            </a>        
        </li>
        @endpermission
        @permission('ADMIN_CARPARK')
        <li class="nav-item {{ active(['parqueaderos.historialesCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueadero.historialesCarpark.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-history"></i>
                <span class="title">Ver Historiales Del Parqueadero</span>
            </a>        
        </li>

        <li class="nav-item {{ active(['parqueaderos.dependenciasCarpark.*'], 'start active open') }}">
    	    <a href="{{ route('parqueadero.dependenciasCarpark.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-bars"></i>
                <span class="title">Ver Dependencias</span>
            </a>    	
        </li>
        @endpermission
        @permission('FUNC_CARPARK')
        <li class="nav-item {{ active(['parqueaderos.correosCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueaderos.correosCarpark.cerrarParqueadero') }}" class="nav-link nav-toggle">
                <i class="fa fa-window-close-o"></i>
                <span class="title">Cerrar Parqueadero</span>
            </a>        
        </li>
        @endpermission
    </ul>
</li>

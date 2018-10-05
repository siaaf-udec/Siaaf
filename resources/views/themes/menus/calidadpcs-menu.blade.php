{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['parqueadero.*'], 'start active open') }}">
    <a href="{{ route('parqueadero.ingresosCarpark.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-book"></i>
        <span class="title">Calidad PCS</span>
        <span class="arrow {{ active(['parqueadero.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
    	
        @permission('CALIDADPCS_MODULE')
        <li class="nav-item {{ active(['parqueadero.correosCarpark.*'], 'start active open') }}">        
            <a href="{{ route('parqueadero.correosCarpark.cerrarParqueadero') }}" class="nav-link nav-toggle">
                <i class="fa fa-window-close-o"></i>
                <span class="title">Cerrar Parqueadero</span>
            </a>        
        </li>
        @endpermission
    </ul>
</li>

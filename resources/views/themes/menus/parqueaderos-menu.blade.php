{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['parqueaderos.*'], 'start active open') }}">
    <a href="{{ route('parqueaderos.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-motorcycle"></i>
        <span class="title">Parqueaderos</span>
        <span class="arrow {{ active(['audiovisuales.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
    	<!-- inicio Permiso -->
    	<li class="nav-item {{ active(['parqueadero.usuariosCarpark.*'], 'start active open') }}">
    		
    		<a href="{{ route('parqueadero.usuariosCarpark.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Ver Usuarios</span>
            </a>


    	</li>

    	<li class="nav-item {{ active(['parqueadero.motosCarpark.*'], 'start active open') }}">
    		
    		<a href="{{ route('parqueadero.motosCarpark.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Ver Motocicletas</span>
            </a>

            

    	</li>

    	<li class="nav-item {{ active(['parqueadero.dependenciasCarpark.*'], 'start active open') }}">
    		
    		<a href="{{ route('parqueadero.dependenciasCarpark.index') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Ver Dependencias</span>
            </a>


    	</li>

    	<!-- fin Permiso -->
    </ul>
</li>

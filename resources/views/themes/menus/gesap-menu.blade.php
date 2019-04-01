
{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
      <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
               <i class="fa fa-cube"></i>
        <span class="title">Gesap</span>
        <span class="arrow {{ active(['AnteproyectosGesap.*', 'UsuariosGesap.*','DocenteGesap.*','EstudianteGesap.*','Proyectos.*','CoordinadorGesap.*' ], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
		@permission('GESAP_DOCENTE')
		<li class="nav-item {{ active(['DocenteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('DocenteGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Mis Anteproyectos</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('GESAP_DOCENTE')
		<li class="nav-item {{ active(['DocenteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('DocenteGesap.indexProyecto') }}" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Mis Proyectos</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('GESAP_STUDENT')
		<li class="nav-item {{ active(['EstudianteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('EstudianteGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Mis Anteproyectos </span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('GESAP_STUDENT')
		<li class="nav-item {{ active(['EstudianteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('EstudianteGesap.indexProyecto') }}" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Mis Proyectos</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('GESAP_ADMIN')
		<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
    	   <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-list-alt"></i>
                <span class="title">Lista de Anteproyectos</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('GESAP_ADMIN')
		<li class="nav-item {{ active(['Proyectos*'], 'start active open') }}">
			<a href="{{ route('Proyectos.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-list-alt"></i>
				<span class="title">Listar Proyectos</span>
			</a>
		</li>
		
		@endpermission
		@permission('GESAP_ADMIN')
		<li class="nav-item {{ active(['UsuariosGesap.*'], 'start active open') }}">
			<a href="{{ route('UsuariosGesap.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-user"></i>
				<span class="title">Lista De Usuarios</span>
			</a>
		</li>
		@endpermission
		
		@permission('GESAP_ADMIN')
		<li class="nav-item {{ active(['CoordinadorGesap.*'], 'start active open') }}">
    	   <a href="{{ route('CoordinadorGesap.indexSolicitudes') }}" class="nav-link nav-toggle">
     			<i class="fa fa-search"></i>
				<span class="title">Busquedas</span>
			</a>
		</li>
		@endpermission
		@permission('GESAP_ADMIN')
		<li class="nav-item {{ active(['CoordinadorGesap.*'], 'start active open') }}">
    	   <a href="{{ route('CoordinadorGesap.indexSolicitudes') }}" class="nav-link nav-toggle">
     			<i class="fa fa-search"></i>
				<span class="title">Solicitudes</span>
			</a>
		</li>
		@endpermission


		@permission('ADMIN_GESAP')
		<li class="nav-item {{ active(['CoordinadorGesap.*'], 'start active open') }}">
    	   <a href="{{ route('CoordinadorGesap.indexSolicitudes') }}" class="nav-link nav-toggle">
     			<i class="fa fa-book"></i>
				<span class="title">Reportes</span>
			</a>
		</li>
		
		@endpermission
		@permission('ADMIN_GESAP')
		<li class="nav-item {{ active(['CoordinadorGesap.*'], 'start active open') }}">
    	   <a href="{{ route('CoordinadorGesap.indexSolicitudes') }}" class="nav-link nav-toggle">
     			<i class="fa fa-bar-chart">
				</i>
				<span class="title">
					Graficos
				</span>
			</a>
		</li>
		@endpermission
	</ul>
</li>
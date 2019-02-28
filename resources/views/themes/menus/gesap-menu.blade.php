
{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
      <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
               <i class="fa fa-cube"></i>
        <span class="title">Gesap</span>
        <span class="arrow {{ active(['AnteproyectosGesap.*', 'UsuariosGesap.*','DocenteGesap.*','EstudianteGesap.*', ], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
		@permission('ANTE_DIRECTOR')
		<li class="nav-item {{ active(['DocenteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('DocenteGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Mis Anteproyectos Y Proyectos(Direcctor)</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('MY_ANTE_PROYECTO')
		<li class="nav-item {{ active(['EstudianteGesap.*'], 'start active open') }}">
    	   <a href="{{ route('EstudianteGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Mis Anteproyectos Y Proyectos(Estudiante)</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('LIST_ANTEPROYECTOS')
		<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
    	   <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
                <i class="fa fa-user"></i>
                <span class="title">Lista de Anteproyectos</span>
            </a>    	    	
    	</li>
		@endpermission
		@permission('LIST_PROYECTOS')
		<li class="nav-item {{ active(['AnteproyectosGesap*'], 'start active open') }}">
			<a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-list-alt"></i>
				<span class="title">Listar Proyectos</span>
			</a>
		</li>
		
		@endpermission
		@permission('ADD_USER_GESAP')
		<li class="nav-item {{ active(['UsuariosGesap.*'], 'start active open') }}">
			<a href="{{ route('UsuariosGesap.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-user"></i>
				<span class="title">Lista De Usuarios</span>
			</a>
		</li>
		@endpermission
		@permission('FIND_DB_GESAP')
		<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
    	   <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
     			<i class="fa fa-search"></i>
				<span class="title">Busquedas</span>
			</a>
		</li>
		@endpermission


		@permission('REPORT_GESAP')
		<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
    	   <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
     			<i class="fa fa-book"></i>
				<span class="title">Reportes</span>
			</a>
		</li>
		
		@endpermission
		@permission('GRAPHICS_GESAP')
		<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
    	   <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
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
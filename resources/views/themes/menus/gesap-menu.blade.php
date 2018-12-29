
{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['AnteproyectosGesap.*'], 'start active open') }}">
      <a href="{{ route('AnteproyectosGesap.index') }}" class="nav-link nav-toggle">
               <i class="fa fa-cube"></i>
        <span class="title">Gesap</span>
        <span class="arrow {{ active(['parqueadero.*'], 'open') }}"></span>
    </a>

    <ul class="sub-menu">
	
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
		<li class="nav-item {{ active(['anteproyecto.index.directorList'], 'start active open') }}">
			<a href="{{ route('anteproyecto.index.directorList') }}" class="nav-link nav-toggle">
				<i class="fa fa-user"></i>
				<span class="title">Lista De Usuarios</span>
			</a>
		</li>
		@endpermission
		@permission('FIND_DB_GESAP')
		<li class="nav-item {{ active(['anteproyecto.index.juryList'], 'start active open') }}">
			<a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.juryList') }} ">
				<i class="fa fa-search"></i>
				<span class="title">Busquedas</span>
			</a>
		</li>
		@endpermission


		@permission('REPORT_GESAP')
		<li class="nav-item {{ active(['report.index'], 'start active open') }}">
			<a class="nav-link " href="{{ route('report.index') }}">
				<i class="fa fa-book"></i>
				<span class="title">Reportes</span>
			</a>
		</li>
		
		@endpermission
		@permission('GRAPHICS_GESAP')
		<li class="nav-item {{ active(['anteproyecto.index.studentList'], 'start active open') }}">
			<a class="nav-link " href="{{ route('anteproyecto.index.studentList') }}">
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
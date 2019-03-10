{{-- MENÚ DE EJEMPLO --}}
<li class="nav-item {{ active(['gesap.*','min.*','project.*','anteproyecto.*','report.*','graficos.*'], 'start active open') }}">
	<a class="nav-link nav-toggle" href="javascript:;">
		<i class="fa fa-cube">
		</i>
		<span class="title">
			Gesap
		</span>
		<span class="arrow {{ active(['gesap.*','min.*','project.*','anteproyecto.*','report.*','graficos.*'], 'open') }}">
		</span>
	</a>
	<ul class="sub-menu">
		@permission('CREATE_ACTIVITY_DEFAULT_GESAP')
		<li class="nav-item {{ active(['activity.default'], 'start active open') }}">
			<a href="{{ route('activity.default') }}" class="nav-link nav-toggle">
				<i class="fa fa-list-alt"></i>
				<span class="title">Entregables</span>
			</a>
		</li>
		@endpermission
		@permission('SEE_ALL_PROJECT_GESAP')
		<li class="nav-item {{ active(['min.index'], 'start active open') }}">
			<a href="{{ route('min.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-list-alt"></i>
				<span class="title">Listar Anteproyectos</span>
			</a>
		</li>
		<li class="nav-item {{ active(['project.index'], 'start active open') }}">
			<a href="{{ route('project.index') }}" class="nav-link nav-toggle">
				<i class="fa fa-list-alt"></i>
				<span class="title">Listar Proyectos</span>
			</a>
		</li>
		@endpermission
		@permission('DIRECTOR_LIST_GESAP')
		<li class="nav-item {{ active(['anteproyecto.index.directorList'], 'start active open') }}">
			<a href="{{ route('anteproyecto.index.directorList') }}" class="nav-link nav-toggle">
				<i class="fa fa-user"></i>
				<span class="title">Director de Proyecto</span>
			</a>
		</li>
		@endpermission
		@permission('JURY_LIST_GESAP')
		<li class="nav-item {{ active(['anteproyecto.index.juryList'], 'start active open') }}">
			<a class="nav-link nav-toggle" href="{{ route('anteproyecto.index.juryList') }} ">
				<i class="fa fa-user"></i>
				<span class="title">Jurado de Proyecto</span>
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
		<li class="nav-item {{ active(['graficos.index'], 'start active open') }}">
			<a class="nav-link " href="{{ route('graficos.index') }}">
				<i class="fa fa-bar-chart"></i>
				<span class="title">Graficos</span>
			</a>
		</li>
		@endpermission
		@permission('STUDENT_LIST_GESAP')
		<li class="nav-item {{ active(['anteproyecto.index.studentList'], 'start active open') }}">
			<a class="nav-link " href="{{ route('anteproyecto.index.studentList') }}">
				<i class="fa fa-list-alt">
				</i>
				<span class="title">
					Proyectos
				</span>
			</a>
		</li>
		@endpermission
	</ul>
</li>
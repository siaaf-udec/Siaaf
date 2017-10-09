{{-- MENÚ DE EJEMPLO --}}
@role(['Admin_uni','Funcionario_uni'])
            <li class="nav-item {{ active(['Convenios.Convenios'], 'start active open') }}">
                <a href="{{ route('Convenios.Convenios') }}" class="nav-link nav-toggle">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="title">CONVENI0S</span>
                    </a>
                </li>
@endrole
@role(['Admin_uni','Funcionario_uni','Empresario_uni','Coordinador_uni','Pasante_uni'])
            <li class="nav-item {{ active(['Mis_Convenios.Mis_Convenios'], 'start active open') }}">
                <a href="{{ route('Mis_Convenios.Mis_Convenios') }}" class="nav-link nav-toggle">
                        <i class="fa fa-archive"></i>
                        <span class="title">MIS CONVENIOS</span>
                    </a>
                </li>


@endrole
@role(['Admin_uni','Funcionario_uni'])
            <li class="nav-item {{ active(['Empresas.Empresas'], 'start active open') }}">
                <a href="{{ route('Empresas.Empresas') }}" class="nav-link nav-toggle">
                        <i class="fa fa-industry"></i>
                        <span class="title">EMPRESAS</span>
                    </a>
                </li>

@endrole
@role(['Admin_uni'])
            <li class="nav-item {{ active(['Sedes.Sedes'], 'start active open') }}">
                <a href="{{ route('Sedes.Sedes') }}" class="nav-link nav-toggle">
                        <i class="fa fa-building"></i>
                        <span class="title">SEDES</span>
                    </a>
                </li>
@endrole
@role(['Admin_uni'])
            <li class="nav-item {{ active(['Estados.Estados'], 'start active open') }}">
                <a href="{{ route('Estados.Estados') }}" class="nav-link nav-toggle">
                        <i class="fa fa-paper-plane"></i>
                        <span class="title">ESTADOS</span>
                    </a>
                </li>
@endrole
@role(['Empresario_uni','Coordinador_uni','Pasante_uni'])
            <li class="nav-item {{ active(['Mis_Documentos.Mis_Documentos'], 'start active open') }}">
                <a href="{{ route('Mis_Documentos.Mis_Documentos') }}" class="nav-link nav-toggle">
                        <i class="fa fa-folder"></i>
                        <span class="title">MIS DOCUMENTOS</span>
                    </a>
                </li>
@endrole
@role(['Admin_uni','Funcionario_uni','Empresario_uni','Coordinador_uni','Pasante_uni'])
            <li class="nav-item {{ active(['Evaluaciones.Evaluaciones'], 'start active open') }}">
                <a href="{{ route('Evaluaciones.Evaluaciones') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">EVALUACIONES</span>
                    </a>
                </li>
@endrole
@role(['Admin_uni'])
            <li class="nav-item {{ active(['Tipo_Pregunta.Tipo_Pregunta'], 'start active open') }}">
                <a href="{{ route('Tipo_Pregunta.Tipo_Pregunta') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">TIPO DE PREGUNTAS</span>
                    </a>
                </li>
@endrole
@role(['Admin_uni'])
            <li class="nav-item {{ active(['Pregunta.Pregunta'], 'start active open') }}">
                <a href="{{ route('Pregunta.Pregunta') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">PREGUNTAS</span>
                    </a>
                </li>

<li class="nav-item {{ active(['interacion.universitaria.*'], 'start active open') }}">
    <a href="{{ route('interaccion.universitaria.index') }}" class="nav-link">
        <i class="icon-feed"></i>
        <span class="title">Interacción Universitaria</span>
    </a>
</li>
@endrole
@role(['Funcionario_uni','Admin_uni','Administrador Master'])
<li class="nav-item">
    <a href="{javascript:" class="nav-link nav-toggle">
        <i class="fa fa-object-ungroup"></i>
        <span class="title">Convenio</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
                <li class="nav-item {{ active(['Agregar_Convenios.index'], 'start active open') }}">
                    <a href="{{ route('Agregar_Convenios.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-clone"></i>
                            <span class="title">Registar convenios</span>
                    </a>
                </li> 
                <li class="nav-item {{ active(['Listar_Convenios.index'], 'start active open') }}">
                    <a href="{{ route('Listar_Convenios.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-check-square"></i>
                            <span class="title">Listar convenios</span>
                    </a>
                </li>                         
    </ul>
</li>
<li class="nav-item">
    <a href="{javascript:" class="nav-link nav-toggle">
        <i class="fa fa-industry"></i>
        <span class="title">Empresas</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
                <li class="nav-item {{ active(['Agregar_Empresas.Agregar_Empresas'], 'start active open') }}">
                    <a href="{{ route('Agregar_Empresas.Agregar_Empresas') }}" class="nav-link nav-toggle">
                            <i class="fa fa-clone"></i>
                            <span class="title">Registar empresas</span>
                    </a>
                </li> 
                <li class="nav-item {{ active(['Empresas.Empresas'], 'start active open') }}">
                    <a href="{{ route('Empresas.Empresas') }}" class="nav-link nav-toggle">
                            <i class="fa fa-check-square"></i>
                            <span class="title">Listar empresas</span>
                    </a>
                </li>                           
    </ul>
</li>
@endrole
@role(['Admin_uni','Administrador Master'])
<li class="nav-item">
    <a href="{javascript:" class="nav-link nav-toggle">
        <i class="fa fa-object-ungroup"></i>
        <span class="title">Base de Datos</span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
                <li class="nav-item {{ active(['Agregar_Convenios.index'], 'start active open') }}">
                    <a href="{{ route('Agregar_Convenios.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-clone"></i>
                            <span class="title">Registar Carreras</span>
                    </a>
                </li> 
                <li class="nav-item {{ active(['Listar_Convenios.index'], 'start active open') }}">
                    <a href="{{ route('Listar_Convenios.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-check-square"></i>
                            <span class="title">Listar Carreras</span>
                    </a>
                </li>                         
    </ul>
</li>

@endrole
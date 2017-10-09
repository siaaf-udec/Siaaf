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
@endrole
{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['financial.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-industry"></i>
        <span class="title">Financiero</span>
        <span class="arrow {{ active(['financial.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['financial.files.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-files-o"></i>
                <span class="title">Gestión de Archivos</span>
                <span class="arrow {{ active(['financial.files.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['financial.files.index'], 'start active open') }}">
                    <a href="{{ route('financial.files.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-cloud-upload"></i>
                        <span class="title">Cargar Archivos</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['financial.files.request.index'], 'start active open') }}">
                    <a href="{{ route('financial.files.request.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-check"></i>
                        <span class="title">Aprobar Archivos</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['financial.requests.*'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="fa fa-bookmark"></i>
                <span class="title">Solicitudes</span>
                <span class="arrow {{ active(['financial.requests.*'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['financial.requests.student.extension.index'], 'start active open') }}">
                    <a href="{{ route('financial.requests.student.extension.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Supletorio</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['financial.requests.student.add.sub.index'], 'start active open') }}">
                    <a href="{{ route('financial.requests.student.add.sub.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Adición/Cancelación de Materias</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['financial.requests.student.validation.index'], 'start active open') }}">
                    <a href="{{ route('financial.requests.student.validation.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Validación</span>
                    </a>
                </li>
                <li class="nav-item {{ active(['financial.requests.student.inter.index'], 'start active open') }}">
                    <a href="{{ route('financial.requests.student.inter.index') }}" class="nav-link nav-toggle">
                        <i class="fa fa-book"></i>
                        <span class="title">Intersemestral</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>

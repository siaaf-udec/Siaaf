{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['financial.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-industry"></i>
        <span class="title">Financiero</span>
        <span class="arrow {{ active(['financial.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        @role( ['financial_administrator', 'financial_secretary'] )
            <li class="nav-item {{ active(['financial.management.*'], 'start active open') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-cogs"></i>
                    <span class="title">Gestión de Recursos</span>
                    <span class="arrow {{ active(['financial.management.*'], 'open') }}"></span>
                </a>
                <ul class="sub-menu">
                    @role( ['financial_administrator', 'financial_secretary'] )
                        <li class="nav-item {{ active(['financial.management.programs.*'], 'start active open') }}">
                            <a href="{{ route('financial.management.programs.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-university"></i>
                                <span class="title">Programas</span>
                            </a>
                        </li>
                        <li class="nav-item {{ active(['financial.management.subjects.*'], 'start active open') }}">
                        <a href="{{ route('financial.management.subjects.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Materias</span>
                        </a>
                    </li>
                    @endrole
                    @role( ['financial_administrator'] )
                        <li class="nav-item {{ active(['financial.management.costs.*'], 'start active open') }}">
                        <a href="{{ route('financial.management.costs.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-money"></i>
                            <span class="title">Costos</span>
                        </a>
                    </li>
                        <li class="nav-item {{ active(['financial.management.status.*'], 'start active open') }}">
                        <a href="{{ route('financial.management.status.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-list-alt"></i>
                            <span class="title">Estados</span>
                        </a>
                    </li>
                        <li class="nav-item {{ active(['financial.management.file.type.*'], 'start active open') }}">
                        <a href="{{ route('financial.management.file.type.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-file-o"></i>
                            <span class="title">Tipos de Archivos</span>
                        </a>
                    </li>
                    @endrole
                </ul>
            </li>
        @endrole

        @role( ['financial_administrator'] )
            <li class="nav-item {{ active(['financial.files.*'], 'start active open') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-files-o"></i>
                    <span class="title">Gestión de Archivos</span>
                    <span class="arrow {{ active(['financial.files.*'], 'open') }}"></span>
                </a>
                <ul class="sub-menu">
                    @role( 'financial_student' )
                        <li class="nav-item {{ active(['financial.files.index'], 'start active open') }}">
                            <a href="{{ route('financial.files.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-cloud-upload"></i>
                                <span class="title">Cargar Archivos</span>
                            </a>
                        </li>
                    @endrole
                    @role( 'financial_administrator' )
                        <li class="nav-item {{ active(['financial.files.request.index'], 'start active open') }}">
                            <a href="{{ route('financial.files.request.index') }}" class="nav-link nav-toggle">
                                <i class="fa fa-check"></i>
                                <span class="title">Aprobar Archivos</span>
                            </a>
                        </li>
                    @endrole
                </ul>
            </li>
        @endrole
        @role( 'financial_student' )
            <li class="nav-item {{ active(['financial.requests.*'], 'start active open') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-bookmark"></i>
                    <span class="title">Solicitudes</span>
                    <span class="arrow {{ active(['financial.requests.*'], 'open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active(['financial.requests.student.extension.*'], 'start active open') }}">
                        <a href="{{ route('financial.requests.student.extension.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Supletorio</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.requests.student.add-sub.*'], 'start active open') }}">
                        <a href="{{ route('financial.requests.student.add-sub.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Adición/Cancelación de Materias</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.requests.student.validation.*'], 'start active open') }}">
                        <a href="{{ route('financial.requests.student.validation.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Validación</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.requests.student.intersemestral.*'], 'start active open') }}">
                        <a href="{{ route('financial.requests.student.intersemestral.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Intersemestral</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole
        @role( ['financial_administrator', 'financial_secretary'] )
            <li class="nav-item {{ active(['financial.admin.*'], 'start active open') }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-check"></i>
                    <span class="title">Aprobación de Solicitudes</span>
                    <span class="arrow {{ active(['financial.admin.*'], 'open') }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item {{ active(['financial.admin.approval.extension.*'], 'start active open') }}">
                        <a href="{{ route('financial.admin.approval.extension.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Supletorio</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.admin.approval.validation.*'], 'start active open') }}">
                        <a href="{{ route('financial.admin.approval.validation.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Validaciones</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.admin.approval.addition.subtraction.*'], 'start active open') }}">
                        <a href="{{ route('financial.admin.approval.addition.subtraction.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Adición/Cancelación de Materias</span>
                        </a>
                    </li>
                    <li class="nav-item {{ active(['financial.admin.approval.intersemestral.*'], 'start active open') }}">
                        <a href="{{ route('financial.admin.approval.intersemestral.index') }}" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Intersemestral</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole
    </ul>
</li>

<div class="page-sidebar navbar-collapse collapse">
    {{-- BEGIN SIDEBAR MENU --}}
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true"
        data-slide-speed="200">
        {{-- HOME Y COMPONENTES --}}
        @include('themes.menus.home-menu')
        {{-- COMPONENTES --}}
        @permission('MASTER_ELEMENTS')
        @include('themes.menus.elementos-menu')
        @endpermission
        {{-- USUARIOS --}}
        @permission('MASTER_USERS')
        @include('themes.menus.user-menu')
        @endpermission
        {{-- PERMISOS DE USUARIOS --}}
        @permission('MASTER_PERMISSIOM')
        @include('themes.menus.permisos-menu')
        @endpermission
        {{-- ESPACIOS ACADÉMICOS --}}
        @permission('ACAD_MODULE')
        @include('themes.menus.espacios-academicos-menu')
        @endpermission
        {{-- AUDIOVISUALES --}}
        @permission('AUDI_MODULE')
        @include('themes.menus.audiovisuales-menu')
        @endpermission
        {{-- PARQUEADEROS --}}
        @permission('PARK_MODULE')
        @include('themes.menus.parqueaderos-menu')
        @endpermission
        {{-- FINANCIERO --}}
        @permission( 'FINANCIAL_MODULE' )
        @include('themes.menus.financiero-menu')
        @endpermission
        {{-- INTERACCIÓN UNIVERSITARIA --}}
        @permission('INTE_MODULE')
        @include('themes.menus.interaccion-universitaria-menu')
        @endpermission
        {{-- TALENTO HUMANO --}}
        @permission('TAL_MODULE')
        @include('themes.menus.talento-humano-menu')
        @endpermission
        {{-- ADMINISTRATIVO --}}
        @permission('ADMINIS_MODULE')
        @include('themes.menus.administrative-menu')
        @endpermission
        {{-- GESAP --}}
        @permission('GESAP_MODULE')
        @include('themes.menus.gesap-menu')
        @endpermission
        {{-- ESCUELAS DEPORTIVAS --}}
        @permission('SCHOOL_MODULE')
        @include('themes.menus.escuelas-deportivas-menu')
        @endpermission
        {{-- ADMISIONES Y REGISTRO --}}
        @permission('ADMINREGIST_MODULE')
        @include('themes.menus.adminregist-menu')
        @endpermission
        {{-- USUARIOS UDEC --}}
        @permission('MASTER_USER_UDEC')
        @include('themes.menus.users-udec-menu')
        @endpermission
        {{-- USUARIOS UDEC --}}
        @permission('AUD_MODULE')
        @include('themes.menus.auditing-menu')
        @endpermission
        @env('local')
        {{-- CRM UDEC --}}
        @include('themes.menus.crmudec-menu')
        {{-- SELF EVALUATIÓN --}}
        @include('themes.menus.auto-evaluation-menu')
        @endenv
    </ul>
    {{-- BEGIN SIDEBAR MENU --}}
</div>
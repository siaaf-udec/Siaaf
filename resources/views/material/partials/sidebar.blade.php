<div class="page-sidebar navbar-collapse collapse">
    {{-- BEGIN SIDEBAR MENU --}}
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true"
        data-slide-speed="200">
        {{-- HOME Y COMPONENTES --}}
        @include('themes.menus.home-menu')
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
        @permission('FINAN_MODULE')
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
        {{-- CALISOFT --}}
        @permission('CALI_MODULE')
        @include('themes.menus.calisoft-menu')
        @endpermission
        {{-- GESAP --}}
        @permission('GESAP_MODULE')
        @include('themes.menus.gesap-menu')
        @endpermission
        {{-- ESCUELAS DEPORTIVAS --}}
        @permission('SCHOOL_MODULE')
        @include('themes.menus.escuelas-deportivas-menu')
        @endpermission
    </ul>
    {{-- BEGIN SIDEBAR MENU --}}
</div>
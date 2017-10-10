<div class="page-sidebar navbar-collapse collapse"> 
        {{-- BEGIN SIDEBAR MENU --}} 
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="true" data-auto-scroll="true" data-slide-speed="200"> 
            {{-- HOME Y COMPONENTES --}} 
            @include('themes.menus.home-menu') 
            {{-- ESPACIOS ACADÉMICOS --}} 
            @include('themes.menus.espacios-academicos-menu') 
            {{-- AUDIOVISUALES --}} 
            @include('themes.menus.audiovisuales-menu') 
            {{-- PARQUEADEROS --}} 
            @include('themes.menus.parqueaderos-menu') 
            {{-- FINANCIERO --}} 
            @include('themes.menus.financiero-menu') 
            {{-- INTERACCIÓN UNIVERSITARIA --}} 
            @include('themes.menus.interaccion-universitaria-menu') 
            {{-- TALENTO HUMANO --}} 
            @include('themes.menus.talento-humano-menu') 
            {{-- CALISOFT --}} 
            @include('themes.menus.calisoft-menu') 
             
            {{-- GESAP --}} 
            @include('themes.menus.gesap-menu') 
            {{-- ESCUELAS DEPORTIVAS --}} 
            @include('themes.menus.escuelas-deportivas-menu') 
        </ul> 
        {{-- BEGIN SIDEBAR MENU --}} 
    </div> 
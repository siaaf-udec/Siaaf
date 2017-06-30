{{-- MENÚ DE EJEMPLO --}}

<li class="nav-item {{ active(['financial.*'], 'start active open') }}">
    <a href="{{ route('financial.index') }}" class="nav-link nav-toggle">
        <i class="fa fa-industry"></i>
        <span class="title">Financiero</span>
    </a>
</li>
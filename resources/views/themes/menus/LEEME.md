# Menú

Se instaló un paquete que genera automáticamente la clase "active" que indica qué menú fue seleccionado.

Al sincronizar el proyecto ejecutar el comando:


* composer update
* composer dump-autoload


<a href="https://packagist.org/packages/watson/active">
Documentación oficial para ver más funciones.
</a>

## Uso

### Menú Simple

```html

<li class="nav-item {{ active(['home', 'root'], 'start active open') }}">
    <a href="{{ route('home') }}" class="nav-link nav-toggle">
        <i class="fa fa-home"></i>
        <span class="title">Home</span>
    </a>
</li>

```
### Menú con niveles

* Elementos
    * Componentes
        * Botones
    * Portlets

```html

<li class="nav-item {{ active(['components.*', 'forms.*'], 'start active open') }}">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="fa fa-building-o"></i>
        <span class="title">Elementos</span>
        <span class="arrow {{ active(['components.*'], 'open') }}"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item {{ active(['components.buttons', 'components.icons'], 'start active open') }}">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-diamond"></i>
                <span class="title">Componentes</span>
                <span class="arrow {{ active(['components.buttons', 'components.icons'], 'open') }}"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item {{ active(['components.buttons'], 'start active open') }}">
                    <a href="{{ route('components.buttons') }}" class="nav-link nav-toggle">
                        <i class="fa fa-braille"></i>
                        <span class="title">Botones</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ active(['components.portlet'], 'start active open') }}">
            <a href="{{ route('components.portlet') }}" class="nav-link">
                <i class="icon-frame"></i>
                <span class="title">Portlets</span>
            </a>
        </li>
    </ul>
</li>

```

## Rutas

Ejemplo de rutas con alias o nombres y sus formas de nombrarlas

```php
Route::get('/', [
    'as' => 'gesap.index', //Este es el alias de la ruta
    'uses' => 'Controller@método'
]);

Route::get('/', 'Controller@método')->name('interaccion.universitaria.index');

Route::resource('rrhh', 'GameController', [
    'names' => [
          'index' => 'talento.humano.rrhh.index', // 'método' => 'alias'
          'create' => 'talento.humano.rrhh.create',
    ]
])

```

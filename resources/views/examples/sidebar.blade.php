@extends('material.layouts.dashboard')

@section('title', '| Sidebar')

@push('styles')
<link href="{{ asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Sidebar')

@section('page-description', 'ejemplo del uso y personalización del sidebar.')

@section('content')
{{-- BEGIN COMPONENTS SAMPLE --}}
    <div class="col-md-12 column sortable">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-notebook', 'title' => 'Proyecto'])
            <div class="row">
                <div class="col-md-6">
                    <p>En la ruta <pre class="red">"resources/views/themes/menus/*-menu.blade.php"</pre> se crearon los archivos correspondientes al sidebar de cada módulo de la plantilla</p>
                </div>
                <div class="col-md-6">
                    <div id="tree" class="tree-demo">
                        <ul>
                            <li> siaaf
                                <ul>
                                    <li data-jstree='{ "disabled" : true }'>
                                        <a href="javascript:;"> app </a>
                                    </li>
                                    <li data-jstree='{ "disabled" : true }'>
                                        <a href="javascript:;"> bootstrap </a>
                                    </li>
                                    <li data-jstree='{ "disabled" : true }'>...</li>
                                    <li data-jstree='{ "opened" : true }'> resources
                                        <ul>
                                            <li data-jstree='{ "disabled" : true }'>...</li>
                                            <li data-jstree='{ "opened" : true }'> views
                                                <ul>
                                                    <li data-jstree='{ "disabled" : true }'>...</li>
                                                    <li data-jstree='{ "opened" : true }'> themes
                                                        <ul>
                                                            <li data-jstree='{ "opened" : true }'> menus
                                                                <ul>
                                                                    <li data-jstree='{ "disabled" : true, "type" : "file" }'> ... </li>
                                                                    <li data-jstree='{ "type" : "file", "selected" : true }'> *-menu.blade.php </li>
                                                                    <li data-jstree='{ "disabled" : true, "type" : "file" }'> ... </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li data-jstree='{ "disabled" : true }'>...</li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{ "disabled" : true }'>
                                        ...
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <p>
                        Se instaló un paquete que genera automáticamente la clase "active"
                        que indica qué menú fue seleccionado.
                        <a href="javascript:;" class="thumbnail">
                            <img src="{{ asset('assets/pages/img/active-sample.png') }}" > </a>
                    </p>
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>Documentación watson/active</h3>
                        <p> El siguiente link contiene toda la documentación correspondiente.
                            <a class="btn red btn-outline" href="https://packagist.org/packages/watson/active" target="_blank">Documentación</a>
                        </p>
                    </div>
                    <p>
                        Como ejemplo se puede tomar el archivo "home-menu.blade.php"
                        que contiene menús y submenús.
                    </p>
                    <p>
                        Se recomienda que todas las rutas tengan alias o nombres con el prefijo
                        correspondiente a cada módulo, con el fin de evitar conflictos
                        en los formularios, nombres de rutas, etc.

                        Ejemplos de rutas con distintas formas de nombrarlas o asignarles alias:
                    </p>

                    <pre>
Route::get('/', [
    'as' => 'gesap.index', //Este es el alias de la ruta
    'uses' => 'Controller@método'
]);
</pre>
                    <pre>
Route::get('/', 'Controller@método')->name('interaccion.universitaria.index');
</pre>
                    <pre>
Route::resource('rrhh', 'GameController', [
    'names' => [
          'index' => 'talento.humano.rrhh.index', // 'método' => 'alias'
          'create' => 'talento.humano.rrhh.create',
    ]
])
</pre>
                </div>
            </div>
        @endcomponent
    </div>
{{-- END COMPONENTS SAMPLE --}}
@endsection


@push('plugins')
<script src="{{ asset('assets/global/plugins/jstree/dist/jstree.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script type="text/javascript">

    var UITree = function () {

        var handleTree = function () {

            $('#tree').jstree({
                "core" : {
                    "themes" : {
                        "responsive": true
                    }
                },
                "types" : {
                    "default" : {
                        "icon" : "fa fa-folder icon-state-warning icon-lg"
                    },
                    "file" : {
                        "icon" : "fa fa-file icon-state-warning icon-lg"
                    }
                },
                "plugins": ["types"]
            });

            // handle link clicks in tree nodes(support target="_blank" as well)
            $('#tree').on('select_node.jstree', function(e,data) {
                var link = $('#' + data.selected).find('a');
                if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
                    if (link.attr("target") == "_blank") {
                        link.attr("href").target = "_blank";
                    }
                    document.location.href = link.attr("href");
                    return false;
                }
            });
        }

        return {
            //main function to initiate the module
            init: function () {

                handleTree();

            }

        };

    }();

    jQuery(document).ready(function() {
        UITree.init();
    });
</script>

@endpush
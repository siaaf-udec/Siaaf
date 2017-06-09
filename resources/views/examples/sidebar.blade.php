@extends('material.layouts.dashboard')

@section('title', '| Sidebar')

@push('styles')
<link href="{{ asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/codemirror/lib/codemirror.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/codemirror/theme/material.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('page-title', 'Sidebar')

@section('page-description', 'ejemplo del uso y personalización del sidebar.')

@section('content')
{{-- BEGIN COMPONENTS SAMPLE --}}
    <div class="col-md-6 column sortable">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-notebook', 'title' => 'Proyecto'])

            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])
            <p>En la ruta "config/html.php" se encuentra configurado el sidebar de la plantilla</p>
            <div id="tree" class="tree-demo">
                    <ul>
                        <li> dashboard
                            <ul>
                                <li data-jstree='{ "disabled" : true }'>
                                    <a href="javascript:;"> app </a>
                                </li>
                                <li data-jstree='{ "disabled" : true }'>
                                    <a href="javascript:;"> bootstrap </a>
                                </li>
                                <li data-jstree='{ "opened" : true }'> config
                                    <ul>
                                        <li data-jstree='{ "disabled" : true, "type" : "file" }'> ... </li>
                                        <li data-jstree='{ "type" : "file", "selected" : true }'> html.php </li>
                                        <li data-jstree='{ "disabled" : true, "type" : "file" }'> ... </li>
                                    </ul>
                                </li>
                                <li data-jstree='{ "disabled" : true }'>
                                    ...
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
        @endcomponent
    </div>
    <div class="col-md-6 column sortable">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-notebook', 'title' => 'Uso'])

            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])
            <p>
                Recibe como parámetros un array con las siguientes características
                <ul>
                    <li>id: Nombre que se le dará al menú</li>
                    <li>url: Ruta que se le asigna</li>
                    <li>title: Título que se mostrará en el menú, es opcional si no se usa el nombre que pondrá por defecto es el del identificador, por ejemplo 'home' quedaría Home</li>
                    <li>icon: Ícono que se mostrará en el menú (<a href="{{ url('/components/icons') }}">Iconografía</a>)</li>
                    <li>submenu: Si el módulo contiene submódulos</li>
                </ul>
            </p>
        @endcomponent
    </div>
    <div class="col-md-12 column sortable">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-notebook', 'title' => 'Código'])

            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])
            <textarea id="editor">
return [
/****/
'sidebar' => [
    'id' => ['url' => '/', 'icon' => 'icon-home', 'title' => 'Títutulo'],

     /***** Ejemplo ****/

    'home' => ['url' => '/', 'icon' => 'icon-home'],
    'components' => [
        'submenu' => [
            'buttons' => ['url' => '/components/buttons', 'icon' => 'icon-layers', 'title' => 'Botones'],
            'portlet' => ['url' => '/components/portlet', 'icon' => 'icon-frame',],
            'icons' => ['url' => '/components/icons', 'icon' => 'icon-social-dropbox', 'title' => 'Iconografía'],
            'sidebar' => ['url' => '/components/sidebar', 'icon' => 'icon-notebook'],
        ],
        'title' => 'Componentes',
        'icon' => 'fa fa-building-o',
    ],
],
]</textarea>
        @endcomponent
    </div>
{{-- END COMPONENTS SAMPLE --}}
@endsection


@push('plugins')
<script src="{{ asset('assets/global/plugins/codemirror/lib/codemirror.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/codemirror/mode/php/php.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jstree/dist/jstree.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script type="text/javascript">
    var ComponentsCodeEditors = function () {

        var handleEditor = function () {
            var myTextArea = document.getElementById('editor');
            var myCodeMirror = CodeMirror.fromTextArea(myTextArea, {
                lineNumbers: true,
                matchBrackets: true,
                styleActiveLine: true,
                theme:"material",
                mode: 'php',
                readOnly: true
            });
        }

        return {
            //main function to initiate the module
            init: function () {
                handleEditor();
            }
        };

    }();

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
        ComponentsCodeEditors.init();
        UITree.init();
    });
</script>

@endpush
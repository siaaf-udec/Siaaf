@extends('material.layouts.dashboard')

@section('title', '| Portlets')

@section('page-title', 'Portlets')

@section('page-description', 'Uso de los portlets.')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

            @slot('actions', [

                'link_upload' => [
                    'link' => '',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => '',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => '',
                    'icon' => 'icon-trash',
                ],

            ])
            <div class="row">
                <div class="col-md-12">
                    <h4><strong>Modo de uso: </strong></h4>
                    <p>
                        Recibe como parámetros

                        <ul>
                            <li>
                    <p>Ícono del Portlet (<a href="{{ url('/components/icons') }}">Iconografía</a>) y Título del Portlet</p>
                    <pre><span>@</span>component('themes.bootstrap.components.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])</pre>
                    </li>
                    <li>
                        <p>
                            Botones de acciones (es opcional, se puede quitar del Portlet), recibe un arreglo que contiene
                            <ul>
                                <li>identificador_del_botón: texto personalizado para asignar un ID al botón</li>
                                <li>link: ruta dónde se ejecutará la acción, se puede dejar vacío</li>
                                <li><p>icon: ícono del botón</p></li>
                    <li>
                                <pre>
                                    <span>@</span>slot('actions', [
                                        'identificador_del_botón' => [
                                            'link' => '/ruta/de/la/acción',
                                            'icon' => 'ícono',
                                        ],
                                        'identificador_del_botón' => [
                                            'link' => '',
                                            'icon' => 'ícono',
                                        ],
                                    ])
                                </pre>
                    </li>
                    <li>
                        <p>Resultado</p>
                        <div class="actions">
                            <a class="btn btn-circle btn-icon-only btn-default" id="link_upload" href="javascript:;">
                                <i class="icon-cloud-upload"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default" id="link_wrench" href="javascript:;">
                                <i class="icon-wrench"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default" id="link_trash" href="javascript:;">
                                <i class="icon-trash"></i>
                            </a>
                        </div>
                    </li>
                    </ul>
                    </p>
                </div>
                <br>
                <div class="col-md-12">
                    <p>Código completo: <strong></strong></p>
                    <pre>
            <span>@</span>component('themes.bootstrap.components.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet'])

                <span>@</span>slot('actions', [
                    'identificador_del_botón' => [
                        'link' => '/ruta/de/la/acción',
                        'icon' => 'ícono',
                    ],
                    'identificador_del_botón' => [
                        'link' => '/nombre/de/la/acción',
                        'icon' => 'ícono',
                    ],
                    'identificador_del_botón' => [
                        'link' => '/ruta/de/la/acción',
                        'icon' => 'ícono',
                    ],
                ])

                //HTML
                <span><</span>div>...<span><</span>/div>
            <span>@</span>endcomponent
        </pre>
                </div>
            </div>
        @endcomponent
    </div>
@endsection
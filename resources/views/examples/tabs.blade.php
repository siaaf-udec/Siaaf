@extends('material.layouts.dashboard')

@section('title', '| Tabs')

@section('page-title', 'Tabs')

@section('page-description', 'Uso de los Tabs.')

@section('content')
        <div class="col-md-6">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Tab Izquierda'])

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

                @component('themes.bootstrap.elements.features.tab-left')
                    @slot('tabs', [
                        'tab_1' => [
                            'title' => 'Título 1',
                        ],
                        'tab_2' => [
                            'title' => 'Título 2',
                            'submenu' => [
                                'tab_2_1' => ['title' => 'Subtítulo 1'],
                                'tab_2_2' => ['title' => 'Subtítulo 2'],
                                'tab_2_3' => ['title' => 'Subtítulo 3'],
                            ],
                        ],
                    ])

                    @slot('datas', [
                        'tab_1' => [
                            'text' => 'Lorem ipsum dolor sit amet.',
                        ],
                        'tab_2_1' => [
                            'text' => 'Texto 2.',
                        ],
                        'tab_2_2' => [
                            'text' => 'Texto 3.',
                        ],
                        'tab_2_3' => [
                            'text' => 'Texto 4',
                        ],
                    ])
                @endcomponent
                <div class="row">
                    <div class="col-md-12">
                        <h4><strong>Modo de Uso:</strong></h4>
                        <p>Recibe como parámetros:
                            <ul>
                                <li>
                                    <ul>
                                        <li>id: Identificador del Tab</p></li><p>
                                        <li><p>title: Título del Tab</p></li>
                                        <li><p>submenu: Si el Título tiene submódulos</p></li>
                                    </ul>

<pre>
<span>@</span>slot('tabs', [
    'tab_1' => [
        'title' => 'Título 1',
    ],
    'tab_2' => [
        'title' => 'Título 2',
        'submenu' => [
            'tab_2_1' => ['title' => 'Subtítulo 1'],
            'tab_2_2' => ['title' => 'Subtítulo 2'],
            'tab_2_3' => ['title' => 'Subtítulo 3'],
        ],
    ],
])
</pre>
                                </li>
                                <li><P>Contenido de cada Tab</P>
                                    <ul>
                                        <li><p>id: Identificador del tab debe llamarse igual que los id de tabs</p></li>
                                        <li><p>text: Contenido del Tab</p></li>
                                    </ul>
<pre>
<span>@</span>slot('datas', [
    'tab_1' => [
        'text' => 'Lorem ipsum dolor sit amet.',
    ],
    'tab_2_1' => [
        'text' => 'Texto 2.',
    ],
    'tab_2_2' => [
        'text' => 'Texto 3.',
    ],
    'tab_2_3' => [
        'text' => 'Texto 4',
    ],
])
</pre>
                                </li>
                            </ul>
                        </p>

                        <h4><strong>Código Completo</strong></h4>
<pre>
<span>@</span>component('themes.bootstrap.components.tabs.tab-left')
    <span>@</span>slot('tabs', [
        'tab_1' => [
            'title' => 'Título 1',
        ],
        'tab_2' => [
            'title' => 'Título 2',
            'submenu' => [
                'tab_2_1' => ['title' => 'Subtítulo 1'],
                'tab_2_2' => ['title' => 'Subtítulo 2'],
                'tab_2_3' => ['title' => 'Subtítulo 3'],
            ],
        ],
    ])
    <span>@</span>slot('datas', [
        'tab_1' => [
            'text' => 'Lorem ipsum dolor sit amet.',
        ],
        'tab_2_1' => [
            'text' => 'Texto 2.',
        ],
        'tab_2_2' => [
            'text' => 'Texto 3.',
        ],
        'tab_2_3' => [
            'text' => 'Texto 4',
        ],
    ])
<span>@</span>endcomponent
</pre>
                    </div>
                </div>
            @endcomponent
        </div>
        <div class="col-md-6">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Portlet Izquierda'])

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

                @component('themes.bootstrap.elements.features.tab-left')
                    @slot('tabs', [
                        'tab_1' => [
                            'active' => true,
                            'title' => 'Título 1',
                        ],
                        'tab_2' => [
                            'active' => false,
                            'title' => 'Título 2',
                            'submenu' => [
                                'tab_2_1' => ['title' => 'Subtítulo 1'],
                                'tab_2_2' => ['title' => 'Subtítulo 2'],
                                'tab_2_3' => ['title' => 'Subtítulo 3'],
                            ],
                        ],
                    ])

                    @slot('datas', [
                        'tab_1' => [
                            'active' => true,
                            'text' => 'Lorem ipsum dolor sit amet.',
                        ],
                        'tab_2_1' => [
                            'active' => false,
                            'text' => 'Texto 2.',
                        ],
                        'tab_2_2' => [
                            'active' => false,
                            'text' => 'Texto 3.',
                        ],
                        'tab_2_3' => [
                            'active' => false,
                            'text' => 'Texto 4',
                        ],
                    ])
                @endcomponent
            @endcomponent
        </div>
@endsection
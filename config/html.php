<?php

return [

    /*
     * Set the HTML theme for the components
     * like alerts, form fields, menus, etc.
     */
    'theme'  => 'bootstrap',

    /*
     * Set the folder to store the custom templates
     */
    'custom' => 'themes',

    /*
     * Set to false to deactivate the AccessHandler component
     * Doing so the component will run slightly faster but
     * the logged and roles checkers won't be available
     */
    'control_access' => true,

    /*
     * Set to false to deactivate the Translator for the alert and menu
     * components, doing so they will run slightly faster but won't
     * search for Lang keys to translate texts.
     *
     * Note: the FieldBuilder will always use the translator
     * to search for attribute names and other texts,
     * regardless of this configuration value.
     */
    'translate_texts' => true,

    /*
     * Set to true to deactivate HTML5 form validation
     * and test the backend validation
     */
    'novalidate' => false,

    /*
     * Specify abbreviations for the form field attributes
     */
    'abbreviations' => [
        'ph' => 'placeholder',
        'max' => 'maxlength',
        'min' => 'minlength',
        'tpl' => 'template',
        'req' => 'required',
        'auto' => 'autocomplete',
    ],

    /*
     * Set the configuration for each theme
     */
    'themes' => [
        /**
         * Default configuration for the Twitter Bootstrap framework
         */
        'bootstrap' => [
            /*
             * Set a specific HTML template for a field type if the
             * type is not set, the default template will be used
             */
            'field_templates' => [
                // type => template
                'checkbox' => 'checkbox',
                'checkboxes' => 'checkboxes',
                'radios' => 'radios',
                'color' => 'color',
                'file' => 'image-upload',
            ],
            /*
             * Set the default classes for each field type
             */
            'field_classes' => [
                // type => class or classes
                'default' => 'form-control',
                'color' => 'form-control',
                'select' => 'select2-hidden-accessible form-control pmd-select2',
                'date' => 'form-control date date-picker',
                'time' => 'form-control',
                'checkbox' => 'md-check',
                'error' => 'help-block-error'
            ],
        ]
    ],

    /*
     * Set the custom menu for all pages
     */

    'sidebar' => [
        'home' => ['url' => '/', 'icon' => 'icon-home'],
        'elements' => [
            'submenu' => [
                'features' =>  [
                    'submenu' => [
                        'buttons' => ['url' => '/components/buttons', 'icon' => 'icon-layers', 'title' => 'Botones'],
                        'icons' => ['url' => '/components/icons', 'icon' => 'icon-layers', 'title' => 'Iconografía'],
                        'tabs' => ['url' => '/components/tabs', 'icon' => 'icon-layers'],
                    ],
                    'title' => 'Caracteristicas',
                    'icon' => 'icon-diamond',
                ],
                'components' =>  [
                    'submenu' => [

                    ],
                    'title' => 'Componentes',
                    'icon' => 'icon-puzzle',
                ],

                'forms' =>  [
                    'submenu' => [
                        'fields' => ['url' => '/forms/fields', 'icon' => 'icon-layers', 'title' => 'Input Fields'],
                        'validation' => ['url' => '/forms/validation', 'icon' => 'icon-layers', 'title' => 'Validaciones'],
                    ],
                    'title' => 'Formularios',
                    'icon' => 'icon-settings',
                ], //ok

                'elements' =>  [
                    'submenu' => [

                    ],
                    'title' => 'Elementos',
                    'icon' => 'icon-bulb',
                ],

                'tables' =>  [
                    'submenu' => [
                        'datatables' => ['url' => '/components/datatables', 'icon' => 'icon-layers'],
                    ],
                    'title' => 'Tablas',
                    'icon' => 'icon-briefcase',
                ], //ok
                'portlets' =>  [
                    'submenu' => [
                        'portlet' => ['url' => '/components/portlet', 'icon' => 'icon-layers',],
                    ],
                    'title' => 'Portlets',
                    'icon' => 'icon-wallet',
                ],

                'charts' =>  [
                    'submenu' => [

                    ],
                    'title' => 'Graficas',
                    'icon' => 'icon-bar-chart',
                ],
                'maps' =>  [
                    'submenu' => [

                    ],
                    'title' => 'Mapas',
                    'icon' => 'icon-pointer',
                ],

                'sidebar' =>  [
                    'submenu' => [
                        'sidebar' => ['url' => '/components/sidebar', 'icon' => 'icon-layers'],
                    ],
                    'title' => 'Barra lateral',
                    'icon' => 'icon-feed',
                ],
            ],
            'title' => 'Elementos',
            'icon' => 'fa fa-building-o',
        ],
        'acadspace' =>  [
            'submenu' => [

            ],
            'title' => 'Espacios académicos ',
            'icon' => 'fa fa-graduation-cap',
        ],
        'audiovisuals' =>  [
            'submenu' => [
                
            ],
            'title' => 'Audiovisuales ',
            'icon' => 'fa fa-desktop',
        ],
        'carpark' =>  [
            'submenu' => [

            ],
            'title' => 'Parqueadero',
            'icon' => 'fa fa-car',
        ],
        'financial' =>  [
            'submenu' => [

            ],
            'title' => 'Financiero ',
            'icon' => 'fa fa-industry',
        ],
        'unvinteraction' =>  [
            'submenu' => [

            ],
            'title' => 'Interacción Universitaria ',
            'icon' => 'icon-feed',
        ],
        'humtalent' =>  [
            'submenu' => [
                'registrar' => ['url' => 'talento-humano/rrhh/create','icon' => 'fa fa-users', 'title' => 'Registrar Usuario'],
                'consultar' => ['url' => 'talento-humano/rrhh/show','icon' => 'fa fa-book', 'title' => 'Consultar Usuario'],
                'regDoc'    => ['url' => 'talento-humano/Document/create','icon' => 'fa fa-book', 'title' => 'Registrar Documento'],
                'ConsDoc'    => ['url' =>'talento-humano/Document','icon' => 'fa fa-book', 'title' => 'Consultar Documentos'],
            ],
            'title' => 'Talento Humano ',
            'icon' => 'fa fa-group',
        ],
        'calisoft' =>  [
            'submenu' => [
                'usuarios' => ['url' => '#', 'icon' => 'fa fa-users', 'title' => 'Usuarios'],
                'peticiones' => ['url' => '#', 'icon' => 'fa fa-university', 'title' => 'Peticiones'],
                'proyectos' => ['url' => '#', 'icon' => 'fa fa-folder-open', 'title' => 'Proyectos'],
                'categorias' => ['url' => '#', 'icon' => 'fa fa-pie-chart', 'title' => 'Categorias'],
                'documentos' => ['url' => '#', 'icon' => 'fa fa-book', 'title' => 'Documentos'],
                'semilleros' => ['url' => '#', 'icon' => 'fa fa-gears', 'title' => 'Semilleros']
            ],
            'title' => 'Calisoft ',
            'icon' => 'fa fa-archive',
        ],

        'gesap' =>  [
            'submenu' => [

            ],
            'title' => 'Gesap ',
            'icon' => 'fa fa-cube',
        ],
        'sportcit' =>  [
            'submenu' => [

            ],
            'title' => 'Escuelas Deportivas ',
            'icon' => 'fa fa-futbol-o',
        ],
    ],
];

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
        'components' => [
            'submenu' => [
                'buttons' => ['url' => '/components/buttons', 'icon' => 'icon-layers', 'title' => 'Botones'],
                'portlet' => ['url' => '/components/portlet', 'icon' => 'icon-frame',],
                'icons' => ['url' => '/components/icons', 'icon' => 'icon-social-dropbox', 'title' => 'Iconografía'],
                'sidebar' => ['url' => '/components/sidebar', 'icon' => 'icon-notebook'],
                'tabs' => ['url' => '/components/tabs', 'icon' => 'glyphicon glyphicon-list-alt'],
                'datatables' => ['url' => '/components/datatables', 'icon' => 'glyphicon glyphicon-list'],
            ],
            'title' => 'Componentes',
            'icon' => 'fa fa-building-o',
        ],
        'forms' => [
            'submenu' => [
                'fields' => ['url' => '/forms/fields', 'icon' => 'icon-layers', 'title' => 'Input Fields'],
                'validation' => ['url' => '/forms/validation', 'icon' => 'icon-layers', 'title' => 'Validaciones'],
            ],
            'title' => 'Formularios',
            'icon' => 'icon-book-open',
        ],
    ],

];

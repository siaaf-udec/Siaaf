{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Dashboard')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Dashboard')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', 'Breve descripción de la página')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Datatable Ajax'])

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
    <div class="clearfix">
    </div>
    <br>
        <br>
            <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="actions">
                            <a class="btn btn-simple btn-success btn-icon create" href="javascript:;">
                                <i class="fa fa-plus">
                                </i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <br>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'example-table-ajax'])
                        @slot('columns', [
                            '#' => ['style' => 'width:20px;'],
                            'id',
                            'Nombre',
                            'Nombre para Mostrar',
                            'Descripción',
                            'Acciones' => ['style' => 'width:90px;']
                        ])
                    @endcomponent
                    </div>
                </br>
            </br>
        </br>
    </br>
</div>
<div class="clearfix">
</div>
<div class="row">
    <div class="col-md-12">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade" id="modal-update-permission" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'from_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h1>
                            <i class="glyphicon glyphicon-thumbs-up">
                            </i>
                            Modificar Permiso
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::hidden('id_edit') !!}
                                                {!! Field::select(
                                                'Modulo',
                                                 $modules,
                                                ['name' => 'module_edit']) !!}
                                                {!! Field::text(
                                                    'name_edit',
                                                    ['label' => 'Nombre', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                    ['help' => 'Ingrese el Nombre', 'icon' => 'fa fa-user']) !!}
                                                {!! Field::text(
                                                    'display_name_edit',
                                                    ['label' => 'Nombre para Mostrar', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                    ['help' => 'Ingrese el Nombre para Mostrar', 'icon' => 'fa fa-user']) !!}
                                                {!! Field::textarea(
                                                    'description_edit',
                                                    ['label' => 'Descripción', 'max' => '100', 'min' => '2', 'auto' => 'off'],
                                                    ['help' => 'Ingrese la Descripción']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Modal -->
        <div aria-hidden="true" class="modal fade" id="modal-create-permission" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'from_permissions_create', 'class' => '', 'url' => '/forms']) !!}
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h1>
                            <i class="glyphicon glyphicon-thumbs-up">
                            </i>
                            Crear Permiso
                        </h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Field::select(
                                                'Modulo',
                                                 $modules,
                                                ['name' => 'module_create']) !!}
                                            {!! Field::text(
                                                'name_create',
                                                ['label' => 'Nombre', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese el Nombre', 'icon' => 'fa fa-user']) !!}
                                            {!! Field::text(
                                                'display_name_create',
                                                ['label' => 'Nombre para Mostrar', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                                                ['help' => 'Ingrese el Nombre para Mostrar', 'icon' => 'fa fa-user']) !!}
                                            {!! Field::textarea(
                                                'description_create',
                                                ['label' => 'Descripción', 'max' => '100', 'min' => '2', 'auto' => 'off'],
                                                ['help' => 'Ingrese la Descripción']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endcomponent
@endsection

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
</script>
@endpush

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /*
         * Referencia https://datatables.net/reference/option/
         */
        var table, url, columns;
        table = $('#example-table-ajax');
        url = "{{ route('permissions.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: 'name', name: 'Nombre'},
            {data: 'display_name', name: 'Nombre para Mostrar'},
            {data: 'description', name: 'Descripción'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);

        table = table.DataTable();
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();

            var route = '{{ route('permissions.destroy') }}'+'/'+dataTable.id;
            var type = 'DELETE';
            var async = async || false;

            $.ajax({
                url: route,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                cache: false,
                type: type,
                contentType: false,
                processData: false,
                async: async,
                beforeSend: function () {

                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        table.ajax.reload();
                        UIToastr.init(xhr , response.title , response.message  );
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'success') {
                        UIToastr.init(xhr, response.title, response.message);
                    }
                }
            });


        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');

            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('permissions.edit') }}'+ '/'+ dataTable.id;

            $.get( route_edit, function( info ) {
                $('input[name="id_edit"]').val(info.data.id);
                $('select[name="module_edit"]').val(info.data.module_id);
                $('#name_edit').attr('value', info.data.name);
                $('#display_name_edit').attr('value', info.data.display_name);
                $('#description_edit').val(info.data.description);
                $('#modal-update-permission').modal('toggle');
            });


        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-permission').modal('toggle');
        });

        /*Editar Permiso*/
        var updatePermissions = function () {
            return{
                init: function () {
                    var id_edit = $('input[name="id_edit"]').val();
                    var route = '{{ route('permissions.update') }}'+'/'+id_edit;
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('name', $('input:text[name="name_edit"]').val());
                    formData.append('display_name', $('input:text[name="display_name_edit"]').val());
                    formData.append('description', $('#description_edit').val());
                    formData.append('module_id', $('select[name="module_edit"]').val());

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-update-permission').modal('hide');
                                $('#from_permissions_update')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        /*Crear Permissions*/
        var createPermissions = function () {
            return{
                init: function () {
                    var route = '{{ route('permissions.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('name', $('input:text[name="name_create"]').val());
                    formData.append('display_name', $('input:text[name="display_name_create"]').val());
                    formData.append('description', $('#description_create').val());
                    formData.append('module_id', $('select[name="module_create"]').val());

                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-create-permission').modal('hide');
                                $('#from_permissions_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr , response.title , response.message  );
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };


        var form_edit = $('#from_permissions_update');
        var rules_edit = {
            name_edit: { minlength: 5, required: true },
            display_name_edit: { minlength: 5, required: true },
            description_edit: { minlength: 5 },
            module_edit: { required: true }
        };
        FormValidationMd.init(form_edit,rules_edit,false,updatePermissions());

        var form_create = $('#from_permissions_create');
        var rules_create = {
            name_create: { minlength: 5, required: true },
            display_name_create: { minlength: 5, required: true },
            description_create: { minlength: 5 },
            module_create: { required: true }
        };
        FormValidationMd.init(form_create,rules_create,false,createPermissions());

    });
</script>
@endpush

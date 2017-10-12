@extends('material.layouts.dashboard')

@push('styles')

<!-- MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<!-- DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Aulas'])
    <div class="clearfix">
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="actions">
                <a class="btn btn-outline dark create" data-toggle="modal">
                    <i class="fa fa-plus">
                    </i>
                    Registrar
                </a>


            </div>
        </div>
    </div>
    <div class="clearfix">
    </div>
    <br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
            @slot('columns', [
            '#' => ['style' => 'width:20px;'],
            'id_incidente',
            'Codigo',
            'Nombre Espacio',
            '',
            'Acciones' => ['style' => 'width:45px;']

            ])
        @endcomponent
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12">
            {{-- BEGIN HTML MODAL CREATE --}}
            <!-- responsive -->
            <div class="modal fade" data-width="760" id="modal-create-soft" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-tv">
                        </i>
                        Registrar Incidente
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'form_soft', 'class' => '', 'url'=>'/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">

                            {!! Field:: text('id_persona',null,
                            ['label'=>'Codigo:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                            ['help' => 'Digita el codigo o identificacion de la persona','icon'=>'fa fa-user'] ) !!}

                            {!! Field::select('espacios',
                                ['Aulas de Computo' => 'Aulas de Computo', 'Laboratorio psicologia' => 'Laboratorio psicologia', 'Ciencias agropecuarias y ambientales' => 'Ciencias agropecuarias y ambientales'],
                                null,
                                [ 'label' => 'Seleccionar un espacio']) !!}

                            {!! Field:: textarea('descripcion',null,
                                 ['label'=>'Descripcion Incidente:','class'=> 'form-control', 'rows'=>'3', 'autofocus','autocomplete'=>'off'],
                                 ['help' => 'Digita la descripcion','icon'=>'fa fa-desktop'] ) !!}

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>
                {!! Form::close() !!}
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>


        {{-- END HTML MODAL CREATE--}}
    </div>
</div>
@endcomponent
</br>
</br>
</br>
</br>

</div>
{{-- END HTML SAMPLE --}}
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
<!-- SCRIPT SELECT -->
{{--<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>--}}
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<!-- SCRIPT MENSAJES TOAST-->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
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
<!--HANDLEBAR-->
<script src="{{ asset('assets/main/acadspace/js/handlebars.js') }}"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">    </script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">    </script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">   </script>

<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td>Descripcion:</td>
            <td>@{{INC_descripcion}}</td>
        </tr>
        <tr>
            <td>Fecha:</td>
            <td>@{{created_at}}</td>
        </tr>
    </table>
</script>

<script>

    /*PINTAR TABLA*/
    $(document).ready(function()
    {
        var template = Handlebars.compile($("#details-template").html());
        var table, url, columns;
        //Define que tabla cargara los datos
        table = $('#art-table-ajax');
        url = "{{ route('espacios.academicos.incidente.data') }}"; //url para cargar datos
        columns = [
            //Carga los datos que ha traido el control
            {data: 'DT_Row_Index'},
            {data: 'PK_INC_id_incidente', name: 'id_incidente', "visible": false},
            {data: 'FK_INC_id_user', name: 'Codigo'},
            {data: 'INC_nombre_espacio', name: 'Nombre Espacio'},
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '<a href="javascript:;" class="btn btn-simple btn-info" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
            },
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
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



        /*ELIMINAR REGISTROS*/
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log( dataTable.id );
            var route = '{{ route('espacios.academicos.incidente.destroy') }}'+'/'+dataTable.PK_INC_id_incidente;
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

        /*Inicio detalles desplegables*/
        $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(template(row.data())).show();
                tr.addClass('shown');
            }
        });
        /*Fin detalles de solicitud*/

        /*ABRIR MODAL*/
        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-create-soft').modal('toggle');
        });
        /*CREAR AULA CON VALIDACIONES*/
        var createPermissions = function () {
            return{
                init: function () {
                    var route = '{{ route('espacios.academicos.incidente.regisIncidente') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('FK_INC_id_user', $('input:text[name="id_persona"]').val());
                    formData.append('INC_nombre_espacio', $('select[name="espacios"]').val());
                    formData.append('INC_descripcion', $('textarea[name="descripcion"]').val());

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
                                $('#modal-create-soft').modal('hide');
                                $('#form_soft')[0].reset(); //Limpia formulario
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


        var form_edit = $('#form_soft');
        var rules_edit = {
            id_persona: { minlength: 9, required: true, number: true },
            descripcion: { required: true },
            espacios: {required: true}
        };
        FormValidationMd.init(form_edit,rules_edit,false,createPermissions());


    });

</script>
@endpush
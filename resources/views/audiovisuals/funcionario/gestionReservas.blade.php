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

 <!--DATATIME -->
 <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Styles DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
<!-- STYLES SELECT -->
<link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
<!-- STYLES TOAST-->
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
@section('title', '| Gestion Reservas')

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
@section('page-title', 'Gestion Reservas')
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

@section('page-description', 'Solicita y Cancela una reserva')

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
    {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Reservas Realizadas'])
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
                                Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                </div>
                <br>
                    <div class="col-md-12">
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'fun-table-ajax'])
                            @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Nombre Articulo',
                                'Fecha Inicio',
                                'Fecha Fin',
                                'Estado',
                                'Acciones' => ['style' => 'width:90px;']
                            ])
                        @endcomponent
                    </div>
                    <div class="clearfix">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        {{-- BEGIN HTML MODAL CREATE --}}
                        <!-- responsive -->
                            <div class="modal fade" data-width="680" id="modal-create-reserva" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                                    </button>
                                    <h2 class="modal-title">
                                        <i class="glyphicon glyphicon-tv">
                                        </i>
                                        Registrar Tipo De articulo
                                    </h2>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_art_tipo_create', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                {!! Field::text('TPART_Nombre',
                                                ['label' => 'Tipo Articulo:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                                ['help' => 'Ingrese Tipo articulo ejemplo: Computador, Cable', 'icon' => 'fa fa-info'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text(
                                                    'Fecha_Recibir_Reserva',
                                                    ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                                    ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                                !!}
                                            </p>
                                            <p>
                                                {!! Field::text(
                                                    'Fecha_Devolver_Reserva',
                                                    ['class' => 'timepicker date-time-picker', 'required', 'auto' => 'off'],
                                                    ['help' => 'Selecciona la fecha y hora.', 'icon' => 'fa fa-calendar'])
                                                !!}
                                            </p>
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
                        <div class="col-md-12">
                            {{-- BEGIN HTML MODAL CREATE --}}
                            <!-- static -->
                            <div class="modal fade" data-backdrop="static" data-keyboard="false" id="static" tabindex="-1">
                                <div class="modal-header modal-header-success">
                                    <h3 class="modal-title">
                                        <i class="glyphicon glyphicon-user">
                                        </i>
                                        Seleccionar Programa
                                    </h3>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['id' => 'from_programa', 'class' => '', 'url' => '/forms']) !!}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>
                                                {!! Field::select('Seleccione Programa',$programas,    
                                ['name' => 'FK_FUNCIONARIO_Programa'])
                                !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                </div>
                                {!! Form::close() !!}
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
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
</script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
<!-- SCRIPT SELECT -->
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Maxlength -->
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript">
</script>
<!-- SCRIPT Validacion Personalizadas -->
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript">
</script>
<!-- SCRIPT MENSAJES TOAST-->
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
<!-- Estandar Validacion -->
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
</script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
</script>
<script type="text/javascript">
    $( document ).scroll(function(){
        $('#modal-create-reserva .timepicker').datetimepicker('place'); //#modal is the id of the modal
    });
    jQuery(document).ready(function() {
        $(function() {
            $('#Fecha_Recibir_Reserva').datetimepicker({
            }

            );
        });
        $(function() {
            $('#Fecha_Devolver_Reserva').datetimepicker();
        });
        ComponentsSelect2.init();
       // $('#static').modal('toggle');
        //consulta si el programa esta seleccionado o esta vacio    
        var route_modal = '{{ route('funcionario.modal') }}';
         $.get( route_modal, function( info ) {
                 console.log(info);
                 if(info==0){
                     $('#static').modal('toggle');
                 }
        });
        //DATATABLE
        var table, url, columns;
        table = $('#fun-table-ajax');
        url = "{{ route('funcionario.reserva') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PRT_FK_Articulos_id', name: 'Nombre' },
            {data: 'PRT_Fecha_Inicio', name: 'Fecha Inicio'},
            {data: 'PRT_Fecha_Fin', name: 'Fecha Fin'},
            {data: 'PRT_FK_Estado', name: 'Estado'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove" data-toggle="confirmation"><i class="icon-trash"></i></a>',
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
        //dataTableServer.init(table, url, columns);

        table = table.DataTable();
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var adminId= dataTable.PK_ADMIN_Cedula;
            deleteAdmin(adminId);   


        });
        function deleteAdmin(adminId){
            
            var route = '{{ route('administrador.destroy') }}'+'/'+adminId;
            var type = 'DELETE';
            var async = async || false;
            swal({
              title: "¿Esta seguro?", 
              text: "¿Seguro que quiere cancelar esta Reserva?", 
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              confirmButtonText: "Si, eliminar",
              confirmButtonColor: "#ec6c62",
              confirmButtonClass: "btn blue",
              cancelButtonText: "Cancelar",
              cancelButtonClass: "btn red",
            },function() {
              
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
                    })
                  .done(function(data) {
                    swal("Eliminado", "El administradir se ha eliminado correctamente", "success");
                  })
                  .error(function(data) {
                    swal("Oops", "No pudimos conectar con el servidor", "error");
                  });
                });  
        }
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
                route_edit = '{{ route('administrador.edit') }}'+ '/'+ dataTable.PK_ADMIN_Cedula;
           
            $.get( route_edit, function( info ) {   
                console.log(info);
                $('input[name="id_edit"]').val(info.data.PK_ADMIN_Cedula);
                $('input:text[name="PK_ADMIN_Cedula_editar"]').val(info.data.PK_ADMIN_Cedula);
                $('input:text[name="ADMIN_Nombres_editar"]').val(info.data.ADMIN_Nombres);
                $('input:text[name="ADMIN_Apellidos_editar"]').val(info.data.ADMIN_Apellidos);
                $('input:text[name="ADMIN_Estado_editar"]').val(info.data.ADMIN_Estado);
                $('input:text[name="ADMIN_Direccion_editar"]').val(info.data.ADMIN_Direccion);
                $('#ADMIN_Correo_editar').val(info.data.ADMIN_Correo);
                $('#ADMIN_Clave_editar').val(info.data.ADMIN_Clave);
                $('#ADMIN_RClave_editar').val(info.data.ADMIN_Clave);
                $('#ADMIN_Telefono_editar').val(info.data.ADMIN_Telefono);
                $('#modal-update-admin').modal('toggle');

                 
            });                 
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();

            $('#modal-create-reserva').modal('toggle');

        });
        var createPrograma = function () {
            return{
                init: function () {
                    //aqui toca guardar eso con auth id
                    var route = '{{ route('funcionario.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    //formData.append('id', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                    formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                    
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
                                //table.ajax.reload();
                                $('#static').modal('hide');
                                $('#from_programa')[0].reset(); //Limpia formulario
                                //$(":password").pwstrength("forceUpdate");
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

        var form_create = $('#from_programa');
        var rules_create = {
          
            FK_FUNCIONARIO_Programa:{required: true}
        };
        FormValidationMd.init(form_create,rules_create,false,createPrograma());


    });
    
    var ComponentsSelect2 = function() {

        var handleSelect = function() {

            $.fn.select2.defaults.set("theme", "bootstrap");
            var placeholder = "<i class='fa fa-search'></i>  " + "Seleccionar";
            $(".pmd-select2").select2({
                width: null,
                placeholder: placeholder,
                escapeMarkup: function(m) { 
                   return m; 
                }
            });

        }

        return {
            init: function() {
                handleSelect();
            }
        };

    }();
</script>
@endpush

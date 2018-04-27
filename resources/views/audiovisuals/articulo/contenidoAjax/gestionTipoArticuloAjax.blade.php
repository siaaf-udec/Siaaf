
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestión Tipo Artículo'])
    @slot('actions', [
      'link_cancel' => [
      'link' => '',
      'icon' => 'fa fa-arrow-left',
     ],
    ])
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade" data-width="380" id="modal-create-tipo" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-edit">
                        </i>
                        Detalles Tipo Artículo
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'from_art_tipo_create', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('TPART_Nombre',
                                   ['label' => 'Tipo Artículo:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                   ['help' => 'Ingrese Tipo artículo ejemplo: Computador, Cable', 'icon' => 'fa fa-info'])
                               !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::select('Seleccione una Opcion',
                                     [
                                2 => 'Asignado',
                                1 => 'Libre'
                             ],
                                ['name' => 'TPART_Tiempo'])

                             !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::Text('TPART_HorasMantenimiento',
                                   ['label' => 'Horas Mantenimiento:', 'max' => '10', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                   ['help' => 'Ingrese Horas de mantenimiento presupuestadas para el articulo', 'icon' => 'fa fa-info'])
                            !!}
                        </div>
                        <div class="row">
                            <div class="col-md-12" align="center">
                                {!! Form::submit('CREAR', ['class' => 'btn blue']) !!}
                                {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                </div>
            </div>
            {{-- END HTML MODAL CREATE--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade" data-width="500" id="modal-edit-tipo" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-edit">
                        </i>
                        Detalles Tipo Artículo Editar
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'from_art_tipo_edit', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {!! Field::text('TPART_Nombre_Edit',
                                   ['label' => 'Tipo Artículo:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                   ['help' => 'Ingrese Tipo artículo ejemplo: Computador, Cable', 'icon' => 'fa fa-info'])
                               !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::select('Seleccione una Opcion',
                                     [
                                2 => 'Asignado',
                                1 => 'Libre'
                             ],
                                ['name' => 'TPART_Tiempo_Edit'])
                             !!}
                        </div>
                        <div class="col-md-12">
                            {!! Field::Text('TPART_HorasMantenimiento_Edit',
                                   ['label' => 'Horas Mantenimiento:', 'max' => '10', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'1'],
                                   ['help' => 'Ingrese Horas de mantenimiento presupuestadas para el articulo', 'icon' => 'fa fa-info'])
                            !!}
                        </div>
                        <div class="col-md-12" align="center">

                                {!! Form::submit('MODIFICAR', ['class' => 'btn blue']) !!}
                                {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            @permission("AUDI_ART_TYPE_CREATE")
            <div class="actions">
                <a class="btn btn-outline dark createTipoArticulo" data-toggle="modal">
                    <i class="fa fa-plus">
                    </i>
                    Crear Tipo Artículo
                </a>
            </div>
            @endpermission
        </div>
    </div>
    <div class="clearfix"></div>
    <br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'tipoArt-table-ajax'])
            @slot('columns', [
                'Tipo',
                'Cantidad Artículos',
                'Tiempo',
                'Horas Mantenimiento',
                'Acciones' => ['style' => 'width:90px;']
            ])
        @endcomponent
    </div>
    <div class="clearfix"></div>
@endcomponent
<script>
    var table, url, columns;

    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function () {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    $(document).ready(function () {
        App.unblockUI('.portlet-form');
        var idTipoArticulo;
        ComponentsBootstrapMaxlength.init();

        table = $('#tipoArt-table-ajax');
        url ="{{ route('listarTipoArticulos.data') }}";
        columns = [
            {data: 'TPART_Nombre' , name: 'TPART_Nombre'},
            {data: 'consultar_articulos_count' , name: 'consultar_articulos_count'},
            {data: 'Tiempo' , name: 'Tiempo'},
            {data: 'TPART_HorasMantenimiento' , name: 'TPART_HorasMantenimiento'},
            {
                defaultContent: '@permission("AUDI_ART_TYPE_EDIT")<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission' +
                                '@permission("AUDI_ART_TYPE_DELETE")<a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission',
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        $('.createTipoArticulo').on('click',function(e){
            e.preventDefault();
            swal({
                    title :"INFORMACION",
                    text: "Al crear un nuevo tipo de artículo , tiene la" +
                    " opción de seleccionar un tiempo(item )",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Continuar",
                    cancelButtonText: "Consultar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $('#from_art_tipo_create')[0].reset();
                        $('#modal-create-tipo').modal('toggle');

                    } else {
                        var route = '{{ route('audiovisuales.gestionArticulos.ValidacionesAjax') }}';
                        $(".content-ajax").load(route);
                    }
                });

        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable);
            $('#TPART_Nombre_Edit').val(dataTable.TPART_Nombre);
            $('select[name="TPART_Tiempo_Edit"]').val(dataTable.TPART_Tiempo);
            $('#TPART_HorasMantenimiento_Edit').val(dataTable.TPART_HorasMantenimiento);
            if(dataTable.consultar_articulos_count!=0){
                $("#TPART_Nombre_Edit").prop("disabled", true);
            }else{
                $("#TPART_Nombre_Edit").removeAttr('disabled');
            }
            idTipoArticulo = parseInt(dataTable.id);
            $('#modal-edit-tipo').modal('toggle');
        });
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            if(parseInt((dataTable.consultar_articulos_count))==0){
                swal({
                        title: "Esta Seguro De eliminar?",
                        text: "Este Tipo De Artículo será eliminado!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "si",
                        cancelButtonText: "No",
                        closeOnConfirm: true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            var route = '{{ route('tipoArticuloEliminarA') }}'+'/'+dataTable.id;
                            var type = 'POST';
                            $.ajax({
                                url: route,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                cache: false,
                                type: type,
                                contentType: false,
                                processData: false,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        table.ajax.reload();
                                        UIToastr.init(xhr , response.title , response.message  );
                                        App.unblockUI('.portlet-form');
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 &&  xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                    }
                                }
                            });
                        }
                    });

            }else{
                swal(
                    'Oops...',
                    'Lo sentimos este tipo de articulo tiene relacion con una cierta cantidad de articulos crados!',
                    'error'
                )
            }
        });
        var modificarTipo = function () {
            return{
                init: function () {
                    var route = '{{ route('audiovisuales.articulo.modificarTipo') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('id',idTipoArticulo);
                    formData.append('TPART_Nombre', $('input:text[name="TPART_Nombre_Edit"]').val());
                    formData.append('TPART_Tiempo', $('select[name="TPART_Tiempo_Edit"]').val());
                    formData.append('TPART_HorasMantenimiento', $('input:text[name="TPART_HorasMantenimiento_Edit"]').val());

                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                swal(
                                    "Modificar!",
                                    "los artículos que se encuentran en alguna solicitud ," +
                                    " se actualizarán en la siguiente solicitud", "success"
                                );
                                $('#modal-edit-tipo').modal('hide');
                                UIToastr.init(xhr , response.title , response.message  );
                                $('#from_art_tipo_edit')[0].reset();
                                table.ajax.reload();
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }
                    });
                }
            }
        };
        var form_art_tipo_edit = $('#from_art_tipo_edit');
        var rules_art_tipo_create = {
            TPART_Nombre_Edit: {
                minlength: 3, required: true, remote: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('tipoArticulo.validar') }}",
                    type: "post"
                }
            },
            TPART_Tiempo_Edit: {required: true},
            TPART_HorasMantenimiento_Edit: {required: true, number: true,maxlength: 10},


        };
        var messages = {
            TPART_Nombre_Edit: {
                remote: 'El Nombre de Tipo de Artículo ya está en uso.'
            }
        };

        FormValidationMd.init(form_art_tipo_edit, rules_art_tipo_create, messages,modificarTipo());
        var createTipoArticulo = function () {
            return {
                init: function () {
                    var route = '{{ route('tipoArticulos.store') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('TPART_Nombre', $('input:text[name="TPART_Nombre"]').val());
                    formData.append('TPART_Tiempo', $('select[name="TPART_Tiempo"]').val());
                    formData.append('TPART_HorasMantenimiento', $('input:text[name="TPART_HorasMantenimiento"]').val());
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
                            App.blockUI({target: '.portlet-form', animate: true});
                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#modal-create-tipo').modal('hide');
                                $('#from_art_tipo_create')[0].reset(); //Limpia formulario
                                UIToastr.init(xhr, response.title, response.message);
                                table.ajax.reload();
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 &&  xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }
                    });
                }
            }
        };
        var form_art_tipo_create = $('#from_art_tipo_create');
        var rules_art_tipo_create = {
            TPART_Nombre: {
                minlength: 3, required: true, remote: {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{ route('tipoArticulo.validar') }}",
                    type: "post"
                }
            },
            TPART_Tiempo: {required: true},
            TPART_HorasMantenimiento: {required: true, number: true,maxlength: 10}

        };
        var messages = {
            TPART_Nombre: {
                remote: 'El Nombre de Tipo de Articulo ya esta en uso.'
            }
        };

        FormValidationMd.init(form_art_tipo_create, rules_art_tipo_create, messages, createTipoArticulo());
        $("#from_art_tipo_create").validate({
            onkeyup: false
        });
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionArticulos.indexAjax') }}';
            $(".content-ajax").load(route);
        });
        swal("Tipo Artículo!", "Solo podrá ser elminado el " +
            "tipo del artículo , si este no posee mas de una cantidad de artículos");
    });

</script>
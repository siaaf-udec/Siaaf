<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Historial Artículos'])
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" data-width="760" id="modal-mantenimiento-art" tabindex="-1">
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        </button>
                        <h2 class="modal-title">
                            <i class="glyphicon glyphicon-cog">
                            </i>
                            Registrar Observacion Solicitud Mantenimiento
                        </h2>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['id' => 'from_mantenimiento_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    {!! Field::text('TMT_Observacion_Realiza',
                                    ['label' => 'Observacion mantenimiento:', 'required','max' => '255'],
                                    ['help' => 'Ingrese una Observacion para el mantenimiento', 'icon' => 'fa fa-heartbeat'])
                                    !!}
                                </p>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12" align="center">
                                {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                                {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    @permission("AUDI_REQUEST_MAINTENANCE_VIEW")
                    <a class="btn btn-outline dark requestMaintenance" data-toggle="modal">
                        <i class="fa fa-wrench">
                        </i>
                        Artículos en Mantenimiento
                    </a>
                    @endpermission
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'mtn-table-ajax'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'Nombre',
                        'Codigo',
                        'Horas Mantenimiento Preventivo',
                        'Mantenimientos Realizados',
                        'Horas Total Uso',
                        'Acciones' => ['style' => 'width:100px;']
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>

<script>
    var table, url, columns;
    var idArticulo,tipoArticuloNombre;
    var ComponentsSelect2 = function () {
        return {
            init: function () {
                $.fn.select2.defaults.set("theme", "bootstrap");
                $(".pmd-select2").select2({
                    placeholder: "Selecccionar",
                    allowClear: true,
                    width: 'auto',
                    escapeMarkup: function (m) {
                        return m;
                    }
                });
            }
        }
    }();
    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function () {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    $(document).ready(function () {
        App.unblockUI('.portlet-form');
        ComponentsBootstrapMaxlength.init();
        ComponentsSelect2.init();
        table = $('#mtn-table-ajax');
        url = "{{ route('listarMantenimientos.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'consulta_articulos.consulta_tipo_articulo.TPART_Nombre', name: 'Tipo'},
            {data: 'consulta_articulos.ART_Codigo', name: 'Codigo'},
            {data: 'consulta_articulos.consulta_tipo_articulo.TPART_HorasMantenimiento', name: 'HorasMantenimiento'},
            {data: 'consulta_articulos.ART_Cantidad_Mantenimiento', name: 'consulta_articulos.ART_Cantidad_Mantenimiento'},
            {data: 'horasUso', name: 'Kit'},
            {
                defaultContent: '@permission("AUDI_MAINTENANCE_CREATE")<a title="Solicitar Mantenimiento" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="glyphicon glyphicon-send"></i></a>@endpermission' ,

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
        table.on('click', '.create', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable);
            idArticulo = dataTable.consulta_articulos.id;
            tipoArticuloNombre = dataTable.consulta_articulos.consulta_tipo_articulo.TPART_Nombre;
            //console.log('nombre-'+tipoArticuloNombre );
            $('#modal-mantenimiento-art').modal('toggle');
        });
        var createMantenimiento = function () {
            return {
                init: function () {
                    var route = '{{ route('registrar.mantenimiento') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    //console.log('envio nombre'+tipoArticuloNombre);
                    formData.append('TMT_Tipo_Articulo',tipoArticuloNombre);
                    formData.append('TMT_FK_Id_Articulo',idArticulo);
                    formData.append('TMT_Observacion_Realiza', $('#TMT_Observacion_Realiza').val());
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
                                $('#modal-mantenimiento-art').modal('hide');
                                $('#from_mantenimiento_create')[0].reset();
                                table.ajax.reload();
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function (response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        }
                    });
                }
            }
        };
        var from_mantenimiento_create = $('#from_mantenimiento_create');
        var rules_mantenimiento_create = {
            TMT_Observacion_Realiza :{ required: true},
        };
        FormValidationMd.init(from_mantenimiento_create, rules_mantenimiento_create, false, createMantenimiento());
        $('.requestMaintenance').on('click',function(e){
            e.preventDefault();
            var route = '{{ route('audiovisuales.gestionMantenimientoAjax') }}';
            $(".content-ajax").load(route);
        })
    });
</script>


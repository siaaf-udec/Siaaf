
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestión Mantenimiento Artículos'])
    @slot('actions', [
      'link_cancel' => [
      'link' => '',
      'icon' => 'fa fa-arrow-left',
     ],
    ])
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade" data-width="760" id="modal-mantenimiento-art" tabindex="-1">
                <div class="modal-header modal-header-success">
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    </button>
                    <h2 class="modal-title">
                        <i class="glyphicon glyphicon-cog">
                        </i>
                        Registrar Observacion Finalización Mantenimiento
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'from_mantenimiento_create', 'class' => '', 'url' => '/forms']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                {!! Field::text('TMT_Observacion_Finaliza',
                                ['label' => 'Observación Finalización mantenimiento:', 'required','max' => '255'],
                                ['help' => 'Ingrese una Observación para Finalizar el mantenimiento', 'icon' => 'fa fa-heartbeat'])
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
    <div class="clearfix"></div>
    <br>
    <br>
    <br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'tipoArt-table-ajax'])
            @slot('columns', [
                'Tipo Articulo',
                'Codigo',
                'Observacion Mantenimiento',
                'Observacion Finalización ',
                'Acciones' => ['style' => 'width:100px;']
            ])
        @endcomponent
    </div>
    <div class="clearfix"></div>
@endcomponent
<script>
    var table, url, columns;
    var idMantenimiento;
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
        url ="{{ route('listar.Mantenimientos.Solicitados.data') }}";
        columns = [
            {data: 'TMT_Tipo_Articulo' , name: 'TMT_Tipo_Articulo'},
            {data: 'consultar_articulo.ART_Codigo' , name: 'consultar_articulo.ART_Codigo'},
            {data: 'TMT_Observacion_Realiza' , name: 'TMT_Observacion_Realiza'},
            {data: 'TMT_Observacion_FinalizaO' , name: 'TMT_Observacion_FinalizaO'},
            {data: 'Acciones',name: 'Acciones'}
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        table.on('click', '.create', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            console.log(dataTable);
            idMantenimiento = dataTable.TMT_Id;
            idArticulo = dataTable.TMT_FK_Id_Articulo;
            $('#modal-mantenimiento-art').modal('toggle');
        });
        var createMantenimiento = function () {
            return {
                init: function () {
                    var route = '{{ route('finalizar.mantenimiento') }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('TMT_Id', idMantenimiento);
                    formData.append('TMT_FK_Id_Articulo',idArticulo);
                    formData.append('TMT_Observacion_Finaliza', $('#TMT_Observacion_Finaliza').val());
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
        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('mantenimiento.Articulos.Ajax') }}';
            $(".content-ajax").load(route);
        });

    });
</script>
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
    {{-- BEGIN HTML SAMPLE --}}
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Administradores'])
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
            <div class="clearfix">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'res-table-ajax'])
                        @slot('columns', [
                            '# Reservas' => ['style' => 'width:20px;'],
                            'Fecha Inicio',
                            'Fecha Fin',
                            'Acciones' => ['style' => 'width:90px;']
                        ])
                    @endcomponent
                </div>
            </div>
            @endcomponent
            </br>
            </br>
            </br>
            </br>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
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
            var ComponentsBootstrapMaxlength = function () {
                var handleBootstrapMaxlength = function() {
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
            var abrirModal = JSON.stringify({{$numero}});
            //sino se encuentran registros abrir el modal para registrar
            if( abrirModal == 0 ){
                $('#static').modal('toggle');
            }
            ComponentsSelect2.init();
            ComponentsBootstrapMaxlength.init();
            var $seleccione_un_tipoArticulo = $('select[name="PRT_FK_Articulos_id"]');
            //DATATABLE
            var table, url, columns;
            table = $('#res-table-ajax');
            url = "{{ route('funcionarioReservas.dataArticulo') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'PRT_Fecha_Inicio', name: 'FechaInicio'},
                {data: 'PRT_Fecha_Fin', name: 'FechaFin'},
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
            dataTableServer.init(table, url, columns);
            table = table.DataTable();
            /* abre modal con el formulario para registrar la reserva*/
            $( ".create" ).on('click', function (e) {
                e.preventDefault();
                var routeAjax = '{{route('opcionReservaArticuloAjax')}}';
                $(".content-ajax").load(routeAjax);
            });

            //inicio de registrar funcionario audivisuales con programa
            var createPrograma = function () {
                return{
                    init: function () {
                        var route = '{{ route('crearFuncionarioPrograma.storePrograma') }}';
                        var type = 'POST';
                        var async = async || false;
                        var formData = new FormData();
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
                                    $('#static').modal('hide');
                                    $('#from_programa')[0].reset();
                                    UIToastr.init(xhr , response.title , response.message  );
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 &&  xhr === 'error') {
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
    </script>


<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Etapa de ejecucion:'])
        <div class="row">
        <div class="col-md-12">
        <h4 style="margin-top: 0px;">Proceso: Efectuar las adquisiciones.</h4>
        <br>
        <div class="panel-group accordion" id="date-range">
                    <!--Primer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_1"><strong>CMMI:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Nivel de madurez:</strong> 3. <br><strong>Meta especifica:</strong> Validación.<br><strong>Propósito: </strong>El propósito de la Validación (VAL) es demostrar que 
                                un producto o componente de producto cumple con su uso previsto cuando se ubica en el entorno previsto.<br><strong>	Notas introductorias: </strong>Las actividades de validación 
                                se pueden aplicar a todos los aspectos del producto en cualquiera de sus entornos previstos, tales como operación, formación, fabricación, mantenimiento y servicios de soporte. 
                                Los métodos empleados para lograr la validación se pueden aplicar a productos de trabajo, así como al producto y los componentes de producto (en la totalidad de las áreas de proceso, 
                                cuando se utilizan los términos “producto” y “componente de producto”, los significados también abarcan los servicios, sistemas de servicios y sus componentes). Los productos de trabajo 
                                (p. ej., requisitos, diseños, prototipos) se deberían seleccionar sobre la base de cuáles son los que mejor predicen cómo el producto y el componente de producto satisfarán las necesidades 
                                del usuario final, y de esta manera la validación se realiza de forma temprana (fases de concepto/exploración) e incremental a lo largo del ciclo de vida del producto (incluyendo la 
                                transición a operaciones y soporte). El entorno de validación debería representar el entorno previsto para el producto y los componentes de producto, así como el entorno previsto adecuado 
                                para las actividades de validación con los productos de trabajo.<br><br>Preparar la validación.<br>- Seleccionar los productos para la validación.<br>-	Establecer el entorno de validación.
                                <br>- Establecer los procedimientos y los criterios de validación.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Segundo acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_2"><strong>SCRUM:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                    Roles Scrum que son necesarios para este proceso:<br><strong>Scrum Master:</strong>{{$equipoScrum[0]['CE_Nombre_Persona'] }}.<br><strong>Equipo desarrollo</strong>
                                    @foreach ($integrantes_equipo as $integrante)
                                    <br><strong>Integrante: </strong> {{$integrante->CE_Nombre_Persona}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Tercer acordeon-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#date-range" href="#collapse_3_3"><strong>PMBOK:</strong></a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="alert alert-primary">
                                <strong>Proceso:</strong> Efectuar las Adquisiciones.<br><br><strong>Efectuar las Adquisiciones: </strong>El proceso de obtener respuestas de los proveedores, seleccionarlos 
                                y adjudicarles un contrato.<br><br>La Gestión de las Adquisiciones del Proyecto incluye los procesos necesarios para comprar o adquirir productos, servicios o resultados que es preciso 
                                obtener fuera del equipo del proyecto. La organización puede ser la compradora o vendedora de los productos, servicios o resultados de un proyecto.<br>La Gestión de las Adquisiciones del 
                                Proyecto incluye los procesos de gestión del contrato y de control de cambios requeridos para desarrollar y administrar contratos u órdenes de compra emitidos por miembros autorizados del 
                                equipo del proyecto.<br>La Gestión de las Adquisiciones del Proyecto también incluye el control de cualquier contrato emitido por una organización externa (el comprador) que esté adquiriendo 
                                ntregables del proyecto a la organización ejecutora (el vendedor), así como la administración de las obligaciones contractuales contraídas por el equipo del proyecto en virtud del contrato.
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaProyectos'])
            @slot('columns', [
            '#',
            'Adquisicion',
            'Proveedor',
            'Tipo de contrato',
            ''
            ])
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div aria-hidden="true" class="modal fade" id="modal_create" role="dialog" tabindex="-1">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">×</button>
                            <h3>Adquisicion</h3>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
 
                                    {!! Field:: hidden ('idAdquisicion') !!} 

                                    {!! Field:: text('Nombre',null,['label'=>'Nombre adquisicion:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off', 'readonly'],
                                    ['help' => 'Digite el nombre de la adquisicion.', 'icon' => 'fa fa-tag'] ) !!}

                                    {!! Field:: text('Proveedor',null,['label'=>'Proveedor:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el proveedor', 'icon' => 'fa fa-user'] ) !!}

                                    {!! Field:: text('TipoContrato',null,['label'=>'Tipo de contrato:', 'max' => '50', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                    ['help' => 'Digite el tipo de contrato', 'icon' => 'fa fa-file-o'] ) !!}

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
    <div class="form-actions">
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                    <a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                                Cancelar
                            </a>
                        <a href="javascript:;" class="btn btn-success guardarProceso">
                            Continuar <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
    @endcomponent
</div>

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });

        var table, url, columns;
        table = $('#listaProyectos');
        url = "{{ route('calidadpcs.procesosCalidad.tablaAdquisiciones')}}"+"/"+ {{$idProyecto}};
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPGA_Adquisicion',
                name: 'CPGA_Adquisicion'
            },
            {
                defaultContent: '',
                data: 'CPGA_Proveedor',
                name: 'CPGA_Proveedor'
            },
            {
                defaultContent: '',
                data: 'CPGA_Tipo_Contrato',
                name: 'CPGA_Tipo_Contrato'
            },
            
            {
                defaultContent: '<a href="javascript:;" class="btn btn-success verEtapas"  title="Agreagar información" ><i class="fa fa-share-square-o"></i></a>',
                data: 'action',
                name: 'Acciones',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        table.on('click', '.verEtapas', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $('input:hidden[name="idAdquisicion"]').val(''+dataTable.PK_CPGA_Id_Adquisicion+'');
            $("#Nombre").val(dataTable.CPGA_Adquisicion);
            $("#Proveedor").val(dataTable.CPGA_Proveedor);
            $("#TipoContrato").val(dataTable.CPGA_Tipo_Contrato);
            $('#modal_create').modal('toggle');
        });

        var createModal = function () {
            return{
                init: function () {
                    var route = '{{ route('calidadpcs.procesosCalidad.storeProceso14') }}';
                    var type = 'POST';
                    var async = async || false;
                    
                    var formData = new FormData();
                    formData.append('idAdquisicion', $('input:hidden[name="idAdquisicion"]').val());
                    formData.append('Proveedor', $('input:text[name="Proveedor"]').val());
                    formData.append('TipoContrato', $('input:text[name="TipoContrato"]').val());

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
                                $('#modal_create').modal('hide');
                                $('#form_create')[0].reset(); //Limpia formulario
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

        var form = $('#form_create');
        var formRules = {
            Proveedor:{ required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false },
            TipoContrato:{ required: true, minlength: 2, maxlength: 50, noSpecialCharacters:true, letters:false },
        };
        var formMessage = {
            Proveedor: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
            TipoContrato: {noSpecialCharacters: 'Existen caracteres que no son válidos', letters: 'Los numeros no son válidos'},
        };
        FormValidationMd.init(form,formRules,formMessage,createModal());

        $(".guardarProceso").on('click', function(e) {
            e.preventDefault();
                var route = '{{ route('calidadpcs.procesosCalidad.storeProceso14_1') }}';
                    var type = 'POST';
                    var async = async ||false;
                    var formData = new FormData();
                    formData.append('Id_Proyecto', {{$idProyecto}});
                    formData.append('Id_Proceso', {{$idProceso}});
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (response.data == 422) {
                                xhr = "warning"
                                UIToastr.init(xhr, response.title, response.message);
                            } else {
                                if (request.status === 200 && xhr === 'success') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
                                }
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'error') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
        });

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('calidadpcs.proyectosCalidad.index.ajax') }}';
            location.href="{{route('calidadpcs.proyectosCalidad.index')}}";
        });
    });
</script> 
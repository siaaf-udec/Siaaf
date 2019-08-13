<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Cronograma:'])
    <br>
    <div class="row">
                <div class="col-md-12">

                    <div class="actions">
                        <a href="javascript:;"
                            class="btn btn-simple btn-success btn-icon create"
                            title="Crear un nuevo proyecto"><i class="glyphicon glyphicon-plus"></i>Agregar sprint</a>
                        <br>
                    </div>
                    <br>
                </div>
            </div>
    <div class="row">
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables',['id' => 'listaActividades'])
            @slot('columns', [
            '#',
            'Nombre Sprint',
            'Requerimientos',
            'Recurso',
            ''
            ])
            @endcomponent
        </div>
        <div class="col-md-12">
            <div class="note note-success">
                <h4 class="block">Tener en cuenta!</h4>
                <p> Recuerda que para avanzar deben estar completos los datos de la tabla</p>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12 col-md-offset-4">
                    @permission('CALIDADPCS_CREATE_PROJECT')<a href="javascript:;" class="btn btn-outline red button-cancel"><i class="fa fa-angle-left"></i>
                        Cancelar
                    </a>
                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                    @endpermission
                </div>
            </div>
        </div>

        <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row">
    <div class="col-md-12">
    <!-- Modal -->
    <div aria-hidden="true" class="modal fade" id="modal-update-permission" role="dialog" tabindex="-1">
            <div class="">
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'from_permissions_update', 'class' => '', 'url' => '/forms']) !!}
                    <div class="modal-header modal-header-success">
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                        <h1>
                            Crear sprint
                        </h1>
                        <h3>Numero de semanas disponibles: <span id="num"></span></h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                            {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Nombre del sprint:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
                            {!! Field::select('id', $requerimientos, null, ['label' => 'Seleccione los requerimientos', 'class' => 'bs-select form-control', 'multiple' => 'multiple' ]) !!}
                            
                            {!! Field:: number('numero_semanas',null,['label'=>'Numero de semanas:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['icon'=>'fa fa-file-text-o'] ) !!}

                            {!! Field:: text('CP_Nombre_Proyecto',null,['label'=>'Recurso:', 'max' => '40', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                            ['help' => 'Digite el nombre del proyecto.','icon'=>'fa fa-file-text-o'] ) !!}
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
</div>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<script type="text/javascript">
        var diasDiferencia;
    jQuery(document).ready(function() {
        //inicio fechas
        // console.log('{{$infoProyecto[0]['CP_Fecha_Inicio']}}');
        var fechaEmision = moment('{{$infoProyecto[0]['CP_Fecha_Inicio']}}');
        var fechaExpiracion = moment('{{$infoProyecto[0]['CP_Fecha_Final']}}');
        diasDiferencia = fechaExpiracion.diff(fechaEmision, 'weeks');
        console.log(diasDiferencia);
        $("#num").text(diasDiferencia);
        //fin fechas
        var table, url, columns;
        table = $('#listaActividades');
        url = "{{route('calidadpcs.procesosCalidad.tablaCronograma')}}" + "/" + '{{$infoProyecto[0]['PK_CP_Id_Proyecto']}}';
        columns = [{
                data: 'DT_Row_Index'
            },
            {
                data: 'CPC_Nombre_Sprint',
                name: 'CPC_Nombre_Sprint'
            },
            {
                data: 'CPC_Requerimiento',
                name: 'CPC_Requerimiento'
            },
            {
                data: 'CPC_Recurso',
                name: 'CPC_Recurso'
            },
            {
                defaultContent: '<a href="javascript:;" title="Editar" id="myb" class="btn btn-primary edit" ><i class="icon-pencil"></i></a>',
                data: 'action',
                name: 'action',
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

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-update-permission').modal('toggle');
            $tr = $(this).closest('tr');
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $('#modal-update-permission').modal('toggle');
            $tr = $(this).closest('tr');
            // var dataTable = table.row($tr).data(),
            //     route_edit = '{{ route('permissions.edit') }}'+ '/'+ dataTable.id;

            // $.get( route_edit, function( info ) {
            //     $('input[name="id_edit"]').val(info.data.id);
            //     $('select[name="module_edit"]').val(info.data.module_id);
            //     $('#name_edit').attr('value', info.data.name);
            //     $('#display_name_edit').attr('value', info.data.display_name);
            //     $('#description_edit').val(info.data.description);
            //     $('#modal-update-permission').modal('toggle');
            // });
        });
        jQuery.validator.addMethod("letters", function(value, element) {
            return this.optional(element) || /^[a-zñÑ," "]+$/i.test(value);
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
            return this.optional(element) || /^[A-Za-zñÑ0-9\d ]+$/i.test(value);
        });
        var createProyecto = function () {
            return {
                init: function () {
                    //var route = '{{ route('calidadpcs.proyectosCalidad.store') }}';
                    // var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    //Tabla Usuarios
                    console.log($('#id').val());


                    // formData.append('PK_CU_Id_Usuario', $('input:hidden[name="PK_CU_Id_Usuario"]').val());
                    // formData.append('CU_Cedula', $('input:hidden[name="CU_Cedula"]').val());
                    // formData.append('CU_Nombre', $('input:hidden[name="CU_Nombre"]').val());
                    // formData.append('CU_Apellido', $('input:hidden[name="CU_Apellido"]').val());
                    // formData.append('CU_Telefono', $('input:hidden[name="CU_Telefono"]').val());
                    // formData.append('CU_Correo', $('input:hidden[name="CU_Correo"]').val());
                    // //Tabla Proyectos
                    // formData.append('CP_Nombre_Proyecto', $('input:text[name="CP_Nombre_Proyecto"]').val());
                    // formData.append('CP_Fecha_Inicio', $('#CP_Fecha_Inicio').val());
                    // //formData.append('CP_Fecha_Final', $('#CP_Fecha_Final').val());
                    // formData.append('FK_CP_Id_Usuario', $('input:hidden[name="FK_CP_Id_Usuario"]').val());
                    
                   
                    

                }
            }
        };
        var form = $('#from_permissions_update');
        var formRules = {
            numero_semanas: {required: true, min: 1, max: diasDiferencia , noSpecialCharacters:true, letters:true},
        };
        var formMessage = {
            
        };
        FormValidationMd.init(form, formRules, formMessage, createProyecto());
    });
</script>
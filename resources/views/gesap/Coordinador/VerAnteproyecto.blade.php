<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Anteproyecto De Grado Seccional Facatativa'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! Form::model ([$datos], ['id'=>'form_update_anteproyecto', 'url' => '/forms'])  !!}

                <div class="form-body">
                    <div class="row">
                       
                        {!! Field:: text('PK_NPRY_IdMctr008',$datos[0]['PK_NPRY_IdMctr008'],['label'=>'Código interno:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Codigo Interno Del Anteproyecto.','icon'=>'fa fa-credit-card'] ) !!}

                        {!! Field:: text('NPRY_Titulo',$datos[0]['NPRY_Titulo'],['label'=>'TITULO:','readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                            {!! Field:: text('NPRY_Keywords',$datos[0]['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:','readonly', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Descripcion',$datos[0]['NPRY_Descripcion'],['label'=>'DESCRIPCION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$datos[0]['NPRY_Duracion'],['label'=>'DURACION:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: text('FK_NPRY_Estado',$datos['Estado'],['label'=>'ESTADO:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                            {!! Field:: text('NPRY_FCH_Radicacion',$datos[0]['NPRY_FCH_Radicacion'],['label'=>'FECHA RADIACIÓN:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                           
                            PRE DIRECTOR:

                            {!! Field:: text('FK_NPRY_Pre_Director',$datos['Nombre'],['label'=>'Nombres :', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-book'] ) !!}
                            {!! Field:: text('FK_NPRY_Pre_Director',$datos['Apellido'],['label'=>'Apellidos:', 'readonly','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-user'] ) !!}
                           
                                                             <br><br>
                           <h4> DESARROLLADORES :</h4>
                                <br><br>
          
                    </div>
                    @permission('GESAP_CREATE_USER')<a href="javascript:;"
                                                       class="btn btn-simple btn-success btn-icon create"
                                                       title="Registar un nuevo anteproyecto">
                            <i class="fa fa-plus">
                            </i>Agregar Desarrolador
                           
                        </a>@endpermission
                        <br><br>
                        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listadesarrolladores'])
                        @slot('columns', [
                            'Codigo',
                            'Nombre',
                            'Apellido',
                            'Acciones'
                        ])
                    @endcomponent
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('ADMIN_GESAP')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>
                                @endpermission
                               <!--  @permission('ADMIN_GESAP'){{ Form::submit('Asignar', ['class' => 'btn blue']) }}@endpermission
                                @permission('ADMIN_GESAP'){{ Form::submit('Re-Asignar', ['class' => 'btn yellow']) }}@endpermission
                               -->        </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>



</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        
 //alert('aishiajsia');


    var table, url, columns;
        table = $('#listadesarrolladores');
        id='{{  $datos[0]['PK_NPRY_IdMctr008']  }}';
        
        url = '{{ route('AnteproyectosGesap.Desarrolladoreslist') }}'+ '/' + id;
    
         
    
        columns = [
            {data: 'Codigo', name: 'Codigo'},
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Apellido', name: 'Apellido'},
            
            
      
            {
                defaultContent: '@permission('DELETE_DESARROLLADOR')<a href="javascript:;" title="Eliminar" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission' ,
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

        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var route = '{{ route('Desarrollador.destroy') }}' + '/' + dataTable.PK_Id_desarrollo;
             var type = 'DELETE';
            var async = async || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este desarrollador?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            processData: false,
                            async: async,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó desarrollador", "error");
                    }
                });

        });
    $(".create").on('click', function (e) {
        e.preventDefault();
        var route = '{{ route('AnteproyectosGesap.AsignarDesarrollador') }}'+ '/' + id;
        $(".content-ajax").load(route);

    });

     
    $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('AnteproyectosGesap.index.Ajax') }}';
            location.href="{{route('AnteproyectosGesap.index')}}";
            //$(".content-ajax").load(route);
        });
    });
</script>


@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Información personal contratado')

@section('page-title', 'Listado del personal contratado:')

@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Personal registrado:'])
            <div id="response" class="row">
                <div class="col-md-12"><br>
                    <button id="button" class="btn blue">Registrar todos</button>&nbsp&nbsp&nbsp<a href="{{ route('talento.humano.evento.index') }}"><button id="volver" class="btn green" >
                            <i class="fa fa-arrow-circle-left"></i>Volver</button></a> <br><br>
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-empleados'])
                        @slot('columns', [
                            '#',
                            'Nombres',
                            'Apellidos',
                            'Cédula',
                            'Teléfono',
                            'Email',
                            'Rol ',
                            'Agregar Asistente'
                        ])
                    @endcomponent
                </div>
            </div>
            {!! Form::open(['route' =>['talento.humano.evento.regAsist.regTotAsist'],'method'=>'POST', 'id'=>'form-create' ])!!}
                {!! Field::hidden('FK_TBL_Eventos_IdEvento',$id,['id'=>'idEvent']) !!}
            {!! Form::close() !!}
        @endcomponent
    </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

@endpush
@push('functions')

<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script>

    function mifuncion(){
        form1=$("#form-delete");
        swal({
                title: "Estas seguro ?",
                text: "No podras deshacer estos cambios",         type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, estoy seguro!",
                cancelButtonText:"Cancelar",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(confirmacion){
                if(confirmacion){
                    form1.submit();
                }else {
                    swal("Cancelado", "Tu información no ha sido eliminada.", "error");
                }

            });
    };
            @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'success   ':
            toastr.options.closeButton = true;
            toastr.info("{{Session::get('message')}}",'Eliminación exitosa:');
            break;
    }
    @endif
jQuery(document).ready(function () {

        var  url;
        url = "{{ route('talento.humano.posAsitentes',$id)}}";
        $.fn.dataTable.ext.errMode = 'throw';
        /*/para que no le salga errores al funcionario*/

        var table = $('#lista-empleados').DataTable({

            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Todo"]
            ],
            responsive: true,
            colReorder: false,
            processing: true,
            serverSide: false,
            ajax: url,
            language: {
                "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            columns: [

                {data: 'DT_Row_Index'},
                {data: 'PRSN_Nombres', name: 'Nombres'},
                {data: 'PRSN_Apellidos', name: 'Apellidos'},
                {data: 'PK_PRSN_Cedula', name: 'Cédula'},
                {data: 'PRSN_Telefono', name: 'Teléfono'},
                {data: 'PRSN_Correo', name: 'Correo Electronico'},
                {data: 'PRSN_Rol', name: 'Rol'},


                {
                    data: "PK_PRSN_Cedula",
                    name: 'action',
                    title: 'Acciones',
                    orderable: false,
                    searchable: false,
                    exportable: false,
                    printable: false,
                    className: '',
                    render: function (data, type, full, meta) {
                        var id= document.getElementById("idEvent").value;
                        return '<a href="saveAsist/'+id+'/'+data+'" class="btn btn-simple btn-success btn-icon edit"><i class="icon-users"></i></a>';
                    },
                    responsivePriority: 2
                }
            ],
            buttons: [
                {
                    extend: 'print',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-print',
                    text: '<i class="fa fa-print"></i>'
                },
                {
                    extend: 'copy',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy',
                    text: '<i class="fa fa-files-o"></i>'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel',
                    text: '<i class="fa fa-file-excel-o"></i>',
                },
                {
                    extend: 'csv',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',
                    text: '<i class="fa fa-file-text-o"></i>',
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis',
                    text: '<i class="fa fa-bars"></i>'
                },
                {
                    text: '<i class="fa fa-refresh"></i>',
                    className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
                    action: function (e, dt, node, config) {
                        dt.ajax.reload();
                    }
                }

            ],
            pageLength: 10,
            dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

        });
        $('#button').click( function () {
            var data = Array.from(table.rows({page: 'current', search: 'applied'}).data());
            var datos="";
            for (i in data){
                datos=datos+data[i].PK_PRSN_Cedula+';';
            }
            var id = $('input[id="idEvent"]').val();//document.getElementById("idEvent").value;
            var route = '{{ route('talento.humano.evento.regAsist.regTotAsist') }}' + '/' + id + '/' + datos;
            var type = 'POST';
            var async = async || false;

            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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

        var handleTooltips = function () {
            $('.t-print').attr({'data-container': "body", 'data-placement': "top", 'data-original-title': "Imprimir"});
            $('.t-copy').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Copiar al portapales"
            });
            $('.t-pdf').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a PDF"
            });
            $('.t-excel').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a EXCEL"
            });
            $('.t-csv').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Exportar a CSV"
            });
            $('.t-colvis').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Mostrar/Ocultar Columnas"
            });
            $('.t-refresh').attr({
                'data-container': "body",
                'data-placement': "top",
                'data-original-title': "Recargar"
            });

            $('.tooltips').tooltip();
        }


    });
</script>
@endpush
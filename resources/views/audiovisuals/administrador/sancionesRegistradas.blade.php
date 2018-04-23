
@extends('material.layouts.dashboard')
@push('styles')
    <!-- Styles SWEETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
    <!--DATATIME -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Styles DATATABLE  -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- STYLES TOAST-->
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@section('title', '| Gestion Sanciones')
@section('page-title', 'Gestion Sanciones')
@section('content')
    <div class="clearfix"></div>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Sanciones'])
            <div class="clearfix">
            </div>
            <br><br><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'usuarios-table'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'Funcionario',
                        'C.C',
                        'Correo',
                        'Administrador',
                        'Fecha de Sancion',
                        'Acciones' => ['style' => 'width:200px;']
                    ])
                @endcomponent
            </div>
            <div class="clearfix"></div>
        @endcomponent
    </div>
    </br>
@endsection
@push('plugins')
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- TIEMPOS DATETIME -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <!-- SCRIPT DATETIME -->
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
        jQuery(document).ready(function () {
            App.unblockUI('.portlet-form');
            var idFuncionario;
            var table, url, columns;
            table = $('#usuarios-table');
            url = "{{ route('listarSancionesSolicitudesFinalizadas.dataTable') }}";
            columns = [
                {data: 'DT_Row_Index'},
                {data: 'id', "visible": false },
                {data: function(data){
                    return data.consulta_usuario_audiovisuales.user.name +" "
                        +data.consulta_usuario_audiovisuales.user.lastname;
                },name:'Funcionario'},
                {data: 'consulta_usuario_audiovisuales.user.identity_no', name: 'C.C'},
                {data: 'consulta_usuario_audiovisuales.user.email', name: 'Correo'},
                {data: function(data){
                    return data.conultar_administrador_entrega.name +" "
                        +data.conultar_administrador_entrega.lastname;
                },name:'Administrador Entrega'},
                {data: 'SNS_Fecha', name: 'Fecha'},
                {
                    defaultContent:
                            '<a title="Anular sancion" href="javascript:;" class="btn btn-simple btn-danger btn-icon anular"><i class="icon-trash"></i></a>' +
                            '<a title="Ver Sancion" href="javascript:;" class="btn btn-simple btn-success btn-icon ver"><i class="icon-eye"></i></a>',
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
            table.on('click', '.anular', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                console.log(dataTable);
                swal(
                    {
                        title: "Anular Sanciones",
                        text: "Las sanciones asignadas a esta solicitud seran eliminadas,desea anular la(s) sancion(es)",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var route = '{{ route('audiovisuales.anular.sancion') }}';
                            var formDatas = new FormData();
                            var typeAjax = 'POST';
                            var async = async || false;
                            formDatas.append('SNS_Sancion_General',dataTable.SNS_Sancion_General);
                            formDatas.append('SNS_Numero_Orden',dataTable.SNS_Numero_Orden);
                            formDatas.append('FK_SNS_Id_Solicitud',dataTable.FK_SNS_Id_Solicitud);
                            formDatas.append('accion','anulacionGeneral');
                            console.log(formDatas);
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                type: typeAjax,
                                contentType: false,
                                data: formDatas,
                                processData: false,
                                async: async,
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                },
                                error: function (response, xhr, request) {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            });
                        }
                    }
                );
            });
        });
    </script>
@endpush

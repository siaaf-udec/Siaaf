@extends('material.layouts.dashboard')

@push('styles')
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Lista de Convenios')


@section('page-title', 'Lista de Convenios')

@section('page-description', 'Convenios registrados')

@section('content')
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'INFORMNACION DEL CONVENIO'])
<div class="portlet-body">
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#tab_1_1" data-toggle="tab"> EMPRESAS </a>
        </li>
        <li>
            <a href="#tab_1_2" data-toggle="tab"> USUARIOS </a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tab_1_1">
            <br><br>
            <div class="row">
                <div class="clearfix"> </div><br><br>
                <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Empresa'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo Evaluacion',
                    'Evaluador',
                    'Nombre Evaluador',
                    'Apellido Evaluador',
                    'Empresa Evaluada',
                    'Convenio',
                    'Nota_Final',
                    'Acciones' => ['style' => 'width:px;']
                ])
            @endcomponent
                </div>
            </div>
        </div>
        <div class="tab-pane fade " id="tab_1_2">
            <br><br>
            <br><br>
            <div class="row">
                <div class="clearfix"> </div>
                <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Pasante'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo Evaluacion',
                    'Evaluado',
                    'Nombre Evaluado',
                    'Apellido Evaluado',
                    'Nombre Evaluador',
                    'Apellido Evaluador',
                    'Convenio',
                    'Nota_Final',
                    'Acciones' => ['style' => 'width:px;']
                ])
            @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
    @endcomponent
@endsection



@push('plugins')
<!-- Datatables Plugins -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<!-- Validation Plugins -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
<!-- Utoastr Plugins -->
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Empresa');
        url = "{{ route('listarEvaluacionesEmpresas.listarEvaluacionesEmpresas') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_VLCN_Evaluacion', className:'none', "visible": true, name:"documento" },
           {data: 'evaluador.dato_usuario.name',className:'none', searchable: true},
           {data: 'evaluador.dato_usuario.name',className:'none', searchable: true},
           {data: 'evaluador.dato_usuario.lastname', className:'none',searchable: true},
           {data: 'evaluado_empresa.EMPS_Nombre_Empresa', searchable: true}, 
           {data: 'convenios_evaluacion.CVNO_Nombre', searchable: true},
           {data: 'VLCN_Nota_Final', searchable: true},
           {data:'action',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon edit"><i class=""> VER PREGUNTAS </i></a>'
           }
        ];
        dataTableServer.init(table, url, columns);
   
    
     table = table.DataTable();
    table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{route('listarPreguntaEvaluacion.listarPreguntaEvaluacion')}}/'+dataTable.PK_VLCN_Evaluacion;
     $(".content-ajax").load(route_edit);
        });
    
   
    
  
});
</script>
<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Pasante');
        url = "{{ route('listarEvaluacionesUsuarios.listarEvaluacionesUsuarios') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_VLCN_Evaluacion', className:'none', "visible": true, name:"documento" },
           {data: 'evaluado.dato_usuario.name', searchable: true},
           {data: 'evaluado.dato_usuario.name',className:'none', searchable: true},
           {data: 'evaluado.dato_usuario.lastname', className:'none',searchable: true},
           {data: 'evaluador.dato_usuario.name',className:'none', searchable: true},
           {data: 'evaluador.dato_usuario.lastname', className:'none',searchable: true},
           {data: 'convenios_evaluacion.CVNO_Nombre', searchable: true},
           {data: 'VLCN_Nota_Final', searchable: true},
           {data:'action',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon editar"><i class=""> VER PREGUNTAS </i></a>'

            
        }
        ];
        dataTableServer.init(table, url, columns);
   
    
    
     table = table.DataTable();
   table.on('click', '.editar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/listarPreguntaEvaluacion/'+dataTable.PK_VLCN_Evaluacion;
     $(".content-ajax").load(route_edit);
        });
    
   
    
  
});
</script>
@endpush
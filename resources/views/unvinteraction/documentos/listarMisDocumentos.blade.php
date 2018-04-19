@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
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
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Lista de Documentos')


@section('page-title', 'Lista de Documentos')

@section('page-description', 'Mis Documentos Subidos')


@section('content')
 <!-- TABLAS -->
<!-- TABLAS DOCUMENTOS DEL CONVENIO -->
   @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'MIS DOCUMENTOS'])
<div class="col-md-12">
    <div class="actions">
        <a id="archivo1" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>
    </div>
</div>
<div class="row">
    <div class="clearfix"> </div><br><br>
    <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Documentos'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Nombre',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
    </div>
</div>

@endcomponent
<!-- TABLAS  PARTICIPANTES -->
<!-- FIN TABLAS -->
<!-- MODALS -->
<!-- AGREGAR DOCUMENTO-->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="documento" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> SUBIR ARCHIVO</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id' => 'my-dropzone', 'class' => 'dropzone dropzone-file-area', 'url'=>'/form']) !!}
                    <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                    {!! Form::close() !!}
                    <br>{!! Form::submit('Guardar', ['class' => 'btn blue button-submit']) !!}
                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>



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
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/interaccion/js/Dropzone.js') }}" type="text/javascript"></script> 
@endpush
@push('functions')
<script>
jQuery(document).ready(function () {
    Dropzone.autoDiscover = false;
     App.unblockUI('.portlet-form');
    var table, url, columns;
        table = $('#Listar_Documentos');
        url = "{{ route('listarMisDocumentos.listarMisDocumentos') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'PK_DCET_Documentacion_Extra', "visible": true, name:"PK_DCET_Documentacion_Extra",className:'none' },
            {data: 'DCET_Nombre',searchable: true,name:"DCET_Nombre"},
            {data:'action',
             
             searchable: false,
             name:'action',
             title:'Acciones',
             orderable: false,
             exportable: false,
             printable: false,
             defaultContent: '@permission(['INTE_DES_DOC_USU'])<a href="#" target="_blank" class="btn btn-simple btn-whrite btn-icon descargar" title="Descargar Documento"><i class="fa fa-cloud-download"> DESCARGAR</i></a>@endpermission'
            }
        ];
        dataTableServer.init(table, url, columns);
    
        
        table.on('click', '.descargar', function(e) {
            table = $('#Listar_Documentos').DataTable();
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function(data) {
                    window.location.href = '{{ route('documentoDescargaUsuario.documentoDescargaUsuario') }}'+'/'+dataTable.PK_DCET_Documentacion_Extra;
            });
        });
    
    $("#archivo1").on('click', function (e) {
            e.preventDefault();
            $('#documento').modal('toggle');
        });
    
    table = $('#Listar_Documentos');
        var documento = function () { 
            return { 
                init:function(){
                    $('#documento').modal('hide');  
                    
                }
            }; 
        }
        
        var route = '{{route('subirDocumentoUsuario.subirDocumentoUsuario')}}';
        
        var formatfile = '.pdf'; 
        var numfile = 1; 
    
        $("#my-dropzone").dropzone(FormDropzone.init(route, formatfile, numfile, documento(),name));
    
    
});
</script>


@endpush
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR EVALUACIONES REALIZADA A USUARIOS '])
  {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Convenio']) !!}
    <div class="form-wizard">
        {!! Field::date('Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
        {!! Field::date('Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'Digita tu dirección web.', 'icon' => 'fa fa-calendar']) !!}
        {!! Form::submit('Filtrar', ['class' => 'btn blue']) !!}
    </div>      
    {!! Form::close() !!}
<br><br><br><br><br><br>
    <div class="row">
        <div class="clearfix"> </div><br><br>
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
    @endcomponent
<script>
jQuery(document).ready(function () {
    ComponentsDateTimePickers.init();
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            };
    var form=$('#form-Agregar-Convenio');
    var wizard =  $('#form_wizard_1');
            
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('vistaReporte.vistaReporte',[$id]) }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('Fecha_Inicio', $('#Fecha_Inicio').val());
                    formData.append('Fecha_Fin', $('#Fecha_Fin').val());
                    $.ajax({
                        url: route,
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                        var route = '/siaaf/public/index.php/interaccion-universitaria/reporte/@php echo $id; @endphp/'+$('#Fecha_Inicio').val()+'/'+$('#Fecha_Fin').val();
                        $(".content-ajax").load(route);
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
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , crearConvenio());
    
    var table, url;
    table = $('#Listar_Pasante');
    url = "{{ route('listarEvaluacionIndividual.listarEvaluacionIndividual',[$id]) }}";
    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       searching: true,
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
       columns:[
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
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon ver"><i class="icon-pencil"> VER </i></a>'

            
        }
           
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {text: '<i class="fa fa-refresh"></i>', className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }
       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
    
    
   table = table.DataTable();
    table.on('click', '.ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
            route_edit = '/siaaf/public/index.php/interaccion-universitaria/listarPreguntaEvaluacion/'+dataTable.PK_VLCN_Evaluacion;
            $(".content-ajax").load(route_edit);
        });
    
   
    
  
});
</script>

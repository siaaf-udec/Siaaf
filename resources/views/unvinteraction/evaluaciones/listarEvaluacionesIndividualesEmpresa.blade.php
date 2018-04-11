@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR EVALUACIONES REALIZADA A EMPRESAS '])
  {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Convenio']) !!}
<div class="form-wizard">
    {!! Field::date('Fecha_Inicio',['label'=>'Fecha Inicio','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'campo obligatorio', 'icon' => 'fa fa-calendar']) !!}
    {!! Field::date('Fecha_Fin',['label'=>'Fecha Final','required', 'auto' => 'off', 'data-date-format' => "yyyy-mm-dd", 'data-date-start-date'=> "+0d"],['help' => 'campo obligatorio', 'icon' => 'fa fa-calendar']) !!}
    
    {!! Form::submit('Filtrar', ['class' => 'btn blue']) !!}
         
</div>
{!! Form::close() !!}
<br><br>
<div class="row">
    <div class="clearfix"> </div><br><br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Pasante'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo Evaluacion',
                    'Evaluado',
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
    
    var table, url, columns;
        table = $('#Listar_Pasante');
        url = "{{ route('listarEvaluacionIndividualEmpresa.listarEvaluacionIndividualEmpresa',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_VLCN_Evaluacion', className:'none', "visible": true, name:"documento" },
           {data: 'evaluado_empresa.EMPS_Nombre_Empresa', searchable: true},
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
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon editar"><i class="icon-pencil"> VER </i></a>'

            
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
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR EVALUACIONES REALIZADA A USUARIOS '])
  {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Convenio']) !!}
{!! Form::button('ATRAS', ['class' => 'btn red back']) !!}
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
<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>
jQuery(document).ready(function () {
    App.unblockUI('.portlet-form');
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
                        var route = '{{route('reporte.reporte')}}/@php echo $id; @endphp/'+$('#Fecha_Inicio').val()+'/'+$('#Fecha_Fin').val();
                        $(".content-ajax").load(route);
                        UIToastr.init(xhr , response.title , response.message  );
                        App.unblockUI('.portlet-form');
                    }
                },
                error: function (response, xhr, request) {
                    if (request.status === 422 &&  xhr === 'error') {
                        UIToastr.init(xhr, response.title, response.message);
                        App.unblockUI('.portlet-form');
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
        url = "{{ route('listarEvaluacionIndividual.listarEvaluacionIndividual',[$id]) }}";
        columns = [
           {data: 'DT_Row_Index'},
           {data: 'PK_VLCN_Evaluacion', className:'none', "visible": true, name:"PK_VLCN_Evaluacion" },
           {data: 'evaluado.dato_usuario.name', searchable: true,name:"evaluado.dato_usuario.name"},
           {data: 'evaluado.dato_usuario.name',className:'none', searchable: true,name:"evaluado.dato_usuario.name"},
           {data: 'evaluado.dato_usuario.lastname', className:'none',searchable: true,name:"evaluado.dato_usuario.lastname"},
           {data: 'evaluador.dato_usuario.name',className:'none', searchable: true,name:"evaluador.dato_usuario.name"},
           {data: 'evaluador.dato_usuario.lastname', className:'none',searchable: true,name:"evaluador.dato_usuario.lastname"},
           {data: 'convenios_evaluacion.CVNO_Nombre', searchable: true,name:"convenios_evaluacion.CVNO_Nombre"},
           {data: 'VLCN_Nota_Final', searchable: true,name:"VLCN_Nota_Final"},
           {data: 'action',
            name: 'action',
            title: 'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-center',
            render: null,
            serverSide: false,
            responsivePriority: 2,
            defaultContent: '<a href="#" title="ver preguntas" class="btn btn-simple btn-warning btn-icon ver"><i class="icon-pencil"> VER </i></a>'

            
        }
        ];
        dataTableServer.init(table, url, columns);
    
    table = table.DataTable();
    table.on('click', '.ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
            route_edit = '{{route('listarPreguntaEvaluacion.listarPreguntaEvaluacion')}}/'+dataTable.PK_VLCN_Evaluacion;
            $(".content-ajax").load(route_edit);
        });
    
    
    $('.back').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('documentosConvenios.documentosConvenios') }}'+'/@php echo $convenio @endphp/@php echo $estado @endphp';
            $(".content-ajax").load(route);
        });
  
});
</script>

@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR PREGUNTAS'])
@permission(['INTE_ADD_CONVENIO'])
 <div class="col-md-12">
                    <div class="actions">
                        <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create" title="Agregar un convenio"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
 @endpermission

    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Preguntas'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo',
                    'Enunciado',
                    'Tipo',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
 <!-- Modal agregar Tipo -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR PREGUNTA</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Pregunta']) !!}
                    <div class="form-wizard">
                        {!! Field:: textarea('PRGT_Enunciado',['label'=>'Enunciado de la pregunta','class'=> 'form-control', 'autofocus','required' => 'required', 'maxlength'=>'120', 'size'=>'100px','autocomplete'=>'off'],['help' => 'Agregar el enunciado de la pregunta','icon'=>'fa fa-graduation-cap'] ) !!}
                        
                        {!! Field::select('FK_TBL_Tipo_Pregunta_Id',$pregunta,[ 'label' => 'Selecciona un tipo de pregunta'])!!}
                        
                        {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                        
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>

jQuery(document).ready(function () {
    App.unblockUI('.portlet-form');
    ComponentsSelect2.init();
   var table, url, columns;
        table = $('#Listar_Preguntas');
        url = "{{ route('listarPregunta.listarPregunta') }}";
        columns = [
           {data: 'DT_Row_Index'},
           {data: 'PK_PRGT_Pregunta', "visible": true,name:"PK_PRGT_Pregunta" },
           {data: 'PRGT_Enunciado', searchable: true,name:"PRGT_Enunciado"},
           {data: 'pregunta_tipos_pregunta.TPPG_Tipo', searchable: true,name:"TPPG_Tipo"},
           {data:'action',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon editar"><i class="icon-pencil"></i></a>'

            
        }
        ];
        dataTableServer.init(table, url, columns);

    table = table.DataTable();
     table.on('click', '.editar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{route('editarPregunta.editarPregunta')}}/'+dataTable.PK_PRGT_Pregunta;

            $(".content-ajax").load(route_edit);
        });
    
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            PRGT_Enunciado: {required: true},
            FK_TBL_Tipo_Pregunta_Id: {required: true},
    };
    var form=$('#form-Agregar-Pregunta');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('agregarPregunta.agregarPregunta') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('PRGT_Enunciado', $('#PRGT_Enunciado').val());
                    formData.append('FK_TBL_Tipo_Pregunta_Id', $('select[name="FK_TBL_Tipo_Pregunta_Id"]').val());
                    
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
								App.blockUI({target: '.portlet-form', animate: true});
							},
                        success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
                         $('#agregar').modal('hide');
                        $('#form-Agregar-Pregunta')[0].reset();
                        table.ajax.reload();
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
    
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#agregar').modal('toggle');
        });
  
});
</script>

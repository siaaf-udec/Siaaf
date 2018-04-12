@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR CONVENIOS'])
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
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Convenios'])
        @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Codigo',
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
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR EMPRESA</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Tipo-Pregunta']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('TPPG_Tipo',['label'=>'Tipo','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Agregar el tipo','icon'=>'fa fa-line-chart'] ) !!}
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                </div>
                                <div class="modal-footer">
                                    {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                                    {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                                </div>
                                  </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Convenios');
        url = "{{ route('listarTipoPregunta.listarTipoPregunta') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_TPPG_Tipo_Pregunta', "visible": true, name:"documento" },
           {data: 'TPPG_Tipo', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>'

            
        }
        ];
        dataTableServer.init(table, url, columns);
    
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#agregar').modal('toggle');
        });
    
    
     table = table.DataTable();
     table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{route('editarTipoPregunta.editarTipoPregunta')}}/'+dataTable.PK_TPPG_Tipo_Pregunta;
         $(".content-ajax").load(route_edit);
        });
   $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            TPPG_Tipo: {required: true},
    };
    var form    =  $('#form-Agregar-Tipo-Pregunta');
    var wizard  =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('agregarTipoPregunta.agregarTipoPregunta') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('TPPG_Tipo', $('#TPPG_Tipo').val());
                    
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
                        $('#form-Agregar-Tipo-Pregunta')[0].reset();
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
                }
            }
        };    
    
    var messages = {};
        
    FormValidationMd.init( form, rules, messages , crearConvenio());
     
    
  
});
</script>

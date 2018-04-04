@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR ESTADOS'])
<div class="col-md-12">
    <div class="actions">
        <a id="archivo3" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus" title="Agregar Estado"></i></a>
    </div>
</div>
<div class="row">
    <div class="clearfix"> </div><br><br>
    <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Convenios'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'Id',
                    'Estado',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
    </div>
</div>
<!-- AGREGAR ESTADO -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="empresa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR ESTADO</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Estado']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('ETAD_Estado',null,['label'=>'Estado','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el estado.','icon'=>'fa fa-cog']) !!}
                        <div class="modal-footer">
                            {!! Form::submit('Agregar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- FIN MODALS -->
@endcomponent

<script>
jQuery(document).ready(function () {
    var table, url, columns;
        table = $('#Listar_Convenios');
        url = "{{ route('listarEstados.listarEstados') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_ETAD_Estado', "visible": true, name:"documento" },
           {data: 'ETAD_Estado', searchable: true},
           {data:'action',className:'',searchable: false,
            name:'action',
            title:'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '<a href="#" class="btn btn-simple btn-warning btn-icon editar" title="Editar Empresa"><i class="icon-pencil"></i></a>'
           }
        ];
        dataTableServer.init(table, url, columns);
    $("#archivo3").on('click', function (e) {
            e.preventDefault();
            $('#empresa').modal('toggle');
        });
    
     table = table.DataTable();
     table.on('click', '.editar', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/editarEstado/'+dataTable.PK_ETAD_Estado;
     $(".content-ajax").load(route_edit);
        });
    
    $('.portlet-form').attr("id","form_wizard_1");
    var rules = {
            ETAD_Estado: {required: true}
    };          
    var form=$('#form-Agregar-Estado');
    var wizard =  $('#form_wizard_1');
    var crearConvenio = function () {
            return{
                init: function () {
                    var route = '{{ route('resgistrarEstados.resgistrarEstados') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('ETAD_Estado', $('#ETAD_Estado').val());
                    
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
                         $('#empresa').modal('hide');
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

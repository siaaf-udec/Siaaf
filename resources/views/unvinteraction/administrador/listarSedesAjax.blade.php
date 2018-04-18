@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR SEDES'])
<div class="col-md-12">
    <div class="actions">
        <a id="abrir" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus" title="Agregar Sede"></i></a>
    </div>
</div>
<div class="row">
    <div class="clearfix"> </div><br><br>
    <div class="col-md-12">
        @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Convenios'])
        @slot('columns', [ 
            '#' => ['style' => 'width:20px;'],
            'Codigo',
            'Nombre',
            'Acciones' => ['style' => 'width:160px;'] ]) 
        @endcomponent
    </div>
</div>
<!-- AGREGAR SEDE -->
<div class="col-md-12">
    <!-- Modal -->
    <div class="modal fade" id="sede" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-success">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1><i class="glyphicon glyphicon-thumbs-up"></i> AGREGAR SEDE</h1>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Agregar-Sede']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('SEDE_Sede',null,['label'=>'Nombre','class'=> 'form-control', 'autofocus','required' => 'required', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el nombre de la sede.','icon'=>'fa fa-industry']) !!}
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Agregar', ['class' => 'btn blue']) !!} {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
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
    jQuery(document).ready(function() {
        App.unblockUI('.portlet-form');
       var table, url, columns;
        table = $('#Listar_Convenios');
        url = "{{ route('listarSedes.listarSedes') }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_SEDE_Sede', "visible": true,name:"PK_SEDE_Sede" },
           {data: 'SEDE_Sede', searchable: true,name:"SEDE_Sede"},
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

        $("#abrir").on('click', function(e) {
            e.preventDefault();
            $('#sede').modal('toggle');
        });

        table = table.DataTable();
        table.on('click', '.editar', function(e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('editarSedes.editarSedes') }}'+'/'+dataTable.PK_SEDE_Sede;
            $(".content-ajax").load(route_edit);
        });
        $('.portlet-form').attr("id", "form_wizard_1");
        var rules = {
            SEDE_Sede: {required: true}
        };
        var form = $('#form-Agregar-Sede');
        var wizard = $('#form_wizard_1');
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('resgistrarSedes.resgistrarSedes') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('SEDE_Sede', $('#SEDE_Sede').val());

                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        beforeSend: function () {
								App.blockUI({target: '.portlet-form', animate: true});
							},
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                $('#sede').modal('hide');
                                $('#form-Agregar-Sede')[0].reset();
                                table.ajax.reload();
                                UIToastr.init(xhr, response.title, response.message);
                                App.unblockUI('.portlet-form');
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };

        var messages = {};

        FormValidationMd.init(form, rules, messages, crearConvenio());

    });

</script>

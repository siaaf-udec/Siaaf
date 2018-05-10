<div class="row">
    <div class="col-md-12">
    {{-- BEGIN HTML MODAL CREATE --}}
    <!-- responsive -->
        <div class="modal fade" data-width="380" id="modal-info-kit" tabindex="-1">
            <div class="modal-header modal-header-success">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                </button>
                <h2 class="modal-title">
                    <i class="glyphicon glyphicon-edit">
                    </i>
                    Detalles Kit
                </h2>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'from_info_kit', 'class' => '', 'url' => '/forms']) !!}
                <div class="row">
                    <div class="col-md-12">
                        {!! Field::text('KIT_Nombre',
                           ['label' => 'Nombre Kit', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                           ['help' => 'Nombre del Kit', 'icon' => 'fa fa-user'])
                        !!}
                        {!! Field::select('KIT_FK_Tiempo',
                             [
                                4 => 'Asignado',
                                3 => 'Libre'
                             ],
                            ['label' => 'Tipo Tiempo'])
                        !!}
                    </div>
                    <div class="col-md-12">
                        {!! Field::text('KIT_Codigo',
                            ['label' => 'Codigo', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off'],
                            ['help' => 'Codigo Del Kit', 'icon' => 'fa fa-user'])
                        !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" align="center">
                        {!! Form::submit('MODIFICAR', ['class' => 'btn blue']) !!}
                        {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        {{-- END HTML MODAL CREATE--}}
    </div>
</div>
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestión Kits'])
        <br>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                @permission("AUDI_KIT_VIEW_CREATE")
                <div class="actions">
                    <a class="btn btn-outline dark createKit" data-toggle="modal">
                        <i class="fa fa-plus">
                        </i>
                        Crear Kit
                    </a>
                </div>
                @endpermission
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'kit-table-ajax'])
                @slot('columns', [
                    'Nombre',
                    'Codigo',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
        <div class="clearfix"></div>
    @endcomponent
</div>
<script>
    var table, url, columns;

    var ComponentsBootstrapMaxlength = function () {
        var handleBootstrapMaxlength = function () {
            $("input[maxlength], textarea[maxlength]").maxlength({
                alwaysShow: true,
                appendToParent: true
            });
        }
        return {
            //main function to initiate the module
            init: function () {
                handleBootstrapMaxlength();
            }
        };
    }();
    $(document).ready(function () {
        App.unblockUI('.portlet-form');
        ComponentsBootstrapMaxlength.init();
        table = $('#kit-table-ajax');
        url ="{{ route('listarKit.data') }}";
        columns = [
            {data: 'KIT_Nombre' , name: 'KIT_Nombre'},
            {data: 'KIT_Codigo' , name: 'KIT_Codigo'},
            {
                defaultContent:
                    '@permission("AUDI_KIT_EDIT")<a title="Editar Kit" href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a>@endpermission' +
                    '@permission("AUDI_KIT_DELETE")<a title="Eliminar Kit" href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>@endpermission'+
                    '@permission("AUDI_KIT_ASSIGN")<a  title="Asignar Articulos" href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>@endpermission',
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
        $( ".createKit" ).on('click', function (e) {
            e.preventDefault();
            var routeAjax = '{{route('audiovisuales.articulo.formRepeatKitAjax')}}';
            $(".content-ajax").load(routeAjax);
        });
        table.on('click', '.create', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            var routeAjax = '{{route('audiovisuales.articulo.articuloskitAjax')}}'+'/'+dataTable.id;
            $(".content-ajax").load(routeAjax);

        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            if(dataTable.KIT_FK_Estado_id!=5){
                $('#KIT_Codigo').attr('disabled','disabled');
            }else{
                $('#KIT_Codigo').removeAttr('disabled');
            }
            $('#KIT_Nombre').val(dataTable.KIT_Nombre);
            $('#KIT_Codigo').val(dataTable.KIT_Codigo);
            idEditarKit=dataTable.id;
            $('select[name="KIT_FK_Tiempo"]').val(dataTable.KIT_FK_Tiempo);
            $('#modal-info-kit').modal('toggle');
        });
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();
            if(dataTable.KIT_FK_Estado_id == 1){
                swal(
                    {
                        title: "Este kit no ha realizado solicitudes.",
                        text: "Los articulos quedaran sin pertenecer a un kit , y podrán ser asignados a otro kit ?",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Continuar",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var rutaRemoverArticuloKit =
                                '{{ route('EliminarKit') }}'+ '/'+ dataTable.id;

                            $.ajax({
                                url: rutaRemoverArticuloKit,
                                type: 'GET',
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {

                                        UIToastr.init(xhr , response.title , response.message  );
                                        table.ajax.reload();
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
                );
            }else{
                swal(
                    {
                        title: "Este kit  ha realizado solicitudes, el codigo podrá ser reasignado en otro articulo o Kit.",
                        text: "Los articulos quedaran sin pertenecer a un kit , y podrán ser asignados a otro kit ?",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Continuar",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if (isConfirm) {
                            var rutaRemoverArticuloKit =
                                '{{ route('EliminarKitSoftdelete') }}'+ '/'+ dataTable.id;
                            $.ajax({
                                url: rutaRemoverArticuloKit,
                                type: 'GET',
                                beforeSend: function () {
                                    App.blockUI({target: '.portlet-form', animate: true});
                                },
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {

                                        UIToastr.init(xhr , response.title , response.message  );
                                        table.ajax.reload();
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
                );
            }
        });
        var modificarKit = function () {
            return{
                init: function () {
                    var route = '{{ route('kitModificar') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('id',parseInt(idEditarKit));
                    formData.append('KIT_Nombre', $('input:text[name="KIT_Nombre"]').val());
                    formData.append('KIT_FK_Tiempo', parseInt($('select[name="KIT_FK_Tiempo"]').val()));
                    formData.append('KIT_Codigo', parseInt($('input:text[name="KIT_Codigo"]').val()));
                    $.ajax({
                        url: route,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
                                $('#modal-info-kit').modal('hide');
                                UIToastr.init(xhr , response.title , response.message  );
                                table.ajax.reload();
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
        var form_create = $('#from_info_kit');
        var rules_kit_modificar ={
            KIT_Nombre: {
                minlength: 3, required: true
            }
        };
        var messagesKit = {

        };
        FormValidationMd.init(form_create,rules_kit_modificar,messagesKit,modificarKit());
    })
</script>
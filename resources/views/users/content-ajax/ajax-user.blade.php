<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Datatable Ajax'])

        @slot('actions', [

            'link_upload' => [
                'link' => '',
                'icon' => 'icon-cloud-upload',
            ],
            'link_wrench' => [
                'link' => '',
                'icon' => 'icon-wrench',
            ],
            'link_trash' => [
                'link' => '',
                'icon' => 'icon-trash',
            ],

        ])
        <div class="clearfix"> </div><br><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a></div>
            </div>
            <div class="clearfix"> </div><br>
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'example-table-ajax'])
                    @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'Nombre',
                        'Correo Electronico',
                        'Roles',
                        'Estado',
                        'Acciones' => ['style' => 'width:90px;']
                    ])
                @endcomponent
            </div>
        </div>
    @endcomponent
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        /*
         * Referencia https://datatables.net/reference/option/
         */
        var table, url, columns;
        table = $('#example-table-ajax');
        url = "{{ route('users.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: function (data, type, dataToSet) {
                return data.name + " " + data.lastname;
            }, name: 'Nombre'},
            {data: 'email', name: 'Descripción'},
            {data: 'roles', name: 'Roles'},
            {data: 'state', name: 'Estado'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
                data:'action',
                name:'action',
                title:'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-right',
                render: null,
                responsivePriority:2
            }
        ];
        dataTableServer.init(table, url, columns);

        table = table.DataTable();
        table.on('click', '.remove', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();

            var route = '{{ route('users.destroy') }}'+'/'+dataTable.id;
            var type = 'DELETE';
            var async = async || false;

            $.ajax({
                url: route,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                cache: false,
                type: type,
                contentType: false,
                processData: false,
                async: async,
                beforeSend: function () {

                },
                success: function (response, xhr, request) {
                    if (request.status === 200 && xhr === 'success') {
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


        });
        table.on('click', '.edit', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '{{ route('users.edit') }}'+ '/'+ dataTable.id;

            $(".content-ajax").load(route_edit);
        });

        $( ".create" ).on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('users.create') }}';
            $(".content-ajax").load(route);
        });

        /*Editar Permiso*/
        var updatePermissions = function () {
            return{
                init: function () {
                    var id_edit = $('input[name="id_edit"]').val();
                    var route = '{{ route('users.update') }}'+'/'+id_edit;
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('name', $('input:text[name="name_edit"]').val());
                    formData.append('description', $('#description_edit').val());

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

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-update-module').modal('hide');
                                $('#from_module_update')[0].reset(); //Limpia formulario
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
        /*Crear Permissions*/
        var createPermissions = function () {
            return{
                init: function () {
                    var route = '{{ route('users.store') }}';
                    var type = 'POST';
                    var async = async || false;

                    var formData = new FormData();
                    formData.append('name', $('input:text[name="name_create"]').val());
                    formData.append('description', $('#description_create').val());

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

                        },
                        success: function (response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                table.ajax.reload();
                                $('#modal-create-module').modal('hide');
                                $('#from_module_create')[0].reset(); //Limpia formulario
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


        var form_edit = $('#from_module_update');
        var rules_edit = {
            name_edit: {minlength: 5, required: true},
            description_edit: {minlength: 5},
        };
        FormValidationMd.init(form_edit,rules_edit,false,updatePermissions());

        var form_create = $('#from_module_create');
        var rules_create = {
            name_create: {minlength: 5, required: true},
            description_create: {minlength: 5},
        };
        FormValidationMd.init(form_create,rules_create,false,createPermissions());

    });
</script>
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Usuarios'])

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
        <div class="clearfix"></div><br><br><br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i
                                class="fa fa-plus"></i>Registrar Usuario</a></div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaUsuarios'])
                        @slot('columns', [
                            'Documento',
                            'Code',
                            'Nombre',
                            'Apellido',
                            'Perfil',
                            'Sede',
                            'Telefono',
                            'Email'
                        ])
                    @endcomponent
                </div>
            </div>
        </div>
    @endcomponent
</div>
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.unblockUI();
        /*
         * Referencia https://datatables.net/reference/option/
         */
        var table, url, columns;
        table = $('#listaUsuarios');
        url = "{{ route('usersUdec.data')}}";
        columns = [
            {data: 'number_document', name: 'number_document'},
            {data: 'code', name: 'code'},
            {data: 'username', name: 'username'},
            {data: 'lastname', name: 'lastname'},
            {data: 'type_user', name: 'type_user'},
            {data: 'place', name: 'place'},
            {data: 'number_phone', name: 'number_phone'},
            {data: 'email', name: 'email'}
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route_create = '{{route('usersUdec.create')}}';
            $(".content-ajax").load(route_create);
        });

    });
</script>
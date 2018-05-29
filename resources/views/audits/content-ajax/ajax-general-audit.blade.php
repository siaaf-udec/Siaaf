
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Auditoria General'])

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
                            'ID Usuario',
                            'Modelo Generador',
                            'Evento',
                            'Dirección Auditoría',
                            'Acciones' => ['style' => 'width:90px;']
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>


<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /*
         * Referencia https://datatables.net/reference/option/
         */
        var table, url, columns;
        table = $('#example-table-ajax');
        url = "{{ route('audits.data') }}";
        columns = [
            {data: 'DT_Row_Index'},
            {data: 'id', "visible": false },
            {data: 'user_id', name: 'user_id'},
            {data: 'user_type', name: 'user_type'},
            {data: 'event', name: 'event'},
            {data: 'auditable_type', name: 'auditable_type'},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-info btn-icon visualize"><i class="icon-eye-open"></i></a>',
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
        
        table.on('click', '.visualize', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data();

            var route = '{{ route('audits.show') }}'+'/'+dataTable.id;
           $(".content-ajax").load(route);

        });
    });
</script>

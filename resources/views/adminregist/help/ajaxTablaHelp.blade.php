<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Preguntas y Respuestas'])

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
                    <a href="javascript:;" class="btn btn-simple dark btn-icon register"><i
                                class="fa fa-chevron-circle-right"></i>Registrar Pregunta</a>

                </div>
            </div>
            <div class="clearfix"></div>
            <br>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                @component('themes.bootstrap.elements.tables.datatables', ['id' => 'listaPreguntas'])
                    @slot('columns', [
                        '#',
                        'Preguntas',
                        'Respuesta',
                        'Acciones'
                    ])
                @endcomponent
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
        table = $('#listaPreguntas');
        url = "{{ route('adminRegist.help.data')}}";
        columns = [
            {data: 'id', name: 'id', "visible": false, searchable: false},
            {data: 'pregunta', name: 'pregunta'},
            {data: 'respuesta', name: 'respuesta', "visible": false},
            {
                defaultContent: '<a href="javascript:;" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-bars"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon mt-sweetalert remove"><i class="icon-trash"></i></a>',
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        $(".register").on('click', function (e) {
            e.preventDefault();
            var route_create = '{{ route('adminRegist.help.create') }}';
            $(".content-ajax").load(route_create);
        });

    });
</script>
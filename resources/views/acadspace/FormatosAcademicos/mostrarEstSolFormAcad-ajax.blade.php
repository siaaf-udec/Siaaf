{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Formatos Academicos'])
        <div class="clearfix">
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i
                                class="fa fa-plus"></i></a></div>
            </div>
        </div>
</div>
<div class="clearfix">
</div>
<br>
<div class="col-md-12">
    {{--COlumnas añadidas a la tabla--}}
    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
        @slot('columns', [
        '#' => ['style' => 'width:20px;'],
        'id_documento',
        'Formato Academico',
        'Fecha',
        'Estado',
        'Acciones' => ['style' => 'width:45px;']

        ])
    @endcomponent
</div>
<div class="clearfix">
</div>

</div>
@endcomponent
</br>
</br>
</br>
</br>

</div>
{{-- END HTML SAMPLE --}}


{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}



{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script>

        /*PINTAR TABLA*/
        $(document).ready(function () {
            var table, url, columns;
            //Define que tabla cargara los datos
            table = $('#art-table-ajax');
            url = "{{ route('espacios.academicos.formacad.data') }}"; //url para cargar datos
            columns = [
                //Carga los datos que ha traido el control
                {data: 'DT_Row_Index'},
                {data: 'PK_FAC_id_solicitud', name: 'id_documento', "visible": false},
                {data: 'FAC_titulo_doc', name: 'Formato Academico'},
                {data: 'created_at', name: 'Fecha'},
                {data: 'estado', name: 'Estado'},
                {
                    //Boton para descargar el archivo
                    defaultContent: '<a href="javascript:;" class="btn btn-simple btn-icon download"><i class="icon-cloud-download"></i></a>',
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
            //table = table.DataTable();
            table = table.DataTable();
            //Funcion para descargar el archivo
            table.on('click', '.download', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                $.ajax({}).done(function () {
                    window.location.href = '{{ route('espacios.academicos.descargarArchivo') }}' + '/' + dataTable.PK_FAC_id_solicitudF;
                });
            });

            //Funcion para abrir nuevo form de registro
            $(".create").on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('espacios.academicos.formacad.create') }}';
                $(".content-ajax").load(route);
            });


        });


    </script>

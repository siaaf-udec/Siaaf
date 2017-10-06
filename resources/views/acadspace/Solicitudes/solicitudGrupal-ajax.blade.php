{{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Solicitudes'])
        <div class="clearfix">
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i>Practica
                        Grupal</a> <a href="javascript:;" class="btn btn-simple btn-success btn-icon createLib"><i
                                class="fa fa-plus"></i>Practica Libre</a></div>

            </div>
        </div>
</div>
<div class="clearfix">
</div>
<br>
<div class="col-md-12">
    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'art-table-ajax'])
        @slot('columns', [
        '#' => ['style' => 'width:20px;'],
        'Nucleo tematico',
        'Estudiantes' => ['class' => 'min-phone-l'],
        'Estado' => ['class' => 'min-phone-l'],
        'Practica' => ['class' => 'min-phone-l'],
        ' '
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


<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<!-- Estandar Mensajes -->
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<!-- Estandar Datatable -->
<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<!-- Informacion que muestra al desplegar -->
<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td>Fecha de creacion:</td>
            <td>@{{created_at}}</td>
        </tr>
        <tr>
            <td>Software:</td>
            <td>@{{SOL_software}}</td>
        </tr>
        <tr>
            <td>Comentario:</td>
            <td>@{{comentario}}</td>
        </tr>
        <tr>
            <td>Sala asignada:</td>
            <td>@{{id_sala}}</td>
        </tr>
    </table>
</script>
<script>

    /*PINTAR TABLA*/
    $(document).ready(function () {
        //capturar el template para desplegar la informacion
        var template = Handlebars.compile($("#details-template").html());

        var table, url, columns;

        table = $('#art-table-ajax');
        url = "{{ route('espacios.academicos.espacad.data') }}";
        columns = [

            {data: 'DT_Row_Index'},
            {data: 'SOL_nucleo_tematico', name: 'Nucleo tematico'},
            {data: 'SOL_cant_estudiantes', name: 'Estudiantes'},
            {data: 'estado', name: 'Estado'},
            {data: 'tipo_prac', name: 'Practica'},
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '<a href="javascript:;" class="btn blue" data-toggle="confirmation"><i class="glyphicon glyphicon-zoom-in"></i></a>'
            }
        ];
        dataTableServer.init(table, url, columns);
        table = table.DataTable();
        //Funcion desplegable de la tabla
        $('#art-table-ajax tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(template(row.data())).show();
                tr.addClass('shown');
            }
        });

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('espacios.academicos.espacad.create') }}';
            $(".content-ajax").load(route);
        });

        $(".createLib").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('espacios.academicos.espacad.createlib') }}';
            $(".content-ajax").load(route);
        });


    });


</script>

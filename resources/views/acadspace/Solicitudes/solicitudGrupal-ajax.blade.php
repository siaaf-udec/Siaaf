{{-- BEGIN HTML SAMPLE --}}
@permission('docentes')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'glyphicon glyphicon-th-list', 'title' => 'Mis Solicitudes'])
        <div class="clearfix">
        </div>
        <br>
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="actions">
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i>Práctica
                        Grupal</a>
                    <a href="javascript:;" class="btn btn-simple btn-success btn-icon createLib"><i
                                class="fa fa-plus"></i>Práctica Libre</a></div>

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
        ' ',
        'Núcleo temático',
        'Estudiantes' => ['class' => 'min-phone-l'],
        'Estado' => ['class' => 'min-phone-l'],
        'Práctica' => ['class' => 'min-phone-l']
        ])
    @endcomponent
</div>
<div class="clearfix">
</div>
@endcomponent

<!-- Informacion que muestra al desplegar -->
<script id="details-template" type="text/x-handlebars-template">
    <table class="table">
        <tr>
            <td>Fecha de creación:</td>
            <td>@{{created_at}}</td>
        </tr>
        <tr>
            <td>Software:</td>
            <td>@{{SOL_Software}}</td>
        </tr>
        <tr>
            <td>Sala asignada:</td>
            <td>@{{FK_SOL_Id_Sala}}</td>
        </tr>
        <tr>
            <td>Observación:</td>
            <td>@{{coment.COM_Comentario}}</td>
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
        url = "{{ route('espacios.academicos.solacad.data') }}";
        columns = [
            {data: 'DT_Row_Index', "visible": false},
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": ''
            },
            {data: 'SOL_Nucleo_Tematico', name: 'Núcleo temático'},
            {data: 'SOL_Cant_Estudiantes', name: 'Estudiantes'},
            {data: 'estado', name: 'Estado'},
            {data: 'tipo_prac', name: 'Práctica'}
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
                tr.removeClass('details');
            }
            else {
                // Open this row
                row.child(template(row.data())).show();
                tr.addClass('details');
            }
        });

        $(".create").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('espacios.academicos.solacad.crearGrupal') }}';
            $(".content-ajax").load(route);
        });

        $(".createLib").on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('espacios.academicos.solacad.crearLibre') }}';
            $(".content-ajax").load(route);
        });
    });
</script>
@endpermission

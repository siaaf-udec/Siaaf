@extends('material.layouts.dashboard')

@push('styles')
    <!-- Datatables Styles -->
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css') }}"
          rel="stylesheet" type="text/css"/>
@endpush

@section('title', '| Proyectos')

@section('page-title', 'Proyectos')


@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'Lista de Proyectos'])
            <div class="row">
                <div class="clearfix"></div>
                <br><br><br><br>
                <div class="col-md-12">
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'lista-anteproyecto'])
                        @slot('columns', [
                        '#' => ['style' => 'width:20px;'],
                        'id',
                        'Titulo',
                        'Palabras Clave',
                        'Duracion',
                        'Fecha Radicacion',
                        'Fecha Limite',
                        'Estado',
                        'Director',
                        'Estudiante 1',
                        'Estudiante 2',
                        'Jurado 1',
                        'Jurado 2'
                        ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
    <!-- Datatables Scripts -->
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js') }}"
            type="text/javascript"></script>
    <!-- identicon Plugins -->
    <script src="{{ asset('assets/global/plugins/stewartlord-identicon/identicon.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/stewartlord-identicon/pnglib.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    <!--Local Scripts-->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
    <script>
        jQuery(document).ready(function () {
            var table, url, columns;
            table = $('#lista-anteproyecto');
            url = "{{ route('proyecto.list') }}";

            columns = [
                {data: 'DT_Row_Index', name: "DT_Row_Index",},
                {data: 'PK_PRYT_IdProyecto', name: "PK_PRYT_IdProyecto", "visible": false},
                {data: 'NPRY_Titulo', name: "NPRY_Titulo", searchable: true},
                {data: 'anteproyecto.NPRY_Keywords', name: "NPRY_Keywords", searchable: true},
                {data: 'anteproyecto.NPRY_Duracion', name: "NPRY_Duracion", searchable: true},
                {data: 'anteproyecto.NPRY_FechaR', name: "NPRY_FechaR", className: 'none', searchable: true},
                {data: 'anteproyecto.NPRY_FechaL', name: "NPRY_FechaL", searchable: true},
                {data: 'PRYT_Estado', searchable: true, name: 'Estado'},
                {
                    data: function (data, type, dataToSet) {
                        if (data.anteproyecto.director[0] != null)
                            return data.anteproyecto.director[0].usuarios.name + " " + data.anteproyecto.director[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
                    }, className: 'none', searchable: true
                },

                {
                    data: function (data, type, dataToSet) {
                        if (data.anteproyecto.estudiante1[0] != null)
                            return data.anteproyecto.estudiante1[0].usuarios.name + " " + data.anteproyecto.estudiante1[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
                    }, className: 'none', searchable: true
                },
                {
                    data: function (data, type, dataToSet) {
                        if (data.anteproyecto.estudiante2[0] != null)
                            return data.anteproyecto.estudiante2[0].usuarios.name + " " + data.anteproyecto.estudiante2[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
                    }, className: 'none', searchable: true
                },
                {
                    data: function (data, type, dataToSet) {
                        if (data.anteproyecto.jurado1[0] != null)
                            return data.anteproyecto.jurado1[0].usuarios.name + " " + data.anteproyecto.jurado1[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
                    }, className: 'none', searchable: true
                },
                {
                    data: function (data, type, dataToSet) {
                        if (data.anteproyecto.jurado2[0] != null)
                            return data.anteproyecto.jurado2[0].usuarios.name + " " + data.anteproyecto.jurado2[0].usuarios.lastname;
                        else
                            return "SIN ASIGNAR"
                    }, className: 'none', searchable: true
                }
            ];

            dataTableServer.init(table, url, columns);
            $(".create").on('click', function (e) {
                e.preventDefault();
                var route = '{{ route('min.create') }}';
                $(".content-ajax").load(route);
            });

            table = table.DataTable();

            table.on('click', '.boton_mas_info', function () {

                if ($(this).parent().find('.texto-ocultado').css('display') == 'none') {
                    $(this).parent().find('.texto-ocultado').css('display', 'inline');
                    $(this).parent().find('.puntos').html(' ');
                    $(this).text('Ver menos');
                } else {
                    $(this).parent().find('.texto-ocultado').css('display', 'none');
                    $(this).parent().find('.puntos').html('...');
                    $(this).html('Ver más');
                }
                ;
            });

        });
    </script>
@endpush
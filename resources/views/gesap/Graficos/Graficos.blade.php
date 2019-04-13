@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet"
      type="text/css"/>
<!-- toastr Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css"/>

<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css"/>

<!-- File Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css"/>

<!-- Modal Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>

<!-- Date Styles -->
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>

@endpush

@section('title', '| Información de los Anteproyectos')

@section('page-title', 'Anteproyectos Universidad De Cundinamarca Extensión Facatativá:')

@section('content')
    @permission('GESAP_ADMIN')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'fa fa-tasks', 'title' => 'Anteproyectos Gráficos:'])

      <html>
          <head>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Año', 'Aprobados', 'Reprobados', 'Aplazados'],
                  ['<?php echo $datos[0]['Año2years']?>', <?php echo $datos[0]['Aprobados2years']; ?>, <?php echo $datos[0]['Reprobados2years']; ?>, <?php echo $datos[0]['Aplazados2years']; ?>],
                  ['<?php echo $datos[0]['Año']?>', <?php echo $datos[0]['Aprobados']; ?>, <?php echo $datos[0]['Reprobados']; ?>, <?php echo $datos[0]['Aplazados']; ?>]
                  
                ]);

                var options = {
                  chart: {
                    title: 'Gráfico Del Calificación Anteproyectos',
                    subtitle: 'Reportes Aprobados, Reprobados y Aplazados El Los Ultimos Dos Años',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
              }
            </script>
          </head>
        <body>
          <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
        </body>
      </html>
      <!-- grafica dos -->
      <html>
      <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Docente', 'Anteproyecto'],
            @foreach($datos2 as $datosx)
              ['<?php echo $datosx['Docente']?>',<?php echo $datosx['NAnteproyectos']?>],
            @endforeach
          ]);

          var options = {
            title: 'Carga de Asignaciónes de Anteproyectos (Activos)',
            pieHole: 0.4,
          };

          var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
          chart.draw(data, options);
        }
      </script>
    </head>
    <body>
      <div id="donutchart" style="width: 900px; height: 500px;"></div>
    </body>
    </html>
    <!-- Grafica 3-->
    <html>
      <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Docente', 'Anteproyecto'],
            @foreach($datos3 as $datosj)
              ['<?php echo $datosj['DocenteJ']?>',<?php echo $datosj['NJurados']?>],
            @endforeach
            ]);

            var options = {
              title: 'Carga de Asignaciónes de Anteproyectos como Jurados(Activos)',
              is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
          }
        </script>
      </head>
      <body>
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
      </body>
    </html>
        @endcomponent
    </div>
    @endpermission
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>

<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    @endpush
    @push('functions')
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src = "{{ asset('assets/main/scripts/table-datatable.js') }}" type = "text/javascript" ></script>
    <script type="text/javascript">

    jQuery(document).ready(function () {


    

    });
</script>
@endpush
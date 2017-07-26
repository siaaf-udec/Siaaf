@extends('material.layouts.dashboard')


@push('styles')
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
<link href="{{-- asset('assets/global/plugins/datatables/datatables.min.css') --}}" rel="stylesheet" type="text/css" />
<link href="{{-- asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') --}}" rel="stylesheet" type="text/css" />
 <link rel='stylesheet' type='text/css' property='stylesheet' href="{{-- asset('localhost/siaaf/public/index.php/_debugbar/assets/stylesheets?v=1498861062') --}}">
<link href="{{-- asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') --}}" rel="stylesheet" type="text/css" />

@endpush



@section('title', '| Dashboard')


@section('page-title', 'Dashboard')


@section('page-description', 'Breve descripción de la página')


@section('content')
   
@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EVALUACIONES'])




@if($eva)      

      <div class="row">
          <div class="col-md-6 col-sm-12">
              <div class="dataTables_length" id="example-table-ajax_length">
                  <label>Mostrar 
                      <select name="example-table-ajax_length" aria-controls="example-table-ajax" class="form-control input-sm input-xsmall input-inline">
                      <option value="5">5</option>
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="-1">Todo</option>
                      </select> registros</label>
              </div>
          </div>
          <div class="col-md-6 col-sm-12">
              <div id="example-table-ajax_filter" class="dataTables_filter">
                  <label>Buscar:<input type="search" class="form-control input-sm input-small input-inline" placeholder="" aria-controls="example-table-ajax">
                  </label>
              </div>
          </div>
          <div id="example-table-ajax_processing" class="dataTables_processing" style="display: none;"><i class="fa fa-spinner fa-spin fa-3x fa-fw">
              </i>
              <span class="sr-only">Procesando...</span>
          </div>
</div>
      <div class="table-scrollable">
          <table class="table table-striped table-bordered table-hover dt-responsive dataTable dtr-inline collapsed" width="100%" id="example-table-ajax" role="grid" aria-describedby="example-table-ajax_info" style="width: 100%;">
    <thead>
    <tr role="row">
        <th style="width: 13px;" class="sorting_asc" tabindex="0" aria-controls="example-table-ajax" rowspan="1" colspan="1" data-column-index="0" aria-sort="ascending" aria-label="#: Activar para ordenar la columna de manera descendente">id </th>
        <th class="sorting" tabindex="0" aria-controls="example-table-ajax" data-column-index="1" aria-label="id: Activar para ordenar la columna de manera ascendente" rowspan="1" colspan="1" style="width: 13px;">Convenio</th>
        <th style="width: 71px;" class="text-right sorting_disabled" rowspan="1" colspan="1" data-column-index="4" aria-label="Acciones">Preguntas</th>
        </tr>
    </thead>
<tbody>
    @foreach($eva as $row)
   <tr role="row" class="odd">
        <td>{{ $row->PK_Evaluacion }}</td>
        <td>{{ $row->FK_TBL_Convenios }}</td>
        <td class=" text-right">
            <a href="javascript:;" class="btn btn-simple green btn-icon edit "><i class="icon-cloud-download"></i></a>
         </td>
    </tr>
              </tbody>
             @endforeach
          </table>
      </div>
      <div class="row">
          <div class="col-md-7 col-sm-12">
              <div class="dataTables_paginate paging_bootstrap_number" id="example-table-ajax_paginate">
                  <ul class="pagination" style="visibility: visible;"><li class="prev disabled">
                      <a href="#" title="Anterior"><i class="fa fa-angle-left">
                          </i>
                      </a>
                      </li>
                      <li class="active">
                          <a href="#">1</a>
                      </li>
                      <li class="next disabled">
                          <a href="#" title="Siguiente">
                              <i class="fa fa-angle-right"></i>
                          </a>
                      </li>
                  </ul>
                  @endif
              </div>
          </div>
</div>
  
@endcomponent

@endsection



@push('plugins')

<script src="{{-- {{ asset('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') }} --}}"></script>
<script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
<script src="{{-- {{ asset('assets/global/scripts/datatable.js') }} --}}" type="text/javascript"></script>
<script src="{{-- {{ asset('siaaf/public/assets/global/plugins/datatables/datatables.min.js') }} --}}" type="text/javascript"></script>
<script src="{{-- {{ asset('siaaf/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }} --}}" type="text/javascript"></script>

@endpush


@push('functions')
{{--
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });
        })
    </script>

--}}
<script>$(document).ready(function() {
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();
});
</script>
<style type="text/css">
    .table-sortable tbody tr {
    cursor: move;
}
</style>
                  <script>
jQuery(document).ready(function () {

/*
* Referencia https://datatables.net/reference/option/
*/

var table, url;
table = $('#example-table-ajax');
url = "http://localhost/siaaf/public/index.php/components/datatables/index";

    table.DataTable({
       lengthMenu: [
           [5, 10, 25, 50, -1],
           [5, 10, 25, 50, "Todo"]
       ],
       responsive: true,
       colReorder: true,
       processing: true,
       serverSide: true,
       ajax: url,
       language: {
           "sProcessing": '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> <span class="sr-only">Procesando...</span>',
           "sLengthMenu": "Mostrar _MENU_ registros",
           "sZeroRecords": "No se encontraron resultados",
           "sEmptyTable": "Ningún dato disponible en esta tabla",
           "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
           "sInfoPostFix": "",
           "sSearch": "Buscar:",
           "sUrl": "",
           "sInfoThousands": ",",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Último",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "oAria": {
               "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
           }
       },
       columns:[
           {data: 'DT_Row_Index'},
           {data: 'id', "visible": false },
           {data: 'name', name: 'Nombre'},
           {data: 'email', name: 'Correo Electronico'},
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
       ],
       buttons: [
           { extend: 'print', className: 'btn btn-circle btn-icon-only btn-default tooltips t-print', text: '<i class="fa fa-print"></i>' },
           { extend: 'copy', className: 'btn btn-circle btn-icon-only btn-default tooltips t-copy', text: '<i class="fa fa-files-o"></i>' },
           { extend: 'pdf', className: 'btn btn-circle btn-icon-only btn-default tooltips t-pdf', text: '<i class="fa fa-file-pdf-o"></i>',},
           { extend: 'excel', className: 'btn btn-circle btn-icon-only btn-default tooltips t-excel', text: '<i class="fa fa-file-excel-o"></i>',},
           { extend: 'csv', className: 'btn btn-circle btn-icon-only btn-default tooltips t-csv',  text: '<i class="fa fa-file-text-o"></i>', },
           { extend: 'colvis', className: 'btn btn-circle btn-icon-only btn-default tooltips t-colvis', text: '<i class="fa fa-bars"></i>'},
           {
               text: '<i class="fa fa-refresh"></i>',
               className: 'btn btn-circle btn-icon-only btn-default tooltips t-refresh',
               action: function ( e, dt, node, config ) {
                   dt.ajax.reload();
               }
           }

       ],
       pageLength: 10,
       dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
    });
});
</script>
                           
 
<script type="text/javascript">
var phpdebugbar = new PhpDebugBar.DebugBar();
phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");
phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));
phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");
phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));
phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));
phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");
phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"database","title":"Queries", "widget": new PhpDebugBar.Widgets.LaravelSQLQueriesWidget()}));
phpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));
phpdebugbar.addTab("auth", new PhpDebugBar.DebugBar.Tab({"icon":"lock","title":"Auth", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addIndicator("auth.name", new PhpDebugBar.DebugBar.Indicator({"icon":"user","tooltip":"Auth status"}), "right");
phpdebugbar.addTab("gate", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Gate", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.setDataMap({
"messages": ["messages.messages", []],
"messages:badge": ["messages.count", null],
"time": ["time.duration_str", '0ms'],
"timeline": ["time", {}],
"memory": ["memory.peak_usage_str", '0B'],
"exceptions": ["exceptions.exceptions", []],
"exceptions:badge": ["exceptions.count", null],
"views": ["views", []],
"views:badge": ["views.nb_templates", 0],
"route": ["route", {}],
"currentroute": ["route.uri", ],
"queries": ["queries", []],
"queries:badge": ["queries.nb_statements", 0],
"emails": ["swiftmailer_mails.mails", []],
"emails:badge": ["swiftmailer_mails.count", null],
"auth": ["auth.guards", {}],
"auth.name": ["auth.names", ],
"gate": ["gate.messages", []],
"gate:badge": ["gate.count", null],
"session": ["session", {}],
"request": ["request", {}]
});
phpdebugbar.restoreState();
phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);
phpdebugbar.ajaxHandler.bindToXHR();
phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\/\/localhost\/siaaf\/public\/index.php\/_debugbar\/open"}));
phpdebugbar.addDataSet({"__meta":{"id":"bdbac2c7263b6f045d602ef2e77ffa40","datetime":"2017-07-06 21:44:49","utime":1499395489.5684,"method":"GET","uri":"\/siaaf\/public\/index.php\/components\/datatables","ip":"::1"},"php":{"version":"5.6.30","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1499395489.351,"end":1499395489.5684,"duration":0.21737885475159,"duration_str":"217.38ms","measures":[{"label":"Booting","start":1499395489.351,"relative_start":0,"end":1499395489.4804,"relative_end":1499395489.4804,"duration":0.1293740272522,"duration_str":"129.37ms","params":[],"collector":null},{"label":"Application","start":1499395489.4304,"relative_start":0.079371929168701,"end":1499395489.5684,"relative_end":0,"duration":0.13800692558289,"duration_str":"138.01ms","params":[],"collector":null}]},"memory":{"peak_usage":11534336,"peak_usage_str":"11MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":21,"templates":[{"name":"examples.datatables (\\resources\\views\\examples\\datatables.blade.php)","param_count":0,"params":[],"type":"blade"},{"name":"themes.bootstrap.elements.tables.datatables (\\resources\\views\\themes\\bootstrap\\elements\\tables\\datatables.blade.php)","param_count":3,"params":["id","slot","columns"],"type":"blade"},{"name":"themes.bootstrap.elements.portlets.portlet (\\resources\\views\\themes\\bootstrap\\elements\\portlets\\portlet.blade.php)","param_count":4,"params":["icon","title","slot","actions"],"type":"blade"},{"name":"material.layouts.dashboard (\\resources\\views\\material\\layouts\\dashboard.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.head (\\resources\\views\\material\\partials\\head.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.header (\\resources\\views\\material\\partials\\header.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.sidebar (\\resources\\views\\material\\partials\\sidebar.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.home-menu (\\resources\\views\\themes\\menus\\home-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.espacios-academicos-menu (\\resources\\views\\themes\\menus\\espacios-academicos-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.audiovisuales-menu (\\resources\\views\\themes\\menus\\audiovisuales-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.parqueaderos-menu (\\resources\\views\\themes\\menus\\parqueaderos-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.financiero-menu (\\resources\\views\\themes\\menus\\financiero-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.interaccion-universitaria-menu (\\resources\\views\\themes\\menus\\interaccion-universitaria-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.talento-humano-menu (\\resources\\views\\themes\\menus\\talento-humano-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.calisoft-menu (\\resources\\views\\themes\\menus\\calisoft-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.gesap-menu (\\resources\\views\\themes\\menus\\gesap-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.escuelas-deportivas-menu (\\resources\\views\\themes\\menus\\escuelas-deportivas-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.breadcrumb (\\resources\\views\\material\\partials\\breadcrumb.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.quick-sidebar (\\resources\\views\\material\\partials\\quick-sidebar.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.footer (\\resources\\views\\material\\partials\\footer.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.scripts (\\resources\\views\\material\\partials\\scripts.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"}]},"route":{"uri":"GET components\/datatables","middleware":"web, auth","uses":"Closure {#290\n  class: \"Illuminate\\Routing\\Router\"\n  this: Illuminate\\Routing\\Router {#21 \u2026}\n  file: \"C:\\xampp\\htdocs\\Siaaf\\routes\\web.php\"\n  line: \"61 to 63\"\n}","namespace":"App\\Http\\Controllers","prefix":"\/components","where":[],"as":"components.datatables","file":"\\routes\\web.php:61-63"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.012,"accumulated_duration_str":"12ms","statements":[{"sql":"select * from `users` where `id` = '1' and `users`.`deleted_at` is null limit 1","type":"query","params":[],"bindings":["1"],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":37,"namespace":"middleware","name":"auth","line":33},{"index":64,"namespace":null,"name":"\\public\\index.php","line":54}],"duration":0.012,"duration_str":"12ms","stmt_id":"middleware::auth:33","connection":"developer"}]},"swiftmailer_mails":{"count":0,"mails":[]},"auth":{"guards":{"web":"array:2 [\n  \"name\" => \"root@app.com\"\n  \"user\" => array:6 [\n    \"id\" => 1\n    \"name\" => \"root\"\n    \"email\" => \"root@app.com\"\n    \"created_at\" => \"2017-06-30 17:25:42\"\n    \"updated_at\" => \"2017-06-30 17:25:42\"\n    \"deleted_at\" => null\n  ]\n]","api":"array:2 [\n  \"name\" => \"Guest\"\n  \"user\" => array:1 [\n    \"guest\" => true\n  ]\n]"},"names":"web: root@app.com"},"gate":{"count":0,"messages":[]},"session":{"_token":"7uEDE9bNvq9rnv5JRi4rrB4S5saBUrxS1hCjtilj","url":"[]","_previous":"array:1 [\n  \"url\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/components\/datatables\"\n]","styde\/alerts":"[]","_flash":"array:2 [\n  \"old\" => []\n  \"new\" => []\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]"},"request":{"format":"html","content_type":"text\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\n  \"host\" => array:1 [\n    0 => \"localhost\"\n  ]\n  \"connection\" => array:1 [\n    0 => \"keep-alive\"\n  ]\n  \"upgrade-insecure-requests\" => array:1 [\n    0 => \"1\"\n  ]\n  \"user-agent\" => array:1 [\n    0 => \"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36\"\n  ]\n  \"accept\" => array:1 [\n    0 => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8\"\n  ]\n  \"referer\" => array:1 [\n    0 => \"http:\/\/localhost\/siaaf\/public\/index.php\/interaccion-universitaria\/funcionarios\"\n  ]\n  \"accept-encoding\" => array:1 [\n    0 => \"gzip, deflate, br\"\n  ]\n  \"accept-language\" => array:1 [\n    0 => \"es-419,es;q=0.8\"\n  ]\n  \"cookie\" => array:1 [\n    0 => \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6InMzWk02QzczNytWSEZ6WStjc3k1ZkE9PSIsInZhbHVlIjoiWjlIaGRcL2JYSzNrdThHYmgzUHJLVmUzbjhQb2duaUpZK1oxOHdUbFZEcGs9IiwibWFjIjoiODVlNzY1M2NlMDJmZWMzY2U3MzMyZjliODFhNjcxMWExYzIzYTJkNjMyNDQyYmFkYzlhMGIzMWFjYzIzMzMyYyJ9; XSRF-TOKEN=eyJpdiI6IlZBTVpuMFdRWXJJeVNMN1U0KzI5dUE9PSIsInZhbHVlIjoiZUZ0eXZRZWExQWhyK25aSk5GdnNTQSt0OHJ2RUJ5XC9ZYnkwc2ZTeFJEd3ZtM1M2bHJ0bWNFT2pjVE5XaW9DQ3RkQzB6Sms5VEYwSEgxQWpZNmE0ZG5RPT0iLCJtYWMiOiI2NjM5ZTdiZWY5MTNiYmMzOGRiMTc0OTMzZjRhYmRiNjk1OGFmYzA5NTM2NDUwZTQ0NWYyNDhmMDlhNmVlZDc5In0%3D; laravel_session=eyJpdiI6InkzbnlFRjUrTG5tOWJzM0haUlwvTWxRPT0iLCJ2YWx1ZSI6IktKMTRoZWJ4TXBEZTBlTDY5VklsTG1tK2ErMzJNUVl0alU2cURFdTg0RmtPYTNaQ1wvSUxJcktVUEp3c0hXNDdXcHgxSW1kNitxdnZQZjl0Tzd2cE5IQT09IiwibWFjIjoiYjdjZDBkYmJiN2UwMGU3NjE2NTMzZWQ1YTI4MjAwNzExNDY5ZWM3MTMxOTdkYWQzNTk5OWEyMmM0NjY3YTlkMSJ9\"\n  ]\n]","request_server":"array:44 [\n  \"MIBDIRS\" => \"C:\/xampp\/php\/extras\/mibs\"\n  \"MYSQL_HOME\" => \"\\xampp\\mysql\\bin\"\n  \"OPENSSL_CONF\" => \"C:\/xampp\/apache\/bin\/openssl.cnf\"\n  \"PHP_PEAR_SYSCONF_DIR\" => \"\\xampp\\php\"\n  \"PHPRC\" => \"\\xampp\\php\"\n  \"TMP\" => \"\\xampp\\tmp\"\n  \"HTTP_HOST\" => \"localhost\"\n  \"HTTP_CONNECTION\" => \"keep-alive\"\n  \"HTTP_UPGRADE_INSECURE_REQUESTS\" => \"1\"\n  \"HTTP_USER_AGENT\" => \"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36\"\n  \"HTTP_ACCEPT\" => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8\"\n  \"HTTP_REFERER\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/interaccion-universitaria\/funcionarios\"\n  \"HTTP_ACCEPT_ENCODING\" => \"gzip, deflate, br\"\n  \"HTTP_ACCEPT_LANGUAGE\" => \"es-419,es;q=0.8\"\n  \"HTTP_COOKIE\" => \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6InMzWk02QzczNytWSEZ6WStjc3k1ZkE9PSIsInZhbHVlIjoiWjlIaGRcL2JYSzNrdThHYmgzUHJLVmUzbjhQb2duaUpZK1oxOHdUbFZEcGs9IiwibWFjIjoiODVlNzY1M2NlMDJmZWMzY2U3MzMyZjliODFhNjcxMWExYzIzYTJkNjMyNDQyYmFkYzlhMGIzMWFjYzIzMzMyYyJ9; XSRF-TOKEN=eyJpdiI6IlZBTVpuMFdRWXJJeVNMN1U0KzI5dUE9PSIsInZhbHVlIjoiZUZ0eXZRZWExQWhyK25aSk5GdnNTQSt0OHJ2RUJ5XC9ZYnkwc2ZTeFJEd3ZtM1M2bHJ0bWNFT2pjVE5XaW9DQ3RkQzB6Sms5VEYwSEgxQWpZNmE0ZG5RPT0iLCJtYWMiOiI2NjM5ZTdiZWY5MTNiYmMzOGRiMTc0OTMzZjRhYmRiNjk1OGFmYzA5NTM2NDUwZTQ0NWYyNDhmMDlhNmVlZDc5In0%3D; laravel_session=eyJpdiI6InkzbnlFRjUrTG5tOWJzM0haUlwvTWxRPT0iLCJ2YWx1ZSI6IktKMTRoZWJ4TXBEZTBlTDY5VklsTG1tK2ErMzJNUVl0alU2cURFdTg0RmtPYTNaQ1wvSUxJcktVUEp3c0hXNDdXcHgxSW1kNitxdnZQZjl0Tzd2cE5IQT09IiwibWFjIjoiYjdjZDBkYmJiN2UwMGU3NjE2NTMzZWQ1YTI4MjAwNzExNDY5ZWM3MTMxOTdkYWQzNTk5OWEyMmM0NjY3YTlkMSJ9\"\n  \"PATH\" => \"C:\\Windows\\system32;C:\\Windows;C:\\Windows\\System32\\Wbem;C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\;C:\\xampp\\php;C:\\ProgramData\\ComposerSetup\\bin;C:\\Program Files (x86)\\Brackets\\command;C:\\Users\\yisus\\AppData\\Roaming\\Composer\\vendor\\bin\"\n  \"SystemRoot\" => \"C:\\Windows\"\n  \"COMSPEC\" => \"C:\\Windows\\system32\\cmd.exe\"\n  \"PATHEXT\" => \".COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC\"\n  \"WINDIR\" => \"C:\\Windows\"\n  \"SERVER_SIGNATURE\" => \"<address>Apache\/2.4.25 (Win32) OpenSSL\/1.0.2j PHP\/5.6.30 Server at localhost Port 80<\/address>\\n\"\n  \"SERVER_SOFTWARE\" => \"Apache\/2.4.25 (Win32) OpenSSL\/1.0.2j PHP\/5.6.30\"\n  \"SERVER_NAME\" => \"localhost\"\n  \"SERVER_ADDR\" => \"::1\"\n  \"SERVER_PORT\" => \"80\"\n  \"REMOTE_ADDR\" => \"::1\"\n  \"DOCUMENT_ROOT\" => \"C:\/xampp\/htdocs\"\n  \"REQUEST_SCHEME\" => \"http\"\n  \"CONTEXT_PREFIX\" => \"\"\n  \"CONTEXT_DOCUMENT_ROOT\" => \"C:\/xampp\/htdocs\"\n  \"SERVER_ADMIN\" => \"postmaster@localhost\"\n  \"SCRIPT_FILENAME\" => \"C:\/xampp\/htdocs\/Siaaf\/public\/index.php\"\n  \"REMOTE_PORT\" => \"4468\"\n  \"GATEWAY_INTERFACE\" => \"CGI\/1.1\"\n  \"SERVER_PROTOCOL\" => \"HTTP\/1.1\"\n  \"REQUEST_METHOD\" => \"GET\"\n  \"QUERY_STRING\" => \"\"\n  \"REQUEST_URI\" => \"\/siaaf\/public\/index.php\/components\/datatables\"\n  \"SCRIPT_NAME\" => \"\/siaaf\/public\/index.php\"\n  \"PATH_INFO\" => \"\/components\/datatables\"\n  \"PATH_TRANSLATED\" => \"C:\\xampp\\htdocs\\components\\datatables\"\n  \"PHP_SELF\" => \"\/siaaf\/public\/index.php\/components\/datatables\"\n  \"REQUEST_TIME_FLOAT\" => 1499395489.351\n  \"REQUEST_TIME\" => 1499395489\n]","request_cookies":"array:3 [\n  \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => null\n  \"XSRF-TOKEN\" => \"7uEDE9bNvq9rnv5JRi4rrB4S5saBUrxS1hCjtilj\"\n  \"laravel_session\" => \"u9GGdfU7FKJFy0OSjPTo9jfY2ZhysjxlDBpv4eEI\"\n]","response_headers":"array:5 [\n  \"cache-control\" => array:1 [\n    0 => \"no-cache, private\"\n  ]\n  \"date\" => array:1 [\n    0 => \"Fri, 07 Jul 2017 02:44:49 GMT\"\n  ]\n  \"content-type\" => array:1 [\n    0 => \"text\/html; charset=UTF-8\"\n  ]\n  \"set-cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IlNDeGd5U2lCa2FvYmwyMzRxWUtrcnc9PSIsInZhbHVlIjoiSUw5XC9NazdXK2ZicnA5c0RhdnNJYW9JU1RlXC9wSkNEcDJjc2FmK1wvUFVSMlIzVzJUbTVMck94THpIUFRrTnRpUjlFUEFjY1VlY040RXBldnNwdG84WXc9PSIsIm1hYyI6IjQ1MDliNWQ3MDcwOWNmOWQwNjBmZjk0YTg0YTc5NmZkZGRiN2JkMTRhOGNiZGNkMjY2Y2E0NGEwOWNjZGFiMDMifQ%3D%3D; expires=Fri, 07-Jul-2017 04:44:49 GMT; max-age=7200; path=\/\"\n    1 => \"laravel_session=eyJpdiI6ImhBZVdMdGo5aUpuREdlQWh1bFFsVkE9PSIsInZhbHVlIjoiN2s1Rnc3bjBsZm8xa1BrdnpQc2tLZGtQRWkzeTJSN0d5bXE4b1lcL3Q5eHNYek0xazE4cmtCUXkyVDAwR1hDM2E2bUlqQkx5T25PTjBqT1M3MTFyVkd3PT0iLCJtYWMiOiIwMmMxZjhmNzM5YTUyZDk1ZDI4ODQ2ODgyZjA2MjJiMDMwMDk5NWRmNGI0MDc5ZWMwM2E4YTNhYWJjNWVhYmNmIn0%3D; expires=Fri, 07-Jul-2017 04:44:49 GMT; max-age=7200; path=\/; httponly\"\n  ]\n  \"Set-Cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IlNDeGd5U2lCa2FvYmwyMzRxWUtrcnc9PSIsInZhbHVlIjoiSUw5XC9NazdXK2ZicnA5c0RhdnNJYW9JU1RlXC9wSkNEcDJjc2FmK1wvUFVSMlIzVzJUbTVMck94THpIUFRrTnRpUjlFUEFjY1VlY040RXBldnNwdG84WXc9PSIsIm1hYyI6IjQ1MDliNWQ3MDcwOWNmOWQwNjBmZjk0YTg0YTc5NmZkZGRiN2JkMTRhOGNiZGNkMjY2Y2E0NGEwOWNjZGFiMDMifQ%3D%3D; expires=Fri, 07-Jul-2017 04:44:49 GMT; path=\/\"\n    1 => \"laravel_session=eyJpdiI6ImhBZVdMdGo5aUpuREdlQWh1bFFsVkE9PSIsInZhbHVlIjoiN2s1Rnc3bjBsZm8xa1BrdnpQc2tLZGtQRWkzeTJSN0d5bXE4b1lcL3Q5eHNYek0xazE4cmtCUXkyVDAwR1hDM2E2bUlqQkx5T25PTjBqT1M3MTFyVkd3PT0iLCJtYWMiOiIwMmMxZjhmNzM5YTUyZDk1ZDI4ODQ2ODgyZjA2MjJiMDMwMDk5NWRmNGI0MDc5ZWMwM2E4YTNhYWJjNWVhYmNmIn0%3D; expires=Fri, 07-Jul-2017 04:44:49 GMT; path=\/; httponly\"\n  ]\n]","path_info":"\/components\/datatables","session_attributes":"array:7 [\n  \"_token\" => \"7uEDE9bNvq9rnv5JRi4rrB4S5saBUrxS1hCjtilj\"\n  \"url\" => []\n  \"_previous\" => array:1 [\n    \"url\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/components\/datatables\"\n  ]\n  \"styde\/alerts\" => []\n  \"_flash\" => array:2 [\n    \"old\" => []\n    \"new\" => []\n  ]\n  \"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => 1\n  \"PHPDEBUGBAR_STACK_DATA\" => []\n]"}}, "bdbac2c7263b6f045d602ef2e77ffa40");

</script>
@endpush
@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
    <link href="{{-- asset('https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css') --}}" rel="stylesheet" type="text/css" />
    <link href="{{-- asset('http://localhost/siaaf/public/assets/global/plugins/datatables/datatables.min.css') --}}" rel="stylesheet" type="text/css" />
    <link href="{{-- asset('http://localhost/siaaf/public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') --}}" rel="stylesheet" type="text/css" />


@endpush

@section('title', '| Dashboard')


@section('page-title', 'MENU PRINCIPAL')


@section('page-description', 'Breve descripción de la página')

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'MENU'])
      <div class="row" id="sortable_portlets">
                                    <div class="col-md-12">
            <div class="portlet portlet-sortable light bordered portlet-form">
    <div class="portlet-title">
        <div class="caption font-green">
            <i class=" icon-frame font-green"></i>
            <span class="caption-subject bold uppercase"> Datatable Ajax </span>
        </div>
        <div class="actions">
                                                <a class="btn btn-circle btn-icon-only btn-default" id="link_upload" href=" javascript:; ">
                        <i class="icon-cloud-upload"></i>
                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" id="link_wrench" href=" javascript:; ">
                        <i class="icon-wrench"></i>
                    </a>
                                    <a class="btn btn-circle btn-icon-only btn-default" id="link_trash" href=" javascript:; ">
                        <i class="icon-trash"></i>
                    </a>
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="clearfix"> </div><br><br><br>
                <div class="row">
                    <div class="col-md-12">

       <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="example-table-ajax">
    <thead>
    <tr>
                    
                            
                                                                            <th style=&quot;width:20px;&quot;>#</th>
                    
                                                    <th >id</th>
                    
                                                    <th >Nombre</th>
                    
                                                    <th >Email</th>
                    
                            
                                                                            <th style=&quot;width:90px;&quot;>Acciones</th>
            </tr>
    </thead>
    <tfoot>
    <tr>
                    
                            
                                                                            <th style=&quot;width:20px;&quot;>#</th>
                    
                                                    <th >id</th>
                    
                                                    <th >Nombre</th>
                    
                                                    <th >Email</th>
                    
                            
                                                                            <th style=&quot;width:90px;&quot;>Acciones</th>
            </tr>
    </tfoot>
</table> 
 </div>
                    <div class="clearfix"> </div><br><br><br>

    @endcomponent
@endsection



@push('plugins')
    
    <script src="{{-- {{ asset('assets/global/scripts/datatable.js') }} --}}"  type="text/javascript"></script>
    <script src="{{-- {{ asset('https://code.jquery.com/jquery-1.12.4.js ') }} --}}"  type="text/javascript"></script>
    <script src="{{-- {{ asset('Https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js') }} --}}"  type="text/javascript"></script>
<script src="{{-- {{ asset('assets/global/scripts/datatable.js') }} --}}" type="text/javascript"></script>
<script src="{{-- {{ asset('assets/global/plugins/datatables/datatables.min.js') }} --}}" type="text/javascript"></script>
<script src="{{-- {{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }} --}}" type="text/javascript"></script>

    

@endpush

@push('functions')
<script>
$(document).ready(function() {
    $('Listar_Usuarios').DataTable();
} );
</script>
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
phpdebugbar.addDataSet({"__meta":{"id":"9cc98b1b0b04a424ef1a7763851c4b3e","datetime":"2017-07-11 22:49:36","utime":1499831376.8251,"method":"GET","uri":"\/siaaf\/public\/index.php\/components\/datatables","ip":"::1"},"php":{"version":"5.6.30","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1499831376.634,"end":1499831376.8251,"duration":0.1911449432373,"duration_str":"191.14ms","measures":[{"label":"Booting","start":1499831376.634,"relative_start":0,"end":1499831376.7571,"relative_end":1499831376.7571,"duration":0.12314105033875,"duration_str":"123.14ms","params":[],"collector":null},{"label":"Application","start":1499831376.7121,"relative_start":0.078138828277588,"end":1499831376.8251,"relative_end":0,"duration":0.11300611495972,"duration_str":"113.01ms","params":[],"collector":null}]},"memory":{"peak_usage":11534336,"peak_usage_str":"11MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":21,"templates":[{"name":"examples.datatables (\\resources\\views\\examples\\datatables.blade.php)","param_count":0,"params":[],"type":"blade"},{"name":"themes.bootstrap.elements.tables.datatables (\\resources\\views\\themes\\bootstrap\\elements\\tables\\datatables.blade.php)","param_count":3,"params":["id","slot","columns"],"type":"blade"},{"name":"themes.bootstrap.elements.portlets.portlet (\\resources\\views\\themes\\bootstrap\\elements\\portlets\\portlet.blade.php)","param_count":4,"params":["icon","title","slot","actions"],"type":"blade"},{"name":"material.layouts.dashboard (\\resources\\views\\material\\layouts\\dashboard.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.head (\\resources\\views\\material\\partials\\head.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.header (\\resources\\views\\material\\partials\\header.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.sidebar (\\resources\\views\\material\\partials\\sidebar.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.home-menu (\\resources\\views\\themes\\menus\\home-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.espacios-academicos-menu (\\resources\\views\\themes\\menus\\espacios-academicos-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.audiovisuales-menu (\\resources\\views\\themes\\menus\\audiovisuales-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.parqueaderos-menu (\\resources\\views\\themes\\menus\\parqueaderos-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.financiero-menu (\\resources\\views\\themes\\menus\\financiero-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.interaccion-universitaria-menu (\\resources\\views\\themes\\menus\\interaccion-universitaria-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.talento-humano-menu (\\resources\\views\\themes\\menus\\talento-humano-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.calisoft-menu (\\resources\\views\\themes\\menus\\calisoft-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.gesap-menu (\\resources\\views\\themes\\menus\\gesap-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"themes.menus.escuelas-deportivas-menu (\\resources\\views\\themes\\menus\\escuelas-deportivas-menu.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.breadcrumb (\\resources\\views\\material\\partials\\breadcrumb.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.quick-sidebar (\\resources\\views\\material\\partials\\quick-sidebar.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.footer (\\resources\\views\\material\\partials\\footer.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"material.partials.scripts (\\resources\\views\\material\\partials\\scripts.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"}]},"route":{"uri":"GET components\/datatables","middleware":"web, auth","uses":"Closure {#290\n  class: \"Illuminate\\Routing\\Router\"\n  this: Illuminate\\Routing\\Router {#21 \u2026}\n  file: \"C:\\xampp\\htdocs\\Siaaf\\routes\\web.php\"\n  line: \"61 to 63\"\n}","namespace":"App\\Http\\Controllers","prefix":"\/components","where":[],"as":"components.datatables","file":"\\routes\\web.php:61-63"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.002,"accumulated_duration_str":"2ms","statements":[{"sql":"select * from `users` where `id` = '1' and `users`.`deleted_at` is null limit 1","type":"query","params":[],"bindings":["1"],"hints":["Use <code>SELECT *<\/code> only if you need all columns from table","<code>LIMIT<\/code> without <code>ORDER BY<\/code> causes non-deterministic results, depending on the query execution plan"],"backtrace":[{"index":37,"namespace":"middleware","name":"auth","line":33},{"index":64,"namespace":null,"name":"\\public\\index.php","line":54}],"duration":0.002,"duration_str":"2ms","stmt_id":"middleware::auth:33","connection":"developer"}]},"swiftmailer_mails":{"count":0,"mails":[]},"auth":{"guards":{"web":"array:2 [\n  \"name\" => \"root@app.com\"\n  \"user\" => array:6 [\n    \"id\" => 1\n    \"name\" => \"root\"\n    \"email\" => \"root@app.com\"\n    \"created_at\" => \"2017-06-30 17:25:42\"\n    \"updated_at\" => \"2017-06-30 17:25:42\"\n    \"deleted_at\" => null\n  ]\n]","api":"array:2 [\n  \"name\" => \"Guest\"\n  \"user\" => array:1 [\n    \"guest\" => true\n  ]\n]"},"names":"web: root@app.com"},"gate":{"count":0,"messages":[]},"session":{"_token":"at5e2VhpVANIbAkofs5HwTwxfDA35fd3kIaki6Td","url":"[]","_previous":"array:1 [\n  \"url\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/components\/datatables\"\n]","styde\/alerts":"[]","_flash":"array:2 [\n  \"old\" => []\n  \"new\" => []\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]"},"request":{"format":"html","content_type":"text\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\n  \"host\" => array:1 [\n    0 => \"localhost\"\n  ]\n  \"connection\" => array:1 [\n    0 => \"keep-alive\"\n  ]\n  \"upgrade-insecure-requests\" => array:1 [\n    0 => \"1\"\n  ]\n  \"user-agent\" => array:1 [\n    0 => \"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36\"\n  ]\n  \"accept\" => array:1 [\n    0 => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8\"\n  ]\n  \"referer\" => array:1 [\n    0 => \"http:\/\/localhost\/siaaf\/public\/index.php\/interaccion-universitaria\/Prueba\"\n  ]\n  \"accept-encoding\" => array:1 [\n    0 => \"gzip, deflate, br\"\n  ]\n  \"accept-language\" => array:1 [\n    0 => \"es-419,es;q=0.8\"\n  ]\n  \"cookie\" => array:1 [\n    0 => \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6InMzWk02QzczNytWSEZ6WStjc3k1ZkE9PSIsInZhbHVlIjoiWjlIaGRcL2JYSzNrdThHYmgzUHJLVmUzbjhQb2duaUpZK1oxOHdUbFZEcGs9IiwibWFjIjoiODVlNzY1M2NlMDJmZWMzY2U3MzMyZjliODFhNjcxMWExYzIzYTJkNjMyNDQyYmFkYzlhMGIzMWFjYzIzMzMyYyJ9; XSRF-TOKEN=eyJpdiI6InJldkJpMW5tXC9HOGpydnZWVVwvZ2JmQT09IiwidmFsdWUiOiJUN1BGRmhXXC9tcE1VU0RIalg0TmYzN3pIK05Oc2E3VTBVSEs1clZZSXNncjNLNHB3c3BWM3lnQ3B6cThCeW5VTkV3bUVxb05iNUlGaDNDWHBMdWVQWkE9PSIsIm1hYyI6IjY0ZDg0MWVjYjNkMTkyNjdlMzBmNTIyZWYwZTdkN2Q5YzViYTUzYmY3YzBhNDJmMDhmODRhM2Q4ODY2NDkxN2QifQ%3D%3D; laravel_session=eyJpdiI6IllQNjl2T2ZTVmE4ZDdxMGtWU3c3anc9PSIsInZhbHVlIjoicTBmcVFqaGtXNVAzbXY5WlFrTm5vbUp6VXVsaGt4bEhQQ3Vva2lBcGlzcGVWY3JrSmZOK1pvQUltRkF4WUhtXC9HZGJ1THVpN1VkMzZodVVFMjFkSkxBPT0iLCJtYWMiOiIxODJmM2ZhYmVkYjgzMzBlNjhkOWI1OTU1ZjZlZjAwZTU4NGZmNzIzOTNhODE5MzZmYWNjNTA3ODc1YzJmMWQ1In0%3D\"\n  ]\n]","request_server":"array:44 [\n  \"MIBDIRS\" => \"C:\/xampp\/php\/extras\/mibs\"\n  \"MYSQL_HOME\" => \"\\xampp\\mysql\\bin\"\n  \"OPENSSL_CONF\" => \"C:\/xampp\/apache\/bin\/openssl.cnf\"\n  \"PHP_PEAR_SYSCONF_DIR\" => \"\\xampp\\php\"\n  \"PHPRC\" => \"\\xampp\\php\"\n  \"TMP\" => \"\\xampp\\tmp\"\n  \"HTTP_HOST\" => \"localhost\"\n  \"HTTP_CONNECTION\" => \"keep-alive\"\n  \"HTTP_UPGRADE_INSECURE_REQUESTS\" => \"1\"\n  \"HTTP_USER_AGENT\" => \"Mozilla\/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/59.0.3071.115 Safari\/537.36\"\n  \"HTTP_ACCEPT\" => \"text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8\"\n  \"HTTP_REFERER\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/interaccion-universitaria\/Prueba\"\n  \"HTTP_ACCEPT_ENCODING\" => \"gzip, deflate, br\"\n  \"HTTP_ACCEPT_LANGUAGE\" => \"es-419,es;q=0.8\"\n  \"HTTP_COOKIE\" => \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d=eyJpdiI6InMzWk02QzczNytWSEZ6WStjc3k1ZkE9PSIsInZhbHVlIjoiWjlIaGRcL2JYSzNrdThHYmgzUHJLVmUzbjhQb2duaUpZK1oxOHdUbFZEcGs9IiwibWFjIjoiODVlNzY1M2NlMDJmZWMzY2U3MzMyZjliODFhNjcxMWExYzIzYTJkNjMyNDQyYmFkYzlhMGIzMWFjYzIzMzMyYyJ9; XSRF-TOKEN=eyJpdiI6InJldkJpMW5tXC9HOGpydnZWVVwvZ2JmQT09IiwidmFsdWUiOiJUN1BGRmhXXC9tcE1VU0RIalg0TmYzN3pIK05Oc2E3VTBVSEs1clZZSXNncjNLNHB3c3BWM3lnQ3B6cThCeW5VTkV3bUVxb05iNUlGaDNDWHBMdWVQWkE9PSIsIm1hYyI6IjY0ZDg0MWVjYjNkMTkyNjdlMzBmNTIyZWYwZTdkN2Q5YzViYTUzYmY3YzBhNDJmMDhmODRhM2Q4ODY2NDkxN2QifQ%3D%3D; laravel_session=eyJpdiI6IllQNjl2T2ZTVmE4ZDdxMGtWU3c3anc9PSIsInZhbHVlIjoicTBmcVFqaGtXNVAzbXY5WlFrTm5vbUp6VXVsaGt4bEhQQ3Vva2lBcGlzcGVWY3JrSmZOK1pvQUltRkF4WUhtXC9HZGJ1THVpN1VkMzZodVVFMjFkSkxBPT0iLCJtYWMiOiIxODJmM2ZhYmVkYjgzMzBlNjhkOWI1OTU1ZjZlZjAwZTU4NGZmNzIzOTNhODE5MzZmYWNjNTA3ODc1YzJmMWQ1In0%3D\"\n  \"PATH\" => \"C:\\Windows\\system32;C:\\Windows;C:\\Windows\\System32\\Wbem;C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\;C:\\xampp\\php;C:\\ProgramData\\ComposerSetup\\bin;C:\\Program Files (x86)\\Brackets\\command;C:\\Users\\yisus\\AppData\\Roaming\\Composer\\vendor\\bin\"\n  \"SystemRoot\" => \"C:\\Windows\"\n  \"COMSPEC\" => \"C:\\Windows\\system32\\cmd.exe\"\n  \"PATHEXT\" => \".COM;.EXE;.BAT;.CMD;.VBS;.VBE;.JS;.JSE;.WSF;.WSH;.MSC\"\n  \"WINDIR\" => \"C:\\Windows\"\n  \"SERVER_SIGNATURE\" => \"<address>Apache\/2.4.25 (Win32) OpenSSL\/1.0.2j PHP\/5.6.30 Server at localhost Port 80<\/address>\\n\"\n  \"SERVER_SOFTWARE\" => \"Apache\/2.4.25 (Win32) OpenSSL\/1.0.2j PHP\/5.6.30\"\n  \"SERVER_NAME\" => \"localhost\"\n  \"SERVER_ADDR\" => \"::1\"\n  \"SERVER_PORT\" => \"80\"\n  \"REMOTE_ADDR\" => \"::1\"\n  \"DOCUMENT_ROOT\" => \"C:\/xampp\/htdocs\"\n  \"REQUEST_SCHEME\" => \"http\"\n  \"CONTEXT_PREFIX\" => \"\"\n  \"CONTEXT_DOCUMENT_ROOT\" => \"C:\/xampp\/htdocs\"\n  \"SERVER_ADMIN\" => \"postmaster@localhost\"\n  \"SCRIPT_FILENAME\" => \"C:\/xampp\/htdocs\/Siaaf\/public\/index.php\"\n  \"REMOTE_PORT\" => \"8326\"\n  \"GATEWAY_INTERFACE\" => \"CGI\/1.1\"\n  \"SERVER_PROTOCOL\" => \"HTTP\/1.1\"\n  \"REQUEST_METHOD\" => \"GET\"\n  \"QUERY_STRING\" => \"\"\n  \"REQUEST_URI\" => \"\/siaaf\/public\/index.php\/components\/datatables\"\n  \"SCRIPT_NAME\" => \"\/siaaf\/public\/index.php\"\n  \"PATH_INFO\" => \"\/components\/datatables\"\n  \"PATH_TRANSLATED\" => \"C:\\xampp\\htdocs\\components\\datatables\"\n  \"PHP_SELF\" => \"\/siaaf\/public\/index.php\/components\/datatables\"\n  \"REQUEST_TIME_FLOAT\" => 1499831376.634\n  \"REQUEST_TIME\" => 1499831376\n]","request_cookies":"array:3 [\n  \"remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => null\n  \"XSRF-TOKEN\" => \"at5e2VhpVANIbAkofs5HwTwxfDA35fd3kIaki6Td\"\n  \"laravel_session\" => \"3inPxJmIouFdS3MUx6fEIP1HHItzXLjfmoujgU3J\"\n]","response_headers":"array:5 [\n  \"cache-control\" => array:1 [\n    0 => \"no-cache, private\"\n  ]\n  \"date\" => array:1 [\n    0 => \"Wed, 12 Jul 2017 03:49:36 GMT\"\n  ]\n  \"content-type\" => array:1 [\n    0 => \"text\/html; charset=UTF-8\"\n  ]\n  \"set-cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IkNXN1lMYk4xR0tLc0xuaHRZQnh2alE9PSIsInZhbHVlIjoiM3pVTEROc0RVOTVrQkhZWlNzQWg5Y0ZRclBwdFNWVjUxSStzdXdkK2hhM29EakxOTEFUR1I4Q2tDcHJMNGZJeVB3Tk13UWJxemJLdm9uVnVPcVlzYkE9PSIsIm1hYyI6IjFlZjQyOGMyZTQwMTE4MzA0OGNkZmM4MDE3NWQxYTcyZDczYmU2YjY0NTFhNWM4ZmI0Njk2NzNjYzIyODQ1ZjMifQ%3D%3D; expires=Wed, 12-Jul-2017 05:49:36 GMT; max-age=7200; path=\/\"\n    1 => \"laravel_session=eyJpdiI6ImpPRjh2ckpqYmZoZlN6ZXYxcTd3amc9PSIsInZhbHVlIjoiaGw5c2dSWFlhNlU4akdScHhCNWdjbzhqK2JRZGV2d1dWbGp6VEVydWU0UFNsZTQra3NsYzYrNjdheU9VbUZURzhxVWdVaWl0VTRNckkwWTZLMm5UU1E9PSIsIm1hYyI6IjRlZWY5MDIwOGJlYjQ0YzAxNWYxMTJhZjhkYTFmMmIyNGVlZjYxYWFjMTUzNTBiYWQxNmJkN2JjNGU0YzQ0NGUifQ%3D%3D; expires=Wed, 12-Jul-2017 05:49:36 GMT; max-age=7200; path=\/; httponly\"\n  ]\n  \"Set-Cookie\" => array:2 [\n    0 => \"XSRF-TOKEN=eyJpdiI6IkNXN1lMYk4xR0tLc0xuaHRZQnh2alE9PSIsInZhbHVlIjoiM3pVTEROc0RVOTVrQkhZWlNzQWg5Y0ZRclBwdFNWVjUxSStzdXdkK2hhM29EakxOTEFUR1I4Q2tDcHJMNGZJeVB3Tk13UWJxemJLdm9uVnVPcVlzYkE9PSIsIm1hYyI6IjFlZjQyOGMyZTQwMTE4MzA0OGNkZmM4MDE3NWQxYTcyZDczYmU2YjY0NTFhNWM4ZmI0Njk2NzNjYzIyODQ1ZjMifQ%3D%3D; expires=Wed, 12-Jul-2017 05:49:36 GMT; path=\/\"\n    1 => \"laravel_session=eyJpdiI6ImpPRjh2ckpqYmZoZlN6ZXYxcTd3amc9PSIsInZhbHVlIjoiaGw5c2dSWFlhNlU4akdScHhCNWdjbzhqK2JRZGV2d1dWbGp6VEVydWU0UFNsZTQra3NsYzYrNjdheU9VbUZURzhxVWdVaWl0VTRNckkwWTZLMm5UU1E9PSIsIm1hYyI6IjRlZWY5MDIwOGJlYjQ0YzAxNWYxMTJhZjhkYTFmMmIyNGVlZjYxYWFjMTUzNTBiYWQxNmJkN2JjNGU0YzQ0NGUifQ%3D%3D; expires=Wed, 12-Jul-2017 05:49:36 GMT; path=\/; httponly\"\n  ]\n]","path_info":"\/components\/datatables","session_attributes":"array:7 [\n  \"_token\" => \"at5e2VhpVANIbAkofs5HwTwxfDA35fd3kIaki6Td\"\n  \"url\" => []\n  \"_previous\" => array:1 [\n    \"url\" => \"http:\/\/localhost\/siaaf\/public\/index.php\/components\/datatables\"\n  ]\n  \"styde\/alerts\" => []\n  \"_flash\" => array:2 [\n    \"old\" => []\n    \"new\" => []\n  ]\n  \"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\" => 1\n  \"PHPDEBUGBAR_STACK_DATA\" => []\n]"}}, "9cc98b1b0b04a424ef1a7763851c4b3e");

</script>

@endpush
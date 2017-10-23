@extends('material.layouts.dashboard')

@push('styles')
    <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"   />
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}"rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}"rel="stylesheet" type="text/css"    />
    <link href="{{asset('assets/global/plugins/morris/morris.css')}}"rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}"rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}"rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout2/css/themes/blue.min.css')}}"rel="stylesheet" type="text/css" id="style_color" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> 
@endpush

@section('title', '| Dashboard')

@section('page-title', 'PROYECTOS REGISTRADOS')

@section('page-description', 'Listado de anteproyectos y proyectos registrados')

@section('content')
<div class="col-md-12">    
    <div class="row">
         
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat2 ">
                    <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="7800">0</span>
                                <small class="font-green-sharp">$</small>
                            </h3>
                            <small>TOTAL PROFIT</small>
                        </div>
                        <div class="icon">
                            <i class="icon-pie-chart"></i>
                        </div>
                    </div>
                    <div class="progress-info">
                <div class="progress">
                    <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                        <span class="sr-only">76% progress</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> progress </div>
                    <div class="status-number"> 76% </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="1349">0</span>
                    </h3>
                    <small>NEW FEEDBACKS</small>
                </div>
                <div class="icon">
                    <i class="icon-like"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                        <span class="sr-only">85% change</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> change </div>
                    <div class="status-number"> 85% </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="567"></span>
                    </h3>
                    <small>NEW ORDERS</small>
                </div>
                <div class="icon">
                    <i class="icon-basket"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                        <span class="sr-only">45% grow</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> grow </div>
                    <div class="status-number"> 45% </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">
                        <span data-counter="counterup" data-value="276"></span>
                    </h3>
                    <small>NEW USERS</small>
                </div>
                <div class="icon">
                    <i class="icon-user"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                        <span class="sr-only">56% change</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> change </div>
                    <div class="status-number"> 57% </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Estado de Anteproyectos'])
                <div id="anteproyecto-state"  class="CSSAnimationChart"></div>                                
            @endcomponent
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Estado de Proyectos'])
                <div id="proyecto-state"  class="CSSAnimationChart"></div>                                
            @endcomponent
    </div>

</div>
        <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'proyectos por jurados'])
                <div id="jurado-state"  class="CSSAnimationChart"></div>                                
            @endcomponent
        </div>
</div>
    
    
    
    <div class="row">
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-cursor font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">General Stats</span>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:;" class="btn btn-sm btn-circle red easy-pie-chart-reload">
                                            <i class="fa fa-repeat"></i> Reload </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number transactions" data-percent="55">
                                                    <span>+55</span>% </div>
                                                <a class="title" href="javascript:;"> Transactions
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number visits" data-percent="85">
                                                    <span>+85</span>% </div>
                                                <a class="title" href="javascript:;"> New Visits
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="easy-pie-chart">
                                                <div class="number bounce" data-percent="46">
                                                    <span>-46</span>% </div>
                                                <a class="title" href="javascript:;"> Bounce
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xs-12 col-sm-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-equalizer font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Server Stats</span>
                                        <span class="caption-helper">monthly stats...</span>
                                    </div>
                                    <div class="tools">
                                        <a href="" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="" class="reload"> </a>
                                        <a href="" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_bar5"></div>
                                                <a class="title" href="javascript:;"> Network
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_bar6"></div>
                                                <a class="title" href="javascript:;"> CPU Load
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="margin-bottom-10 visible-sm"> </div>
                                        <div class="col-md-4">
                                            <div class="sparkline-chart">
                                                <div class="number" id="sparkline_line"></div>
                                                <a class="title" href="javascript:;"> Load Rate
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection

@push('plugins')
<script>
    $(function() {
        function requestData(route,chart){
            $.ajax({
                type: "GET",
                url:route , 
            })
            .done(function( data ) {
                console.log(JSON.parse(data));
                chart.setData(JSON.parse(data));
            })
            .fail(function() {
                alert( "Error" );
            });
        }
        var anteproyecto = Morris.Bar({
            element: 'anteproyecto-state',
            data: [0,0],
            xkey: 'Estado',
            ykeys: ['value'],
            labels: ['#']
        });
        requestData("{{route('data.chart.preliminary')}}",anteproyecto);
        
        var proyecto = Morris.Bar({
            element: 'proyecto-state',
            data: [0,0],
            xkey: 'Estado',
            ykeys: ['value'],
            labels: ['#']
        });
        requestData("{{route('data.chart.project')}}",proyecto);
        
        var jurados = Morris.Bar({
            element: 'jurado-state',
            data: [0,0],
            xkey: 'FK_Developer_User_Id',
            ykeys: ['value'],
            labels: ['#']
        });
        requestData("{{route('data.chart.jury')}}",jurados);
    });
</script>



<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script> 
<script src="{{asset('assets/global/plugins/ie8.fix.min.js')}}"></script> 
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->
            <script src="{{asset('assets/global/plugins/jquery.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="{{asset('assets/global/plugins/moment.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/horizontal-timeline/horizontal-timeline.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js')}}"type="text/javascript"></script>
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{asset('assets/global/scripts/app.min.js')}}"type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{asset('assets/pages/scripts/dashboard.min.js')}}"type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{asset('assets/layouts/layout2/scripts/layout.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/layouts/layout2/scripts/demo.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}"type="text/javascript"></script>
            <script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}"type="text/javascript"></script>
            <!-- END THEME LAYOUT SCRIPTS -->
            <script>
                $(document).ready(function()
                {
                    $('#clickmewow').click(function()
                    {
                        $('#radio1003').attr('checked', 'checked');
                    });
                })
            </script>
@endpush

@push('functions')
@endpush
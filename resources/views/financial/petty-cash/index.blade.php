@extends('material.layouts.dashboard')

@push('styles')
    <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
@endpush

@section('title', ' | Caja Menor')

@section('page-title', 'Caja Menor')

@section('page-description', 'añadir, modificar, eliminar materias.')

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="1349">0</span>
                        </div>
                        <div class="desc"> New Feedbacks </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-bar-chart-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="12,5">0</span>M$ </div>
                        <div class="desc"> Total Profit </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="549">0</span>
                        </div>
                        <div class="desc"> New Orders </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                    <div class="visual">
                        <i class="fa fa-globe"></i>
                    </div>
                    <div class="details">
                        <div class="number"> +
                            <span data-counter="counterup" data-value="89"></span>% </div>
                        <div class="desc"> Brand Popularity </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Site Visits</span>
                            <span class="caption-helper">weekly stats...</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn red btn-outline btn-circle btn-sm active">
                                    <input type="radio" name="options" class="toggle" id="option1">New</label>
                                <label class="btn red btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2">Returning</label>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="site_statistics_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="site_statistics_content" class="display-none">
                            <div id="site_statistics" class="chart"> </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-red-sunglo hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Revenue</span>
                            <span class="caption-helper">monthly stats...</span>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a href="" class="btn dark btn-outline btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Filter Range
                                    <span class="fa fa-angle-down"> </span>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Q1 2014
                                            <span class="label label-sm label-default"> past </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Q2 2014
                                            <span class="label label-sm label-default"> past </span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:;"> Q3 2014
                                            <span class="label label-sm label-success"> current </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Q4 2014
                                            <span class="label label-sm label-warning"> upcoming </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="site_activities_loading">
                            <img src="../assets/global/img/loading.gif" alt="loading" /> </div>
                        <div id="site_activities_content" class="display-none">
                            <div id="site_activities" style="height: 228px;"> </div>
                        </div>
                        <div style="margin: 20px 0 10px 30px">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-success"> Revenue: </span>
                                    <h3>$13,234</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-info"> Tax: </span>
                                    <h3>$134,900</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-danger"> Shipment: </span>
                                    <h3>$1,134</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-warning"> Orders: </span>
                                    <h3>235090</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light calendar ">
                    <div class="portlet-title ">
                        <div class="caption">
                            <i class="icon-calendar font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">Feeds</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="calendar"> </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
            <div class="col-lg-6 col-xs-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bubble font-hide hide"></i>
                            <span class="caption-subject font-hide bold uppercase">Chats</span>
                        </div>
                        <div class="actions">
                            <div class="portlet-input input-inline">
                                <div class="input-icon right">
                                    <i class="icon-magnifier"></i>
                                    <input type="text" class="form-control input-circle" placeholder="search..."> </div>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body" id="chats">
                        <div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                            <ul class="chats">
                                <li class="out">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Lisa Wong </a>
                                        <span class="datetime"> at 20:11 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar2.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Lisa Wong </a>
                                        <span class="datetime"> at 20:11 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Bob Nilson </a>
                                        <span class="datetime"> at 20:30 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Bob Nilson </a>
                                        <span class="datetime"> at 20:30 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Richard Doe </a>
                                        <span class="datetime"> at 20:33 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Richard Doe </a>
                                        <span class="datetime"> at 20:35 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Bob Nilson </a>
                                        <span class="datetime"> at 20:40 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="in">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar3.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Richard Doe </a>
                                        <span class="datetime"> at 20:40 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                    </div>
                                </li>
                                <li class="out">
                                    <img class="avatar" alt="" src="../assets/layouts/layout/img/avatar1.jpg" />
                                    <div class="message">
                                        <span class="arrow"> </span>
                                        <a href="javascript:;" class="name"> Bob Nilson </a>
                                        <span class="datetime"> at 20:54 </span>
                                        <span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet. </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-form">
                            <div class="input-cont">
                                <input class="form-control" type="text" placeholder="Type a message here..." /> </div>
                            <div class="btn-cont">
                                <span class="arrow"> </span>
                                <a href="" class="btn blue icn-only">
                                    <i class="fa fa-check icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
@endsection



@push('plugins')
<script src="{{ asset('assets/pages/scripts/financial/md5.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/pnglib.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('assets/pages/scripts/financial/identicon.min.js') }}" type="text/javascript"></script>

<script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@endpush


@push('functions')
<script type="text/javascript">
    jQuery(document).ready(function () {
        var hash = md5('#'+Math.floor(Math.random()*16777215).toString(16));
        $('.hash-avatar').each(function () {
            var data = new Identicon(hash, 45).toString();
            $(this).attr('src', 'data:image/png;base64,' + data);
        });
    });
</script>
@endpush
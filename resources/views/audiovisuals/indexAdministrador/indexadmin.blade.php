{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
<link href="{{ asset('assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/apps/css/ticket.min.css') }}" rel="stylesheet" type="text/css"/>
<!-- Styles DATATABLE  -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Menu Administrador')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Menu Administrador')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', '')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    {{-- BEGIN HTML SAMPLE --}}
<!-- BEGIN SIDEBAR -->
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<!-- BEGIN CONTENT BODY -->
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN THEME PANEL -->
<!-- END THEME PANEL -->
<!-- END PAGE HEADER-->
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet ">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img alt="" class="img-responsive" src="{{ asset('assets/pages/media/profile/profile_user.jpg') }}">
                        </img>
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Marcus Doe
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button class="btn btn-circle green btn-sm" type="button">
                            Follow
                        </button>
                        <button class="btn btn-circle red btn-sm" type="button">
                            Message
                        </button>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active">
                                <a href="app_ticket.html">
                                    <i class="icon-home">
                                    </i>
                                    Ticket List
                                </a>
                            </li>
                            <li>
                                <a href="app_ticket_staff.html">
                                    <i class="icon-settings">
                                    </i>
                                    Support Staff
                                </a>
                            </li>
                            <li>
                                <a href="app_ticket_config.html">
                                    <i class="icon-info">
                                    </i>
                                    Configurations
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
                <!-- END PORTLET MAIN -->
                <!-- PORTLET MAIN -->
                <div class="portlet light ">
                    <!-- STAT -->
                    <div class="row list-separated profile-stat">
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title">
                                37
                            </div>
                            <div class="uppercase profile-stat-text">
                                New
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title">
                                51
                            </div>
                            <div class="uppercase profile-stat-text">
                                Processed
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="uppercase profile-stat-title">
                                61
                            </div>
                            <div class="uppercase profile-stat-text">
                                Completed
                            </div>
                        </div>
                    </div>
                    <!-- END STAT -->
                    <div>
                        <h4 class="profile-desc-title">
                            About Marcus Doe
                        </h4>
                        <span class="profile-desc-text">
                            Lorem ipsum dolor sit amet diam nonummy nibh dolore.
                        </span>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-globe">
                            </i>
                            <a href="http://www.keenthemes.com">
                                www.keenthemes.com
                            </a>
                        </div>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-twitter">
                            </i>
                            <a href="http://www.twitter.com/keenthemes/">
                                @keenthemes
                            </a>
                        </div>
                        <div class="margin-top-20 profile-desc-link">
                            <i class="fa fa-facebook">
                            </i>
                            <a href="http://www.facebook.com/keenthemes/">
                                keenthemes
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET MAIN -->
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->
            <!-- BEGIN TICKET LIST CONTENT -->
            <div class="app-ticket app-ticket-list">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide">
                                    </i>
                                    <span class="caption-subject font-blue-madison bold uppercase">
                                        Ticket List
                                    </span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group">
                                                <button class="btn sbold green" id="sample_editable_1_new">
                                                    Add New
                                                    <i class="fa fa-plus">
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn green btn-outline dropdown-toggle" data-toggle="dropdown">
                                                    Tools
                                                    <i class="fa fa-angle-down">
                                                    </i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-print">
                                                            </i>
                                                            Print
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-pdf-o">
                                                            </i>
                                                            Save as PDF
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-excel-o">
                                                            </i>
                                                            Export to Excel
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="group-checkable" data-set="#sample_1 .checkboxes" type="checkbox"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </th>
                                            <th>
                                                ID #
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Cust. Name
                                            </th>
                                            <th>
                                                Cust. Email
                                            </th>
                                            <th>
                                                Date/Time
                                            </th>
                                            <th>
                                                Assigned To
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1123
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Changing Colors
                                                </a>
                                            </td>
                                            <td>
                                                Jane
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Hugh Jackman
                                            </td>
                                            <td>
                                                <span class="label label-sm label-warning">
                                                    New
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1134
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Modals popup customization
                                                </a>
                                            </td>
                                            <td>
                                                Randy
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-info">
                                                    Processed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1144
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Form Input styling
                                                </a>
                                            </td>
                                            <td>
                                                Samantha
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-success">
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1243
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Counter skipping numbers
                                                </a>
                                            </td>
                                            <td>
                                                Daniel
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-default">
                                                    Pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1276
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Menu not working
                                                </a>
                                            </td>
                                            <td>
                                                Billy
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Hugh Jackman
                                            </td>
                                            <td>
                                                <span class="label label-sm label-default">
                                                    Pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1345
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Changing Colors
                                                </a>
                                            </td>
                                            <td>
                                                Jane
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Hugh Jackman
                                            </td>
                                            <td>
                                                <span class="label label-sm label-warning">
                                                    New
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1354
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Modals popup customization
                                                </a>
                                            </td>
                                            <td>
                                                Randy
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-default">
                                                    Pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1365
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Form Input styling
                                                </a>
                                            </td>
                                            <td>
                                                Samantha
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-success">
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1371
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Counter skipping numbers
                                                </a>
                                            </td>
                                            <td>
                                                Daniel
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Marcus Doe
                                            </td>
                                            <td>
                                                <span class="label label-sm label-default">
                                                    Pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td>
                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <input class="checkboxes" type="checkbox" value="1"/>
                                                    <span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    1373
                                                </a>
                                            </td>
                                            <td>
                                                <a href="app_ticket_details.html">
                                                    Menu not working
                                                </a>
                                            </td>
                                            <td>
                                                Billy
                                            </td>
                                            <td>
                                                <a href="mailto:customer@gmail.com">
                                                    customer@gmail.com
                                                </a>
                                            </td>
                                            <td class="center">
                                                10/12/15 1:45pm
                                            </td>
                                            <td>
                                                Hugh Jackman
                                            </td>
                                            <td>
                                                <span class="label label-sm label-success">
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<!-- END CONTENT BODY -->
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!-- END QUICK SIDEBAR -->
<!-- BEGIN HEADER -->
{{-- END HTML SAMPLE --}}
@endsection

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

@push('plugins')
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript">
</script>
<!-- SCRIPT DATATABLE PLANTILLA -->
<script src="{{ asset('assets/pages/scripts/table-datatables-managed.min.js') }}" type="text/javascript">
</script>
@endpush

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
@push('functions')
<script>
    // $(document).ready(function()
    //     {
    //         $('#clickmewow').click(function()
    //         {
    //             $('#radio1003').attr('checked', 'checked');
    //         });
    //     })
</script>
@endpush

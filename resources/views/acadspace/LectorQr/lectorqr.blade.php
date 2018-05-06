@permission('ACAD_INCIDENTES') @extends('material.layouts.dashboard') @push('styles') {{--Select2--}}
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
<!-- MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"
/>
<!-- DATATABLE  -->
{{--toast--}}
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
    #main {
        margin: 15px auto;
        background: white;
        overflow: auto;
        width: 100%;
    }

    #header {
        background: white;
        margin-bottom: 15px;
    }

    #mainbody {
        background: white;
        width: 100%;
        display: none;
    }

    #footer {
        background: white;
    }

    #v,
    #barcodecanvas,
    #barcodecanvasg {
        width: 320px;
        height: 240px;
    }

    #barcodecanvasg {
        position: absolute;
        top: 0%;
        left: 0%;
    }

    #qr-canvas,
    #barcodecanvas {
        display: none;
    }

    #mp1 {
        text-align: center;
        font-size: 35px;
    }

    #outdiv {
        position: relative;
    }

    #result {
        border: solid;
        border-width: 1px 1px 1px 1px;
        padding: 20px;
        width: 70%;
    }

    #footer a {
        color: black;
    }
</style>
<script type="text/javascript" charset="utf-8" src="{{asset('assets/main/acadspace/js/qr/lib/llqrcode.js')}}"></script>
<!-- <script type="text/javascript">load();</script> -->
<script type="text/javascript" src="{{asset('assets/main/acadspace/js/qr/lib/webqr.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/main/acadspace/js/qr/jquery.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        videoblade = '#v';
        canvasgblade = '#barcodecanvasg';
        canvasblade = '#barcodecanvas';
    });
</script>
@endpush @section('content') {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-green"></i>
                <span class="caption-subject font-green bold uppercase">Lector QR</span>
            </div>
        </div>
        <div class="portlet-body">
            <div id="mainbody" style="display: inline;">
                <tr>
                    <td valign="top" align="center" width="50%">
                        <table class="tsel" border="0">
                            <tr>
                                <td colspan="2" align="center">
                                    <div id="outdiv">
                                    </div>
                                    <canvas id="barcodecanvas"></canvas>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">

                    </td>
                </tr>
                <td id="tr" colspan="3" align="center">
                    <a class="waves-effect waves-light btn blue" id="leer" onclick="load();">
                        <i class="material-icons left">Recargar</i>
                    </a>
                    <!--<a class="waves-effect waves-light btn red" onclick="stop();"><i class="material-icons left">apagar</i>WebCam</a>-->

                    <div class="card-panel grey lighten-5 z-depth-1">

                        <div id="mapo" style="padding-top: 10px;">&nbsp;</div>
                        <div id="mact">&nbsp;</div>
                        <div id="soluong" style="padding-bottom: 10px;">&nbsp;</div>

                    </div>
                    
                </td>
            </div>
            <canvas id="qr-canvas" width="800" height="600"></canvas>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>
{{-- END HTML SAMPLE --}} @endsection @push('plugins')
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
{{--Selects--}}
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<!-- SCRIPT MODAL -->
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById('leer').click();

    });
</script>

@endpush @endpermission
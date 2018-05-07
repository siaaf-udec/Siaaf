@permission('ACAD_INCIDENTES') @extends('material.layouts.dashboard') @push('styles') {{--Select2--}}
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet" type="text/css" />
<link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css"
/>
<link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css"
/> {{--TOAST--}}
<link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
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
        position: relative;
        top: 0%;
        left: 80%;
    }

    #barcodecanvasg {
        position: absolute;
        top: 0%;
        left: 80%;
    }

    #qr-canvas,
    #barcodecanvas {
        display: none;
    }

    #qrfile {
        width: 320px;
        height: 240px;
    }

    #mp1 {
        text-align: center;
        font-size: 35px;
    }

    #imghelp {
        position: relative;
        left: 0px;
        top: -160px;
        z-index: 100;
        font: 18px arial, sans-serif;
        background: #f0f0f0;
        margin-left: 35px;
        margin-right: 35px;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 20px;
    }

    .selector {
        margin: 0;
        padding: 0;
        cursor: pointer;
        margin-bottom: -5px;
    }

    #outdiv {
        position: relative;
    }

    #footer a {
        color: black;
    }

    .tsel {
        padding: 0;
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

            </div>
            <canvas id="qr-canvas" width="800" height="600"></canvas>
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="portlet light " id="form_wizard_1">
                        {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url'=>'/forms']) !!}
                        <div class="form-wizard">
                            <div class="form-body">
                                {!! Field:: text('codigo',null,['label'=>'Identificación:', 'class'=> 'form-control', 'autofocus', '', 'maxlength'=>'12','autocomplete'=>'off'],
                                ['help' => 'Digité el identificación','icon'=>'fa fa-credit-card'] ) !!} 
                                {!! Field::select('SOL_carrera',
                                ['1' => 'Ingeniería de sistemas', '2' => 'Ingeniería Ambiental', '3' => 'Ingeniería agronomica',
                                '4' => 'Administración de empresas', '5' => 'Psicología', '6' => 'Contaduría','7' => 'Otro'],
                                null, [ 'label' => 'Programa']) !!}
                                {!! Field::select( 'Espacio',
                                ['1' => 'Laboratorios de sistemas', '2' => 'Otro'],
                                null, [ 'label' => 'Espacio academico']) !!} 
                                {!! Field::select('Sala',
                                ['101' => 'Sala 101', '102' => 'Sala 102', '103' => 'Sala 103',
                                '104' => 'Sala 104'],
                                null, [ 'label' => 'Sala']) !!} 
                                

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 col-md-offset-0">
                                        @permission('ACAD_REGISTRAR_ASISTENCIA') {!! Form::submit('Guardar', ['class' => 'btn blue']) !!} @endpermission
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

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
        //document.getElementById('leer').click();
        load();
        $.fn.select2.defaults.set("theme", "bootstrap");
        $(".pmd-select2").select2({
            allowClear: true,
            placeholder: "Seleccione",
            width: 'auto',
            escapeMarkup: function (m) {
                return m;
            }
        });
    //    var temp = '1';
    //    var mySelect = document.getElementById('SOL_carrera');
       // console.log(mySelect.options[1]);
      /*  for(var i, j = 0; i = mySelect.options[j]; j++) {
           if(i.value == temp) {
              mySelect.selectedIndex = j;
              break;
            }
        }*/
        //document.getElementById("SOL_carrera").selectedIndex = "2";
        //console.log($('select[name="Espacio"]').val());

    });
</script>
@endpush @endpermission
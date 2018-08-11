@extends('material.layouts.dashboard')
@permission('ACAD_PUBLICO') 
@push('styles') {{--Select2--}}
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"  type="text/css"/>
    <link href="{{  asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet"   type="text/css"/>
    <link href="{{  asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css"/>
    {{--TOAST--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
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
        left: 15%;
    }

    #barcodecanvasg {
        position: absolute;
        top: 0%;
        left: 15%;
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
@endpush 
@section('content') 
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registro ingreso v2.0'])
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="row">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                                {!! Form::open(['id' => 'form_sol_create', 'class' => '', 'url'=>'/forms']) !!}
                                <div class="form-body">
                                    <div class="col-md-6">
                                        <div class="portlet light bordered" id="form_wizard_1">
                                                <div class="form-wizard">
                                                {!! Field:: text('codigo',null,['label'=>'Identificación:', 'class'=> 'form-control', 'autofocus', '', 'maxlength'=>'12','autocomplete'=>'off'],
                                                ['help' => 'Digité la identificación','icon'=>'fa fa-credit-card'] ) !!} 
                                                {!! Field::select('SOL_carrera',
                                                                ['1' => 'Ingeniería de sistemas', '2' => 'Ingeniería Ambiental',
                                                                '3' => 'Ingeniería agronomica', '4' => 'Administración de empresas',
                                                                '5' => 'Psicología', '6' => 'Contaduría','7' => 'Otro'],
                                                                null,
                                                                [ 'label' => 'Programa :']) !!}
                                                {!! Field::select('Espacio académico:',$espacios,
                                                ['id' => 'SOL_laboratorios', 'name' => 'SOL_laboratorios'])
                                                !!}
                                                {!! Field::select('aula', null,
                                                ['name' => 'aula']) !!}
                                                <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-6 col-md-offset-0">
                                                                @permission('ACAD_REGISTRAR_ASISTENCIA') 
                                                                    {!! Form::submit('Registrar', ['class' => 'btn btn-simple btn-success btn-icon create']) !!} 
                                                                @endpermission
                                                            </div>
                                                        </div>
                                                </div>
                                                </div>
                                        </div> 

                                        </div>
                                        <div class="col-md-6">
                                            <div class="portlet light bordered">
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
                                            </div>                                            
                                        </div>
                                 
                                    {!! Form::close() !!}
                                </div>
                            
                        </div>
                    </div>

                </div>
                <!-- END SAMPLE TABLE PORTLET-->
            
        </div>
        @endcomponent
    </div>
@endsection
@push('plugins')
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}"type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-multi-select/js/jquery.quicksearch.js') }}"type="text/javascript"></script>
@endpush 
@push('functions') 

    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/acadspace/js/qr/AcadspaceControlQr.js') }}"type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
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
            moment.locale('es');
            $("#SOL_laboratorios").change(function (event) {
                /*Cargar select de aulas*/
                $('#aula').empty();
                $.get("cargarSalas/" + event.target.value + "", function (response) {
                    $(response.data).each(function (key, value) {
                        $("#aula").append(new Option(value.SAL_Nombre_Sala, value.PK_SAL_Id_Sala));
                    });
                    $("#aula").val([]);
                });
            });
            var wizard = $('#form_wizard_1');
            var form_edit = $('#form_sol_create');
            var rules_edit = {
                codigo: {
                    required: true, number:true, minlength: 5, maxlength: 12, remote: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('espacios.academicos.asist.verificarEstudiante') }}',
                        type: "POST"
                    }
                },
                SOL_carrera: {required: true},
                SOL_laboratorios: {required: true},
                aula: {required: true}
                
            };
            var messages = {
                codigo: {
                    remote: "Usuario no registrado en el sistema."
                },
            };
            var createUsers = function () {
                return {
                    init: function () {
                        var route = '{{ route('espacios.academicos.asist.regisAsistEst') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('ASIS_Id_Carrera', $('select[name="SOL_carrera"]').val());
                        formData.append('ASIS_Id_Identificacion', $('input:text[name="codigo"]').val());
                        formData.append('ASIS_Espacio_Academico', $('select[name="SOL_laboratorios"]').val());
                        formData.append('ASIS_Espacio', $('select[name="aula"]').val());

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    $('#form_sol_create')[0].reset(); //Limpia formulario
                                    $('#aula').val('').trigger('change');
                                    $("#SOL_carrera").val('').trigger('change');
                                    $("#SOL_laboratorios").val('').trigger('change');
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    }
                }
            };
            
            FormValidationMd.init(form_edit, rules_edit, messages, createUsers());
            
            //QRcontrol.init(route_store,valores, type_crud);

        
        });
    </script>
@endpush 
@endpermission
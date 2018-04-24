@extends('material.layouts.dashboard')
@section('page-title', 'Preguntas y Respuestas')
@push('styles')
    {{-- select2 Scripts --}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    {{-- bootstrap-toastr Scripts --}}
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    {{-- bootstrap-toastr Scripts --}}
    <link href="{{ asset('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet"
          type="text/css"/>
    {{-- bootstrap-toastr Scripts --}}
    <link href="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet"
          type="text/css"/>
    {{-- bootstrap-sweetalert Scripts --}}
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
    {{-- bootstrap-datepicker Scripts --}}
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
          rel="stylesheet" type="text/css"/>
    {{-- bootstrap-fileinput Scripts --}}
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Preguntas Frecuentes'])
            <div class="row">
                {{--DIVISION NAV--}}
                @permission('ADMINREGIST_SU_CREATE')
                <div class="col-md-4 col-lg-offset-9">
                    <a href="javascript:;"
                       class="btn btn-simple dark btn-icon sugerir"><i
                                class="fa fa-plus"></i>Sugerir Pregunta</a>
                </div>
                @endpermission
                <div class="col-md-7 col-md-offset-2">
                    <div class="panel-group accordion scrollable {{$i=0}}" id="accordion2">
                        @foreach($help as $info)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title {{$i++}}">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                           href="#collapse_2_{{$i}}">
                                            @if(strlen($info->HE_Pregunta)>100)
                                                <div class="text-mas">
                                                    {{ $text = substr($info->HE_Pregunta,0,100)}}<a class="mas"> Ver
                                                        mas..</a>
                                                </div>

                                                <div class="text-menos" style="display: none;">{{$info->HE_Pregunta}}<a
                                                            class="menos"> Ver menos..</a></div>

                                            @else
                                                {{$info->HE_Pregunta}}
                                            @endif

                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_2_{{$i}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        @if(strlen($info->HE_Respuesta)>100)
                                            <div class="text-mas-res">
                                                <p>{{ $text = substr($info->HE_Respuesta,0,100)}}<a class="mas-res"> Ver
                                                        mas..</a></p>
                                            </div>

                                            <div class="text-menos-res" style="display: none;">
                                                <p>{{$info->HE_Respuesta}}<a class="menos-res"> Ver menos..</a></p>
                                            </div>

                                        @else
                                            <p>{{$info->HE_Respuesta}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    {{-- FIN DIVISION NAV--}}

    @endcomponent
    <div class="row">
        <div class="col-md-12">
            <!-- Modal -->
            <div class="modal fade" id="Modal-sugerir" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_sugerencia', 'class' => '', 'url' => '/forms']) !!}
                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-thumbs-up"></i> Sugerir Pregunta</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Field::text('pregunta', old('pregunta'), ['max' =>'300','required','label' => 'Pregunta', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese la Pregunta.','size' => '30']) !!}

                                    {!! Field::text('username', old('username'), ['min'=>'5','max' =>'50','required','label' => 'Nombre del Usuario', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-user', 'help' => 'Ingrese su Nombre.','size' => '30']) !!}

                                    {!! Field::email('email', old('email'), ['required', 'max' => 80, 'type' => 'email','label' => 'E-mail', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-envelope-o', 'help' => 'Ingrese el correo electrónico.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue regist_sugerencia']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugins')
    {{-- jquery-validation Scripts --}}
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>
    {{-- select2 Scripts --}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    {{-- bootstrap-toastr Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
    {{-- bootstrap-maxlength Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>
    {{-- bootstrap-colorpicker Scripts --}}
    <script src="{{asset('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}"
            type="text/javascript"></script>
    {{-- jquery-minicolors Scripts --}}
    <script src="{{ asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js') }}"
            type="text/javascript"></script>
    {{-- bootstrap-sweetalert Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
            type="text/javascript"></script>
    {{-- bootstrap-datepicker Scripts --}}
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>
    {{-- jquery-repeater Scripts --}}
    <script src="{{ asset('assets/global/plugins/jquery-repeater/jquery.repeater.js') }}"
            type="text/javascript"></script>
    {{-- bootstrap-fileinput Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}"
            type="text/javascript"></script>

@endpush

@push('functions')
    {-- bootstrap-toastr Scripts --}
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.mas').on('click', function (e) {
                $('.text-menos').show();
                $('.text-mas').hide();
            });
            $('.menos').on('click', function (e) {
                $('.text-mas').show();
                $('.text-menos').hide();
            });

            $('.mas-res').on('click', function (e) {
                $('.text-menos-res').show();
                $('.text-mas-res').hide();
            });
            $('.menos-res').on('click', function (e) {
                $('.text-mas-res').show();
                $('.text-menos-res').hide();
            });

            var $form = $('#from_sugerencia');

            var form_rules = {
                pregunta: {
                    minlength: 5, maxlength: 300, required: true
                },
                username: {required: true, maxlength: 30},
                email: {required: true, maxlength: 80, email: true}
            };
            var messages = {};

            $('.sugerir').on('click', function (e) {
                e.preventDefault();
                document.getElementById("from_sugerencia").reset();
                $("#Modal-sugerir").modal();
            });

            $(".regist_sugerencia").on('click', function (e) {
                var register = function () {
                    return {
                        init: function () {
                            var formData = new FormData();
                            formData.append('SU_Pregunta', $('input[name="pregunta"]').val());
                            formData.append('SU_Username', $('input[name="username"]').val());
                            formData.append('SU_Email', $('input[name="email"]').val());
                            var route = '{{ route('adminRegist.sugerencia.store') }}';
                            var type = 'POST';
                            var async = async || false;
                            App.blockUI();
                            $.ajax({
                                url: route,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                type: type,
                                contentType: false,
                                data: formData,
                                processData: false,
                                async: async,
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        document.getElementById("from_sugerencia").reset();
                                        $("#Modal-sugerir").modal('hide');
                                        App.unblockUI();
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI();
                                    }
                                }
                            });
                        }
                    }
                };
                FormValidationMd.init($form, form_rules, messages, register());
            });
        });
    </script>
@endpush
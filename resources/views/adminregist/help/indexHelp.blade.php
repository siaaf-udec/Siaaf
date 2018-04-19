@extends('material.layouts.dashboard')
@section('page-title', 'Preguntas y Respuestas')
@push('styles')
    {{--Select2--}}
    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    {{--Date--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Preguntas Frecuentes'])
            <div class="row">
                {{--DIVISION NAV--}}
                <div class="col-md-7 col-md-offset-2">
                    <div class="panel-group accordion scrollable {{$i=0}}" id="accordion2">
                        @foreach($help as $info)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title {{$i++}}">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2"
                                           href="#collapse_2_{{$i}}"> {{$info->HE_Pregunta}} </a>
                                    </h4>
                                </div>
                                <div id="collapse_2_{{$i}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>{{$info->HE_Respuesta}}</p>
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

@endsection

@push('plugins')
    {{--Select 2--}}
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    {{--Moment--}}
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    {{--Daterange--}}
    <script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}"
            type="text/javascript"></script>
    {{-- wizard Scripts --}}
    <script src="{{ asset('assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"
            type="text/javascript"></script>
    {{--MaxLength--}}
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>
    {{--Validation--}}
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
@endpush

@push('functions')
    {{--Validation--}}
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
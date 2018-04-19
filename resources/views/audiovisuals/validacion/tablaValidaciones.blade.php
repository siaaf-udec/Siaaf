
@extends('material.layouts.dashboard')
@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{-- asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') --}}" rel="stylesheet" type="text/css" />
<!-- STYLES MODAL -->
<link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/pluginsbootstrap-editable/bootstrap-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bselect2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('title', '| Tabla Validaciones')
@section('page-title', 'Gestion Validaciones')
@section('page-description', '')
@section('content')
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-check', 'title' => 'Tabla Validaciones'])
        <div class="clearfix">
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table id="validaciones" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%">#</th>
                        <th class="text-center" width="65%">PREGUNTAS</th>
                        <th class="text-center" width="30%">VALOR</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dato as $datos)
                        <tr>
                            <td class="text-center">{{$datos->id}}</td>
                            <td>{{$datos->VAL_PRE_Nombre}}</td>
                            <td class="text-center">
                                <a href="#" class="task-editable-name" id="task-editable-name" data-type="text" data-column="value"  data-url="{{route('validaciones.edit', ['id'=>$datos->id])}}" data-pk="{{$datos->id}}" data-title="change" data-name="value">{{$datos->VAL_PRE_Valor}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endcomponent
</div>
@endsection
@push('plugins')
<script src="{{-- {{ asset('ruta/del/archivo/js') }} --}}" type="text/javascript"></script>
<!-- SCRIPT DATATABLE -->
<script src="{{ asset('assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery.mockjax.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
@endpush
@push('functions')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        jQuery(document).ready(function() {
            $.fn.editable.defaults.send = "always";
            $.fn.editable.defaults.mode = 'inline';
            $('.task-editable-name').editable({
                placement: 'bottom',
                rows: 3,
                validate: function(value) {
                    if($.trim(value) == '') {
                        return 'el campo es requerido.';
                    }
                    if ($.isNumeric(value) == '') {
                        return 'solo numeros son permitidos';
                    }
                    var num=parseInt(value);
                    if (num > 9 || num <1) {
                        return 'numero entre 1 y 9';
                    }
                },
            });
        });
    </script>
@endpush
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION DE SEDES'])
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="form-body">
                {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-Modificar-Convenio']) !!}
                <div class="form-wizard">
                    {!! Field:: text('SEDE_Sede',$Sede->SEDE_Sede,['label'=>'Sede', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de la sede','icon'=>'fa fa-line-chart'] ) !!}
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">


                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Editar', ['class' => 'btn blue']) }} {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @endcomponent
</div>

<script>
    jQuery(document).ready(function() {
        $('.portlet-form').attr("id", "form_wizard_1");
        var rules = {
            SEDE_Sede: {required: true}
        };
        var form = $('#form-Modificar-Convenio');
        var wizard = $('#form_wizard_1');
        var crearConvenio = function() {
            return {
                init: function() {
                    var route = '{{ route('modificarSedes.modificarSedes',[$Sede->PK_SEDE_Sede]) }}';
                    var type = 'POST';
                    var async = async || false;
                    var formData = new FormData();
                    formData.append('SEDE_Sede', $('#SEDE_Sede').val());;
                    $.ajax({
                        url: route,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        cache: false,
                        type: type,
                        contentType: false,
                        data: formData,
                        processData: false,
                        async: async,
                        success: function(response, xhr, request) {
                            if (request.status === 200 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                                var route = '{{ route('sedesAjax.sedesAjax') }}';
                                $(".content-ajax").load(route);
                            }
                        },
                        error: function(response, xhr, request) {
                            if (request.status === 422 && xhr === 'success') {
                                UIToastr.init(xhr, response.title, response.message);
                            }
                        }
                    });
                }
            }
        };
        var messages = {};
        FormValidationMd.init(form, rules, messages, crearConvenio());

        $('.atras').on('click', function(e) {
            e.preventDefault();
            var route = '{{ route('sedesAjax.sedesAjax') }}';
            $(".content-ajax").load(route);
        });
    });

</script>


    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Auditoria General'])

            @slot('actions', [

                'link_cancel' => [
                    'link' => '',
                    'icon' => 'icon-arrow-left',
                ],
                'link_wrench' => [
                    'link' => '',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => '',
                    'icon' => 'icon-trash',
                ],

            ])
            <div class="clearfix"> </div><br><br><br>
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                     {!! Field::hidden('id_edit', $audit->id) !!}
                     {!! Field::text(
                            'id_user', $audit->user_id,
                            ['label' => 'ID de Usuario', 'disabled']) !!}
                     {!! Field::text(
                            'auditable_id', $audit->auditable_id,
                            ['label' => 'ID Auditoría', 'disabled']) !!}          
                     {!! Field::textarea(
                            'old_values', $audit->old_values,
                            ['label' => 'Valores Antiguos', 'disabled']) !!}               
                     {!! Field::text(
                            'url', $audit->url,
                            ['label' => 'URL', 'disabled']) !!}
                     {!! Field::text(
                            'event', $audit->event,
                            ['label' => 'Evento', 'disabled']) !!}                                  
                     {!! Field::text(
                            'created_at', $audit->created_at,
                            ['label' => 'Fecha de Creación', 'disabled']) !!}
                     
                     
                </div>
                <div class="col-md-5">
                     {!! Field::text(
                            'user_type', $audit->user_type,
                            ['label' => 'Modelo Generador', 'disabled']) !!}
                     {!! Field::text(
                            'auditable_type', $audit->auditable_type,
                            ['label' => 'Dirección Auditoría', 'disabled']) !!}
                     {!! Field::textarea(
                            'new_values', $audit->new_values,
                            ['label' => 'Valores Nuevos', 'disabled']) !!}
                     {!! Field::text(
                            'ip_address', $audit->ip_address,
                            ['label' => 'Dirección IP', 'disabled']) !!}
                     {!! Field::text(
                            'tags', $audit->tags,
                            ['label' => 'Tags', 'disabled']) !!}
                     {!! Field::text(
                            'updated_at', $audit->updated_at,
                            ['label' => 'Fecha de Modificación', 'disabled']) !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    {!! Field::text(
                            'user_agent', $audit->user_agent,
                            ['label' => 'Navegador', 'disabled']) !!} 
                </div>
            </div>
        @endcomponent
    </div>


<script type="text/javascript">
    jQuery(document).ready(function () {

        var ComponentsCodeEditors = function () {
    
            var handle = function () {
                var new_values = document.getElementById('new_values');
                CodeMirror.fromTextArea(new_values, {
                    lineNumbers: true,
                    matchBrackets: true,
                    styleActiveLine: true,
                    readOnly: true,
                    theme:"ambiance",
                    mode: 'javascript'
                });

                var old_values = document.getElementById('old_values');
                CodeMirror.fromTextArea(old_values, {
                    lineNumbers: true,
                    matchBrackets: true,
                    styleActiveLine: true,
                    readOnly: true,
                    theme:"ambiance",
                    mode: 'javascript'
                });
            }

            return {
                //main function to initiate the module
                init: function () {
                    handle();
                }
            };

        }();

        $('#link_cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('audits.index.ajax') }}';
            $(".content-ajax").load(route);
        });

        ComponentsCodeEditors.init(); 
    
    });
</script>
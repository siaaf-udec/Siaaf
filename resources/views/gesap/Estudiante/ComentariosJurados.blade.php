<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de la decision de los jurados acerca del Anteproyecto'])

        @slot('actions', [
       'link_cancel' => [
           'link' => '',
           'icon' => 'fa fa-arrow-left',
                        ],
        ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
           
                {!! Form::model ([$Anteproyecto], ['id'=>'form_mct_actividades', 'url' => '/forms'])  !!}
            
                                
               

                <div class="form-body">
             
                   
                        <br><br>
                        @if($Anteproyecto['FK_NPRY_Estado'] > 3 && $Anteproyecto['N_Radicacion']==1)
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'ComentariosJurados'])
                        @slot('columns', [
                          
                            'Jurado',
                            'Decisión Docente',
                            'Comentarios'
                        ])
                    @endcomponent
                    @endif
          
                    @if($Anteproyecto['FK_NPRY_Estado'] > 3 && $Anteproyecto['N_Radicacion']==2)
                        @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'ComentariosJurados'])
                        @slot('columns', [
                          
                            'Jurado',
                            'Decisión Docente',
                            'Comentarios Anteriores',
                            'Comentarios Actuales'
                        ])
                    @endcomponent
                    @endif
          
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_STUDENT_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>
                                @endpermission
                                </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endcomponent


<!-- Modal Update Foto -->
   
    <div class="modal-footer">

{!! Form::close() !!}
</div>



</div>

<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script type="text/javascript">

    $(document).ready(function () {
        
        idp='{{  $Anteproyecto['PK_NPRY_IdMctr008']  }}';

if('{{$Anteproyecto['N_Radicacion']}}' == 1){
    var table, url, columns;
        table = $('#ComentariosJurados');
        url = '{{ route('EstudianteGesap.ListComentariosJuradoAnteproyecto') }}'+ '/' + idp;
    
        
    
        columns = [
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Estado', name: 'Estado'},
            {data: 'JR_Comentario', name: 'JR_Comentario'}
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();

}else{
    var table, url, columns;
        table = $('#ComentariosJurados');
        url = '{{ route('EstudianteGesap.ListComentariosJuradoAnteproyecto') }}'+ '/' + idp;
    
        
    
        columns = [
            {data: 'Nombre', name: 'Nombre'},
            {data: 'Estado', name: 'Estado'},
            {data: 'JR_Comentario', name: 'JR_Comentario'},
            {data: 'JR_Comentario_2', name: 'JR_Comentario_2'}
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();

}
    

        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
           // var route = '{{ route('EstudianteGesap.index.ajax') }}';

            location.href="{{route('EstudianteGesap.index')}}";

           // $(".content-ajax").load(route);
        });
    });
</script>


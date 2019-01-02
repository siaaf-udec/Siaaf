<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario de registro de usuarios'])
        @slot('actions', [
            'link_cancel' => [
                'link' => '',
                'icon' => 'fa fa-arrow-left',
                             ],
         ])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                   {!! Form::model ([$infoAnte],[
                   'id' => 'form_editar_anteproyecto']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Modifique los datos necesarios</span>
                                 <br><br>
                            </div>
                            
                          
                             <div class="form-group divcode">
                                
                            </div>
                        <br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <a href="https://www.ucundinamarca.edu.co/index.php/proteccion-de-datos-personales" target="_blank">- Ver la Resolución No. 050 de 2018 , tratamiento de datos personales</a>
                        </div>


                        <div class="col-md-6">

                            {!! Field:: text('NPRY_Titulo',$infoAnte['NPRY_Titulo'],['label'=>'TITULO:','class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                           
                            {!! Field:: text('NPRY_Keywords',$infoAnte['NPRY_Keywords'],['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                            {!! Field:: text('NPRY_Duracion',$infoAnte['NPRY_Duracion'],['label'=>'DURACION:', 'class'=> 'form-control', 'autofocus','autocomplete'=>'off'],
                                                             ['help' => 'Digite la duracion del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                      
                            {!! Field:: date('NPRY_FechaR',$infoAnte['NPRY_FechaR'],['label'=>'FECHA INICIO:','class'=> 'form-control','autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha de inicio del anteproyecto.','icon'=>'fa fa-calendar'] ) !!}

                            {!! Field:: date('NPRY_FechaL',$infoAnte['NPRY_FechaL'],['label'=>'FECHA FIN:', 'class'=> 'form-control', 'autocomplete'=>'off'],
                                                             ['help' => 'Digite la fecha fin del anteproyecto.','icon'=>'fa fa-calendar '] ) !!}

                           

                            {!! Field::select('NPRY_Estado',['1'=>'EN ESPERA', '2'=>'EN REVISION', '3'=>'PENDIENTE', '4'=>'APROVADO', '5'=>'APLAZADO', '6'=>'RECHAZADO', '7'=>'COMPLETADO'],null,['label'=>'ESTADO: ']) !!}

                            
                        
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('ADD_ANTEPROYECTO')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('ADD_ANTEPROYECTO'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
                            </div>
                        </div>
                    </div>
                    <br>
                    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    @endcomponent
</div>
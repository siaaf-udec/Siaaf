
   
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'EDICION  DE SEDES'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                           {!! Form::model ($Sede, ['method'=>'PATCH', 'route'=> ['Modificar_Sedes.Modificar_Sedes', $Sede->PK_Sede], 'role'=>"form"]) !!}
                        {{ csrf_field() }}
                    
                           
                            {!! Field:: text('PK_Sede',null,['label'=>'codigo','class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off',],['help' => 'digitar el codigo de la sede.','icon'=>'fa fa-credit-card']) !!}

                            {!! Field:: text('Sede',['label'=>'sede', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Nombre de la sede','icon'=>'fa fa-line-chart'] ) !!}
                        
                            
                        
                            <div class="form-actions">
                              <div class="row">
                                <div class="col-md-12 col-md-offset-0">
                                    {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                                    {!! Form::close() !!}
                                    {{ Form::reset('Cancelar', ['class' => 'btn btn-danger']) }}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endcomponent
    </div>


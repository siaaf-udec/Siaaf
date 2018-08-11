<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Agregar Hoja de vida'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                       
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-hojavida']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('HOJ_Modelo_Equipo',null,['label'=>'Modelo del equipo', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required'],['help' => 'Ingrese el modelo del equipo','icon'=>'fa fa-barcode'] ) !!}
                    
                        {!! Field:: text('HOJ_Procesador',null,['label'=>'Procesador','required', 'auto' => 'off'],['help' => 'Ingrese el procesador del equipo', 'icon' => 'fa fa-microchip']) !!}
                    
                        {!! Field:: number('HOJ_Memoria_Ram', null,['label'=>'Memoria RAM','min' => '0','max' => '128','required', 'auto' => 'off'],['help' => 'Ingrese el numero en GBs de memoria RAM del equipo', 'icon' => 'fas fa-microchip']) !!}
                        
                        {!! Field:: text('HOJ_Disco_Duro',null,['label'=>'Disco duro','required', 'auto' => 'off'],['help' => 'Ingrese el numero en gigas del disco duro del equipo', 'icon' => 'fas fa-discord']) !!}
                    
                        {!! Field:: text('HOJ_Mouse', null ,['label'=>'Mouse','required'],['help'=>'Indique si el equipo tiene mouse', 'icon' => 'fa fa-mouse-pointer']) !!}

                        {!! Field:: text('HOJ_Teclado', null ,['label'=>'Teclado','required'],['help'=>'Indique si el equipo tiene teclado', 'icon' => 'fa fa-compact-disc']) !!}

                        {!! Field:: text('HOJ_Sistema_Operativo', null ,['label'=>'Sistema operativo','required','auto'=>'off'],['help'=>'Ingrese sobre que sistema operativo trabaja el equipo','icon'=>'fa fa-microsoft']) !!}

                        {!! Field:: text('HOJ_Antivirus', null ,['label'=>'Antivirus','required','auto'=>'off'],['help'=>'Ingrese el antivirus del equipo','icon'=>'fa fa-hands-helping']) !!}

                        {!! Field:: text('HOJ_Garantia', null ,['label'=>'Garantia','required','auto'=>'off'],['help'=>'Ingrese el numero de mese que tiene de garantia el equipo','icon'=>'fa fa-clock']) !!}

                        {!! Field:: select('Marca:',$marcas, ['id' => 'PK_MAR_Id_Marca','name' => 'MAR_Nombre']) !!}

                    <div class="form-actions">
                          <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                {{ Form::submit('Editar', ['class' => 'btn blue']) }}
                                 {{ Form::reset('Atras', ['class' => 'btn btn-danger atras']) }}
                              </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcomponent
</div>


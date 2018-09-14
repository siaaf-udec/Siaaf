<div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Agregar Hoja de vida'])
            <div class="row">
                <div class="col-md-7 col-md-offset-2">
                    <div class="form-body">
                           
                        {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-hojavida']) !!}
                        <div class="form">
                            {!! Field:: text('HOJ_Modelo_Equipo',$hojavida[0]->HOJ_Modelo_Equipo,['label'=>'Modelo del equipo', 'class'=> 'form-control','disabled'],['icon'=>'fa fa-barcode'] ) !!}
                        
                            {!! Field:: text('HOJ_Procesador',$hojavida[0]->HOJ_Procesador,['label'=>'Procesador','required', 'auto' => 'off','disabled'],['icon' => 'fa fa-microchip']) !!}
                        
                            {!! Field:: number('HOJ_Memoria_Ram', $hojavida[0]->HOJ_Memoria_Ram,['id'=>'HOJ_Memoria_Ram','label'=>'Memoria RAM','disabled'],['icon' => 'fa fa-building ']) !!}
                            
                            {!! Field:: number('HOJ_Disco_Duro',$hojavida[0]->HOJ_Disco_Duro,['id'=>'HOJ_Disco_Duro','label'=>'Disco duro','disabled'],['icon' => 'fa fa-server']) !!}
                        
                            {!! Field:: text('HOJ_Mouse',$hojavida[0]->HOJ_Mouse,['name'=>'HOJ_Mouse','label'=>'Mouse','disabled'],['icon' => 'fa fa-mouse-pointer']) !!}
    
                            {!! Field:: text('HOJ_Teclado',$hojavida[0]->HOJ_Teclado,['name'=>'HOJ_Teclado','label'=>'Teclado','disabled'],['icon' => 'fa fa-keyboard-o']) !!}
    
                            {!! Field:: text('HOJ_Sistema_Operativo', $hojavida[0]->HOJ_Sistema_Operativo ,['label'=>'Sistema operativo','disabled','auto'=>'off'],['icon'=>'fa fa-laptop']) !!}
    
                            {!! Field:: text('HOJ_Antivirus', $hojavida[0]->HOJ_Antivirus ,['label'=>'Antivirus','disabled','auto'=>'off'],['icon'=>'fa fa-handshake-o']) !!}
    
                            {!! Field:: number('HOJ_Garantia', $hojavida[0]->HOJ_Garantia ,['id'=>'HOJ_Garantia','label'=>'Garantia','disabled','auto'=>'off'],['icon'=>'fa fa-clock-o']) !!}
    
                            {!! Field:: text('Marca:',$hojavida[0]->marca[0]->MAR_Nombre, ['id' => 'FK_HOJ_Id_Marca','name' => 'FK_HOJ_Id_Marca','value'=>'1'],['icon'=>'fa fa-list']) !!}
    
                        <div class="form-actions">
                              <div class="row">
                                <div class="col-md-12 col-md-offset-0">
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
    <script>
        $('.atras').on('click', function (e) {
            e.preventDefault();
            location.reload();
        });
    </script>        
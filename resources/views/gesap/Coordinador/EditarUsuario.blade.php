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
                   {!! Form::model ([$infoUser],[
                   'id' => 'form_editar_usuario']) !!}

                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <span class="label label-primary">Modifique los datos necesarios</span>
                                 <br><br>
                            </div>
                            
                          
                             <div class="form-group divcode">
                                
                            </div>
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
                        <br><br>
                        <a href="https://www.ucundinamarca.edu.co/index.php/proteccion-de-datos-personales" target="_blank">- Ver la Resolución No. 050 de 2018 , tratamiento de datos personales</a>
                        </div>


                        <div class="col-md-6">

                            {!! Field:: text('User_Cedula',null,['label'=>'Cedula:','class'=> 'form-control', 'autofocus', 'maxlength'=>'10','autocomplete'=>'off'],
                                                             ['help' => 'Digite el número de identificación del usuario. ','icon'=>'fa fa-credit-card']) !!}

                            {!! Field:: text('User_Nombre1',null,['label'=>'Nombres:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite los nombres del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{--{!! Field:: text('User_Nombre2',null,['label'=>'Nombre 2:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo nombre.','icon'=>'fa fa-user'] ) !!} --}}

                            {!! Field:: text('User_Apellido1',null,['label'=>'Apellidos:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite los apellidos del usuario.','icon'=>'fa fa-user'] ) !!}

                            {{--{!! Field:: text('User_Apellido2',null,['label'=>'PALABRAS CLAVE:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite el segundo apellido.','icon'=>'fa fa-user'] ) !!}--}}

                            {!! Field:: text('User_Correo',null,['label'=>'Correo Electronico:', 'class'=> 'form-control', 'autofocus','maxlength'=>'200','autocomplete'=>'off'],
                                                             ['help' => 'Digite la direccion electronica del usuario.','icon'=>'fa fa-envelope-open'] ) !!}

                            {!! Field:: text('User_Direccion',null,['label'=>'Direccion de Residencia:', 'class'=> 'form-control', 'autofocus','maxlength'=>'100','autocomplete'=>'off'],
                                                             ['help' => 'Digite la direccion de residencia del usuario.','icon'=>'fa fa-building-o'] ) !!}

                            {!! Field::select('Fk_User_IdEstado',['1'=>'ACTIVO', '2'=>'INACTIVO'],null,['label'=>'ESTADO: ']) !!}

                            {!! Field::select('FK_User_IdRol',['1'=>'ESTUDIANTE', '2'=>'PROFESOR', '3'=>'ADMINISTRADOR'],null,['label'=>'ROL: ']) !!}

                            {!! Field::checkbox('acceptTeminos2', '1', ['label' => 'Acepta términos y condiciones de la resolución numero 050 de 2018.','required']) !!}

                            
                        
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-0">
                                @permission('ADD_USER')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Cancelar
                                </a>@endpermission

                                @permission('ADD_USER'){{ Form::submit('Registrar', ['class' => 'btn blue']) }}@endpermission
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
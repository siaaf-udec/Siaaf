@extends('material.layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos del Empleado</div>
                    <div class="panel-body">
                        {!! Form::model ($empleado, ['method'=>'PATCH', 'route'=> ['rrhh.update', $empleado->PK_PRSN_Cedula],'class'=>'form-horizontal', 'role'=>'form'])  !!}
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div class="form-group form-md-radios">
                                        <label for="form_control">Rol del empleado:</label>

                                        <div class="md-radio-list">
                                            <div class="md-radio">
                                                {!! Form::radios('PRSN_Rol',['Docente'=>'Docente', 'Administrativo'=>'Administrativo']) !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Nombres',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="name" class="control-label">Nombre(s):</label>
                                            <span class="help-block"> Digita el nombre del empleado. </span>
                                            <i class=" fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Apellidos',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="name" class="control-label">Apellido(s):</label>
                                            <span class="help-block"> Digita el apellido del empleado. </span>
                                            <i class=" fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PK_PRSN_Cedula',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="name" class="control-label">Cedula de Ciudadania</label>
                                            <span class="help-block">Digita el numero de identificación.</span>
                                            <i class=" fa fa-user "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: email('PRSN_Correo',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="email" class="control-label">Correo electronico:</label>
                                            <span class="help-block"> Digita un correo electronico valido.</span>
                                            <i class=" fa fa-envelope-open "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Telefono',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="telefono" class="control-label">Teléfono</label>
                                            <span class="help-block"> Digita un número de teléfono o celular. </span>
                                            <i class=" fa fa-phone "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Direccion',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="direccion" class="control-label">Dirección:</label>
                                            <span class="help-block"> Digita la dirección de residencia. </span>
                                            <i class=" fa fa-building-o "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Ciudad',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="ciudad" class="control-label">Ciudad:</label>
                                            <span class="help-block"> Digita la ciudad del empleado. </span>
                                            <i class=" fa fa-map-o "></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Area',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="area" class="control-label">Area de trabajo:</label>
                                            <span class="help-block"> Digita el area de trabajo. </span>
                                            <i class=" fa fa-group"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Eps',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="eps" class="control-label">EPS:</label>
                                            <span class="help-block"> Digita la entidad prestadora de salud. </span>
                                            <i class=" fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Fpensiones',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="fondoP" class="control-label">Fondo de pensiones:</label>
                                            <span class="help-block"> Digita el fondo de pensiones. </span>
                                            <i class=" fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div  class="form-group form-md-line-input">
                                        <div class="input-icon">
                                            {!! Form:: text('PRSN_Caja_Compensacion',null,['class'=> 'form-control'],'required', 'autofocus', ['maxlength'=>'40'],['autocomplete'=>'off']) !!}
                                            <label for="cajaC" class="control-label">Caja de compensacion:</label>
                                            <span class="help-block"> Digita la caja de compensacion. </span>
                                            <i class=" fa fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 col-md-offset-2">
                                    <div class="form-group form-md-radios">
                                        <label for="form_control">Estado del empleado:</label>

                                        <div class="md-radio-list">
                                            <div class="md-radio">
                                                {!! Form::radios('PRSN_Estado_Persona',['Nuevo'=>'Nuevo', 'Antiguo'=>'Antiguo']) !!}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-icon edit">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        {!! Form::open ( ['method'=>'DELETE', 'route'=> ['rrhh.destroy', $empleado->PK_PRSN_Cedula],'class'=>"form-horizontal", 'role'=>"form"])  !!}
                            {{ csrf_field() }}
                            {!! Form::submit('Eliminar',['class'=>'btn red','btn-icon remove']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
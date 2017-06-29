@extends('material.layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro Empleados</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('rrhh.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre Completo</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
                                <label for="cedula" class="col-md-4 control-label">Cedula de Ciudadania</label>

                                <div class="col-md-6">
                                    <input id="cedula" type="text" class="form-control" name="cedula" value="{{ old('email') }}" required>

                                    @if ($errors->has('cedula'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="telefono" class="col-md-4 control-label">Teléfono</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion" class="col-md-4 control-label">Dirección</label>

                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" required>

                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                                <label for="ciudad" class="col-md-4 control-label">Ciudad</label>

                                <div class="col-md-6">
                                    <input id="ciudad" type="text" class="form-control" name="ciudad" required>

                                    @if ($errors->has('ciudad'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ciudad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('area') ? ' has-error' : '' }}">
                                <label for="area" class="col-md-4 control-label">Área</label>

                                <div class="col-md-6">
                                    <input id="area" type="text" class="form-control" name="area" required>

                                    @if ($errors->has('area'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('eps') ? ' has-error' : '' }}">
                                <label for="eps" class="col-md-4 control-label">EPS</label>

                                <div class="col-md-6">
                                    <input id="eps" type="text" class="form-control" name="eps" >

                                    @if ($errors->has('eps'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('eps') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fondoP') ? ' has-error' : '' }}">
                                <label for="fondoP" class="col-md-4 control-label">Fondo de Pensiones</label>

                                <div class="col-md-6">
                                    <input id="fondoP" type="text" class="form-control" name="fondoP" >

                                    @if ($errors->has('fondoP'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fondoP') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('cajaC') ? ' has-error' : '' }}">
                                <label for="cajaC" class="col-md-4 control-label">Caja de Compensación</label>

                                <div class="col-md-6">
                                    <input id="cajaC" type="text" class="form-control" name="cajaC" >

                                    @if ($errors->has('cajaC'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('cajaC') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
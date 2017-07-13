<div class="form-group">
	{!! Field:: text('FNS_Nombres',null,['label'=>'Nombres','class'=> 'form-control','required', 'autofocus', 'maxlength'=>'20','autocomplete'=>'off'], ['help' => 'Digita el nombre del funcionario.','icon'=>'fa fa-user']) !!}
</div>

<div class="form-group">
	{!! Field:: text('FNS_Apellidos',null,['label'=>'Apellidos', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el apellido del funcionario.','icon'=>'fa fa-user'] ) !!}	
</div>
<div class="form-group">
	{!! Field:: text('PK_FNS_Cedula',null,['label'=>'Cedula', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita la cedula del funcionario.','icon'=>'fa fa-credit-card'] ) !!}
</div>
<div class="form-group">
	{!! Field::radios('FK_FNS_Rol',['Docente'=>'Docente', 'Estudiante'=>'Estudiante'], ['list', 'label'=>'Rol del Funcionario: ', 'icon'=>'fa fa-user']) !!}
</div>
<div class="form-group">
	{!! Field:: email('FNS_Correo',null,['label'=>'Correo electrónico:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el correo electronico del funcionario.','icon'=>'fa fa-envelope-open '] ) !!}
</div>
<div class="form-group">
	{!! Field:: tel('FNS_Telefono',null,['label'=>'Teléfono:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita el telefono o celular del funcionario.','icon'=>'fa fa-phone'] ) !!}
</div>
<div class="form-group">
	{!! Field:: text('FNS_Direccion',null,['label'=>'Dirección:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita la direccion del funcionario.','icon'=>'fa fa-location-arrow'] ) !!}
</div>
<div class="form-group">
	{!! Field:: text('FK_FNS_Estado',null,['label'=>'Estado:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'], ['help' => 'Digita el estado actual del funcionario "activo", "inactivo".','icon'=>'fa fa-male'] ) !!}
</div>
<div class="form-group">
	{!! Field:: text('FK_FNS_Programa',null,['label'=>'Programa:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'30','autocomplete'=>'off'],['help' => 'Digita el programa al que pertenece el funcionario.','icon'=>'fa fa-university'] ) !!}
</div>

<div class="for-group">
	{!! Field:: text('FNS_Clave',null,['label'=>'Clave:', 'class'=> 'form-control','required', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off'],['help' => 'Digita una clave para el funcionario.','icon'=>'fa fa-lock'] ) !!}
</div>


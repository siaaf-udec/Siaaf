


<div class="modal fade" id="modal-registrar-funcionario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Actualizar Funcionario</h4>
		</div>
		<div class="modal-body">
	{!! Form::open (['id' => 'form_funcionario_registrar', 'class' => '', 'url' => '/forms']) !!}

			<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">{{--IDENTIFICACION DE PETICION PARA LARAVEL --}}
			<input type="hidden" id="id"> {{-- PARA AJAX --}}
			@include('audiovisuals.funcionario.forms.fns_registrar')
		</div>
		<div class="modal-footer">
			{{-- {!!link_to('#', $title='Actualizar', $atrributes = ['id'=>'actualizar', 'class'=>'btn green'], $secure = null) !!} --}}
			{!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}

	{!! Form::close() !!}
		</div>
	</div>
		
	</div>

</div>
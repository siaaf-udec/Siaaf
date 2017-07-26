<div class="form-group">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=sin+imágen" alt="Imágen" />
        </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
        <div class="row">
            <div class="col-md-4">
                @if (!empty($errors))
                    @foreach ($errors as $error)
                        <span id="{{ $id }}-error" class="help-block help-block-error">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
        </div>
        <div>
            <span class="btn green btn-file">
                <span class="fileinput-new"> Seleccionar </span>
                <span class="fileinput-exists"> Cambiar </span>
                {!! $input !!}
            </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Quitar </a>
        </div>
    </div>
</div>
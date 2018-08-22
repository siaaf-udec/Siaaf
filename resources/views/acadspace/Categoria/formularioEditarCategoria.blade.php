<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Modificar Categoria'])
        <div class="row">
            <div class="col-md-7 col-md-offset-2">
                <div class="form-body">
                       
                    {!! Form::open(['url' => '/forms','enctype'=>'multipart/form-data','id'=>'form-hojavida']) !!}
                    <div class="form-wizard">
                        {!! Field:: text('NOM_Categoria',$categoria->CAT_Nombre
                        ,['label'=>'Digite el nuevo nombre de la categoria', 'class'=> 'form-control', 'autofocus', 'maxlength'=>'40','autocomplete'=>'off','required']
                        ,['help' => 'Modifique el nombre como desee','icon'=>'fa fa-barcode'] ) !!}

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


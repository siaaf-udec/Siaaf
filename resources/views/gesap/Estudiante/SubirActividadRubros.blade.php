       <!--MODAL CREAR COMENTARIO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-coment" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'from_create-coment', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Comentario</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: textArea('OBS_observacion',null,['label'=>'Comentario:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá su comentario acerca esta actividad','icon'=>'fa fa-book']) !!}
                                    {!! Field:: date('OBS_Limit',null,['label'=>'Fecha limite:','class'=> 'form-control', 'autofocus','maxlength'=>'600','autocomplete'=>'off'],
                                                        ['help' => 'Coloque acá la fecha esperada de revision','icon'=>'fa fa-book']) !!}
                             
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR COMENTARIO-->
             <!--MODAL CREAR Rubros_personal-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Rubro_Personal" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create_Rubro_Personal', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Rubro Personal</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('RBR_PER_Nombre',null,['label'=>'Nombre:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Funcion',null,['label'=>'Función en el proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Tipo',null,['label'=>'Tipo de vinculación :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Dedicacion',null,['label'=>'Dedicación hora/semana :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Entidad',null,['label'=>'Entidad a la que pertenece:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Solicitado_Udec',null,['label'=>'Solicitado a la UDEC:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_PER_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                
                               
                               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR personal-->
            <!--MODAL EDITAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-editar-Rubro_Personal" tabindex="-1" role="dialog" aria-hidden="true">
                
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'form_editar_Rubro_Personal', 'url' => '/forms']) !!}

                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-plus"></i> Editar Rubro Personal</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                               {!! Field:: Text('RBR_PER_EDITAR_Nombre',null,['label'=>'Nombre:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Funcion',null,['label'=>'Función en el proyecto:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Tipo',null,['label'=>'Tipo de vinculación :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Dedicacion',null,['label'=>'Dedicación hora/semana :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Entidad',null,['label'=>'Entidad a la que pertenece:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Solicitado_Udec',null,['label'=>'Solicitado a la UDEC:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                               {!! Field:: Text('RBR_PER_EDITAR_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                    ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                            
                           
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            
        </div>
            <!--MODAL FIN EDITAR Personal-->

             <!--MODAL CREAR Rubros_EQUIPO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Rubro_Equipo" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create_Rubro_Equipo', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Rubro Equipo</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('RBR_EQP_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Lab',null,['label'=>'Laboratorio y/o espacio académico:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Actividades',null,['label'=>'Actividad en la que requerie el equipo :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Justificacion',null,['label'=>'Justificación :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Cantidad',null,['label'=>'Cantidad:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Val',null,['label'=>'Valor Unitario:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Solicitado',null,['label'=>'Solicitado en efectivo UDEC:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                               
                               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR personal-->
            <!--MODAL EDITAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-editar-Rubro_Equipo" tabindex="-1" role="dialog" aria-hidden="true">
                
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'form_editar_Rubro_Equipo', 'url' => '/forms']) !!}

                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-plus"></i> Editar Rubro Equipo</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                   {!! Field:: Text('RBR_EQP_EDITAR_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Lab',null,['label'=>'Laboratorio y/o espacio académico:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Actividades',null,['label'=>'Actividad en la que requerie el equipo :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Justificacion',null,['label'=>'Justificación :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Cantidad',null,['label'=>'Cantidad:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Val',null,['label'=>'Valor Unitario:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Solicitado',null,['label'=>'Solicitado en efectivo UDEC:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_EQP_EDITAR_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                               
                               
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            
        </div>
            <!--MODAL EDITAR Resultado-->
                <!--MODAL FIN EDITAR EQUIPO-->

                <!--MODAL CREAR rubro MATERIAL-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Rubro_Material" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create_Rubro_Material', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Rubro Material</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('RBR_MTL_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Justificacion',null,['label'=>'Justificación:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Cantidad',null,['label'=>'Cantidad :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Val',null,['label'=>'Valor :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Solicitado_Udec',null,['label'=>'Valor Solicitado A la UDEC','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                               
                               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR personal-->
            <!--MODAL EDITAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-editar-Rubro_Material" tabindex="-1" role="dialog" aria-hidden="true">
                
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'form_editar_Rubro_Material', 'url' => '/forms']) !!}

                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-plus"></i> Editar Rubro Material</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                   {!! Field:: Text('RBR_MTL_EDITAR_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Justificacion',null,['label'=>'Justificación:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Cantidad',null,['label'=>'Cantidad :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Val',null,['label'=>'Valor :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Solicitado_Udec',null,['label'=>':Valor Solicitado A la UDEC','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_MTL_EDITAR_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                               
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            
        </div>
            <!--MODAL EDITAR Resultado-->
            <!--MODAL FIN RUBRO MATERIAL-->
            
                <!--MODAL CREAR rubro TECNOLOGICO-->
            <!-- Modal -->
            <div class="modal fade" id="modal-create-Rubro_Tecnologico" tabindex="-1" role="dialog" aria-hidden="true">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        {!! Form::open(['id' => 'form_create_Rubro_Tecnologico', 'url' => '/forms']) !!}

                        <div class="modal-header modal-header-success">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h1><i class="glyphicon glyphicon-plus"></i> Añadir Rubro Tecnologico</h1>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   {!! Field:: Text('RBR_TEC_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Justificacion',null,['label'=>'Justificación:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Val',null,['label'=>'Valor :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Entidad',null,['label'=>'Entidad :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Solicitado_Udec',null,['label'=>'Valor Solicitado A la UDEC','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                               
                               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                
            </div>
            <!--MODAL CREAR personal-->
            <!--MODAL EDITAR Resultado-->
            <!-- Modal -->
            <div class="modal fade" id="modal-editar-Rubro_Tecnologico" tabindex="-1" role="dialog" aria-hidden="true">
                
                <!-- Modal content-->
                <div class="modal-content">
                    {!! Form::open(['id' => 'form_editar_Rubro_Tecnologico', 'url' => '/forms']) !!}

                    <div class="modal-header modal-header-success">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h1><i class="glyphicon glyphicon-plus"></i> Editar Rubro Tecnologico</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                   {!! Field:: Text('RBR_TEC_EDITAR_Descripcion',null,['label'=>'Descripción:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Justificacion',null,['label'=>'Justificación:','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Val',null,['label'=>'Valor :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Entidad',null,['label'=>'Entidad :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Solicitado_Udec',null,['label'=>'Valor Solicitado A la UDEC','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite aqui el tipo de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Contra_Udec',null,['label'=>'Contrapartida en especie (UDEC) :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Contra_Otro',null,['label'=>'Contrapartida en especie (OTROS):','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá la fuente de financiación','icon'=>'fa fa-book']) !!}
                                   {!! Field:: Text('RBR_TEC_EDITAR_Total',null,['label'=>'Total :','class'=> 'form-control', 'autofocus','maxlength'=>'190','autocomplete'=>'off'],
                                                        ['help' => 'Digite acá el valor aportado','icon'=>'fa fa-book']) !!}
                                   
                           
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
                        {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            
        </div>
            <!--MODAL EDITAR Resultado-->
            <!--MODAL FIN RUBRO TECNOLOGICO-->

<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Formulario para subir Actividades del Mctr008'])
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            {!! Form::model ([$datos], ['id'=>'form_subir_actividad', 'url' => '/forms'])  !!}
       <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                               <br>
                               <br>
                        </div>
                        <div class="col-md-6">
                               
                               
                               </div>
                             
                        </div>
                        {!! Field:: text('MCT_Actividad',$datos['Estado'],['label'=>'ESTADO DE LA ACTIVIDAD:','class'=> 'form-control', 'autofocus','readonly','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}

                       
                                {!! Field:: text('MCT_Actividad',$datos[0]['MCT_Actividad'],['label'=>'Actividad:','class'=> 'form-control', 'autofocus','readonly', 'maxlength'=>'190','autocomplete'=>'off'],
                                                                ['help' => 'Digite el nombre del anteproyecto','icon'=>'fa fa-book']) !!}


                                {!! Field:: textArea('MCT_Descripcion',$datos[0]['MCT_Descripcion'],['label'=>'DESCRIPCIÓN:', 'class'=> 'form-control','readonly', 'autofocus','autocomplete'=>'off'],
                                                                ['help' => 'Digite las palabras clave.','icon'=>'fa fa-book'] ) !!}

                        {!! Field:: text('CMMT_Commit',$datos['Commit'],['label'=>'INFORMACIÓN:', 'class'=> 'form-control', 'autofocus','maxlength'=>'500','readonly','autocomplete'=>'off'],
                    
                                                                ['help' => 'Coloque una breve descrición del Anteproyecto.','icon'=>'fa fa-book'] ) !!}
                    @if($datos['Estado'] != "APROBADO" )
                                
                    @permission('GESAP_STUDENT_ADD_ACTIVIDAD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon person"
                                                       title="Gestionar Rubro">
                            <i class="fa fa-plus">
                            </i>Agregar Rubro Personal
                        </a>@endpermission
                    @endif
                    <h4>DETALLES RUBROS</h4> 
                    <br><br>                    
                    <h4>Detalles de persona</h4>
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Personal'])
                    @slot('columns', [
                            'Nombre',
                            'Funcion En el proyecto',
                            'Tipo de vinculación',
                            'Dedicación Horas/Semana',
                            'Entidad a la que pertenece',
                            'Solicitado a la UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_PersonalF'])
                    @slot('columns', [
                            'Nombre',
                            'Funcion En el proyecto',
                            'Tipo de vinculación',
                            'Dedicación Horas/Semana',
                            'Entidad a la que pertenece',
                            'Solicitado a la UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] != "APROBADO" )
                    @permission('GESAP_STUDENT_ADD_ACTIVIDAD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon equip"
                                                       title="Gestionar Rubro">
                            <i class="fa fa-plus">
                            </i>Agregar Rubro Equipo
                        </a>@endpermission
                    @endif
                    <br><br>                    
                    <h4>Descripción de equipo</h4>
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Equipo'])
                    @slot('columns', [
                            'Descripción',
                            'Laboratorio y/o espacio academico',
                            'Actividad del cronograma',
                            'Justificación',
                            'Cantidad',
                            'ValorUnitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_EquipoF'])
                    @slot('columns', [
                        'Descripción',
                            'Laboratorio y/o espacio academico',
                            'Actividad del cronograma',
                            'Justificación',
                            'Cantidad',
                            'ValorUnitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    
                    @if($datos['Estado'] != "APROBADO" )
                    @permission('GESAP_STUDENT_ADD_ACTIVIDAD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Material"
                                                       title="Gestionar Rubro">
                            <i class="fa fa-plus">
                            </i>Agregar Rubro Material
                        </a>@endpermission
                    @endif
                    
                    <br><br>                    
                    <h4>Descripción de materiales e insumos</h4>
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Material'])
                    @slot('columns', [
                            'Descrición',
                            'Justificación',
                            'Cantidad',
                            'Valor Unitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_MaterialF'])
                    @slot('columns', [
                            'Descrición',
                            'Justificación',
                            'Cantidad',
                            'Valor Unitario',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] != "APROBADO" )
                    @permission('GESAP_STUDENT_ADD_ACTIVIDAD')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon Tecnologic"
                                                       title="Gestionar Rubro">
                            <i class="fa fa-plus">
                            </i>Agregar Rubro Tecnologicos
                        </a>@endpermission
                    @endif
                    
                    
                    <br><br>                    
                    <h4>Descripción de servicios tecnológicos</h4>
                    <br><br>
                    @if($datos['Estado'] != "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_Tecnologico'])
                    @slot('columns', [
                        'Descrición',
                            'Justificación',
                            'Valor',
                            'Entidad',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
                    ])
                    @endcomponent
                    @endif
                    @if($datos['Estado'] == "APROBADO" )
                    @component('themes.bootstrap.elements.tables.datatablescoment', ['id' => 'Rubro_TecnologicoF'])
                    @slot('columns', [
                            'Descrición',
                            'Justificación',
                            'Valor',
                            'Entidad',
                            'Solicitado en efectivo a UDEC',
                            'Contrapartida en especie (UDEC)',
                            'Contrapartida en especie (Otros)',
                            'Total',
                            'Acciones'
    
                    ])
                    @endcomponent
                    @endif
                    
                    
                    <br><br>                                       
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 col-md-offset-5">
                                @permission('GESAP_STUDENT_CANCEL')<a href="javascript:;"
                                                               class="btn btn-outline red button-cancel"><i
                                            class="fa fa-angle-left"></i>
                                    Volver
                                </a>@endpermission
                               
                            </div>
                            
                        </div>
                        
                    </div>
                    <h4> Observaciónes acerca de esta Actividad del Mct</h4>
                    <br><br>
                    @permission('GESAP_STUDENT_COMENT')<a href="javascript:;"
                                                       class="btn btn-simple btn-warning btn-icon gestionar"
                                                       title="Gestionar Mct">
                            <i class="fa fa-plus">
                            </i>Agregar Observación
                        </a>@endpermission
                    
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'ListaComentarios'])
                        @slot('columns', [
                            'Fecha de realización',
                            'Observación',
                            'Realizada por',
                            'Fecha esperdad de respuesta'
                            
                        ])
                    @endcomponent
                     <br>
                     {!! Form::close() !!}
                 </div>
        </div>

    @endcomponent
</div>

<!-- file script -->
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('assets/main/scripts/form-validation-md.js') }}" type = "text/javascript" ></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
     
    id = 123456189 ;
        
    var table, url, columns;
        table = $('#ListaComentarios');
        url = '{{ route('EstudianteGesap.Comentarios') }}'+'/'+'{{$datos[0]['PK_MCT_IdMctr008']}}'+'/'+'{{$datos['Anteproyecto']}}';
         
        columns = [
            {data: 'updated_at', name: 'updated_at'},
            {data: 'OBS_Observacion', name: 'OBS_Observacion'},
            {data: 'Usuario', name: 'Usuario'},            
            {data: 'OBS_Limit', name: 'OBS_Limit'},
            
        ];

        dataTableServer.init(table, url, columns);
        table = table.DataTable();

        
            $('.gestionar').on('click', function (e) {
                e.preventDefault();
                $('#modal-create-coment').modal('toggle');
            });
            


            var CrearComentario = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.ComentarioStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('OBS_observacion', $('#OBS_observacion').val());
                        formData.append('OBS_Limit', $('[name="OBS_Limit"]').val());
                  

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-coment').modal('hide');
                                    $('#from_create-coment')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form = $('#from_create-coment');
            var rules = {
                OBS_observacion: {required: true, minlength: 1, maxlength: 190},
                OBS_Limit:{required:true},
            };

            FormValidationMd.init(form, rules, false, CrearComentario());

     //Comentarios

        var table1, url1, columns1;
        
        table1 = $('#Rubro_Personal');
       
           
        url1 = '{{ route('EstudianteGesap.RubroPersonal') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columns1 = [
            
            {data: 'RBR_PER_Nombre', name: 'RBR_PER_Nombre'},
            {data: 'RBR_PER_Funcion', name: 'RBR_PER_Funcion'},
            {data: 'RBR_PER_Tipo', name: 'RBR_PER_Tipo'},
            {data: 'RBR_PER_Dedicacion', name: 'RBR_PER_Dedicacion'},
            {data: 'RBR_PER_Entidad', name: 'RBR_PER_Entidad'},
            {data: 'RBR_PER_Solicitado_Udec', name: 'RBR_PER_Solicitado_Udec'},
            {data: 'RBR_PER_Contra_Udec', name: 'RBR_PER_Contra_Udec'},
            {data: 'RBR_PER_Contra_Otro', name: 'RBR_PER_Contra_Otro'},
            {data: 'RBR_PER_Total', name: 'RBR_PER_Total'},  
           
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('GESAP_STUDENT_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(table1, url1, columns1);
        table1 = table1.DataTable();
       
        var tabler, urlr, columnsr;
        tabler = $('#Rubro_PersonalF');
        urlr = '{{ route('EstudianteGesap.RubroPersonal') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsr = [
            
            {data: 'RBR_PER_Nombre', name: 'RBR_PER_Nombre'},
            {data: 'RBR_PER_Funcion', name: 'RBR_PER_Funcion'},
            {data: 'RBR_PER_Tipo', name: 'RBR_PER_Tipo'},
            {data: 'RBR_PER_Dedicacion', name: 'RBR_PER_Dedicacion'},
            {data: 'RBR_PER_Entidad', name: 'RBR_PER_Entidad'},
            {data: 'RBR_PER_Solicitado_Udec', name: 'RBR_PER_Solicitado_Udec'},
            {data: 'RBR_PER_Contra_Udec', name: 'RBR_PER_Contra_Udec'},
            {data: 'RBR_PER_Contra_Otro', name: 'RBR_PER_Contra_Otro'},
            {data: 'RBR_PER_Total', name: 'RBR_PER_Total'},  
        ];
        dataTableServer.init(tabler, urlr, columnsr);
        tabler = tabler.DataTable();

        
        $('.person').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Rubro_Personal').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearRubroPersona = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.RubroPersonalStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('RBR_PER_Nombre', $('#RBR_PER_Nombre').val());
                        formData.append('RBR_PER_Funcion', $('#RBR_PER_Funcion').val());
                        formData.append('RBR_PER_Tipo', $('#RBR_PER_Tipo').val());
                        formData.append('RBR_PER_Dedicacion', $('#RBR_PER_Dedicacion').val());
                        formData.append('RBR_PER_Entidad', $('#RBR_PER_Entidad').val());
                        formData.append('RBR_PER_Solicitado_Udec', $('#RBR_PER_Solicitado_Udec').val());
                        formData.append('RBR_PER_Contra_Udec', $('#RBR_PER_Contra_Udec').val());
                        formData.append('RBR_PER_Contra_Otro', $('#RBR_PER_Contra_Otro').val());
                        formData.append('RBR_PER_Total', $('#RBR_PER_Total').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
                        formData.append('CMMT_Formato', 1);
            


                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-Rubro_Personal').modal('hide');
                                    $('#form_create_Rubro_Personal')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form1 = $('#form_create_Rubro_Personal');
            var rules1 = {
                RBR_PER_Nombre:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Funcion:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Tipo:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Dedicacion:{minlength: 1, maxlength: 2, required: true, number:true},
                RBR_PER_Entidad:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_Total:{minlength: 1, maxlength: 190, required: true},
           
            };


            FormValidationMd.init(form1, rules1, false, CrearRubroPersona()); 

            table1.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $tr1 = $(this).closest('tr');

            var dataTable1 = table1.row($tr1).data();
            var route1 = '{{ route('EstudianteGesap.RubroPersonalDelete') }}' + '/' + dataTable1.PK_RBR_Personal;
            var type1 = 'DELETE';
            var async1 = async1 || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este Rubro?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: route1,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type1,
                            contentType: false,
                            processData: false,
                            async: async1,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    table1.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun Rubro", "error");
                    }
                });

        });
        var id_actividad_rp = 0;
        table1.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-editar-Rubro_Personal').modal('toggle');
            $tr1 = $(this).closest('tr');
            var dataTable1 = table1.row($tr1).data();
            id_actividad_rp = dataTable1.PK_RBR_Personal;
            $('#RBR_PER_EDITAR_Nombre').val(dataTable1.RBR_PER_Nombre);
            $('#RBR_PER_EDITAR_Funcion').val(dataTable1.RBR_PER_Funcion);
            $('#RBR_PER_EDITAR_Tipo').val(dataTable1.RBR_PER_Tipo);
            $('#RBR_PER_EDITAR_Dedicacion').val(dataTable1.RBR_PER_Dedicacion);
            $('#RBR_PER_EDITAR_Entidad').val(dataTable1.RBR_PER_Entidad);
            $('#RBR_PER_EDITAR_Solicitado_Udec').val(dataTable1.RBR_PER_Solicitado_Udec);
            $('#RBR_PER_EDITAR_Contra_Udec').val(dataTable1.RBR_PER_Contra_Udec);
            $('#RBR_PER_EDITAR_Contra_Otro').val(dataTable1.RBR_PER_Contra_Otro);
            $('#RBR_PER_EDITAR_Total').val(dataTable1.RBR_PER_Total);
                        
        });

        var EditarRubroPersonal = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarRubroPersonal') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      

                        formData.append('PK_RBR_Personal', id_actividad_rp);
                        formData.append('RBR_PER_EDITAR_Nombre', $('#RBR_PER_EDITAR_Nombre').val());
                        formData.append('RBR_PER_EDITAR_Funcion', $('#RBR_PER_EDITAR_Funcion').val());
                        formData.append('RBR_PER_EDITAR_Tipo', $('#RBR_PER_EDITAR_Tipo').val());
                        formData.append('RBR_PER_EDITAR_Dedicacion', $('#RBR_PER_EDITAR_Dedicacion').val());
                        formData.append('RBR_PER_EDITAR_Entidad', $('#RBR_PER_EDITAR_Entidad').val());
                        formData.append('RBR_PER_EDITAR_Solicitado_Udec', $('#RBR_PER_EDITAR_Solicitado_Udec').val());
                        formData.append('RBR_PER_EDITAR_Contra_Udec', $('#RBR_PER_EDITAR_Contra_Udec').val());
                        formData.append('RBR_PER_EDITAR_Contra_Otro', $('#RBR_PER_EDITAR_Contra_Otro').val());
                        formData.append('RBR_PER_EDITAR_Total', $('#RBR_PER_EDITAR_Total').val());
                        

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-editar-Rubro_Personal').modal('hide');
                                    $('#form_editar_Rubro_Personal')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var form2 = $('#form_editar_Rubro_Personal');
            var rules2 = {
                RBR_PER_EDITAR_Nombre:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Funcion:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Tipo:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Dedicacion:{minlength: 1, maxlength: 2, required: true,number:true},
                RBR_PER_EDITAR_Entidad:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_PER_EDITAR_Total:{minlength: 1, maxlength: 190, required: true},
           
                 
             };


            FormValidationMd.init(form2, rules2, false, EditarRubroPersonal()); 
            ////////////PERSONAL////////////FIN///////////////////////////////////////////////////////////
            
        var tablee, urle, columnse;
        
        tablee = $('#Rubro_Equipo');
       
           
        urle = '{{ route('EstudianteGesap.RubroEquipos') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columnse = [
            
            {data: 'RBR_EQP_Descripcion', name: 'RBR_EQP_Descripcion'},
            {data: 'RBR_EQP_Lab', name: 'RBR_EQP_Lab'},
            {data: 'RBR_EQP_Actividades', name: 'RBR_EQP_Actividades'},
            {data: 'RBR_EQP_Justificacion', name: 'RBR_EQP_Justificacion'},
            {data: 'RBR_EQP_Cantidad', name: 'RBR_EQP_Cantidad'},
            {data: 'RBR_EQP_Val', name: 'RBR_EQP_Val'},
            {data: 'RBR_EQP_Solicitado', name: 'RBR_EQP_Solicitado'},
            {data: 'RBR_EQP_Contra_Udec', name: 'RBR_EQP_Contra_Udec'},
            {data: 'RBR_EQP_Contra_Otro', name: 'RBR_EQP_Contra_Otro'},
            {data: 'RBR_EQP_Total', name: 'RBR_EQP_Total'},  
           
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar" class="btn btn-danger EliminarE" ><i class="icon-trash"></i></a>@endpermission @permission('GESAP_STUDENT_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(tablee, urle, columnse);
        tablee = tablee.DataTable();
       
        var tableef, urlef, columnsef;
        tableef = $('#Rubro_EquipoF');
        urlef = '{{ route('EstudianteGesap.RubroEquipos') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsef = [
            
            {data: 'RBR_EQP_Descripcion', name: 'RBR_EQP_Descripcion'},
            {data: 'RBR_EQP_Lab', name: 'RBR_EQP_Lab'},
            {data: 'RBR_EQP_Actividades', name: 'RBR_EQP_Actividades'},
            {data: 'RBR_EQP_Justificacion', name: 'RBR_EQP_Justificacion'},
            {data: 'RBR_EQP_Cantidad', name: 'RBR_EQP_Cantidad'},
            {data: 'RBR_EQP_Val', name: 'RBR_EQP_Val'},
            {data: 'RBR_EQP_Solicitado', name: 'RBR_EQP_Solicitado'},
            {data: 'RBR_EQP_Contra_Udec', name: 'RBR_EQP_Contra_Udec'},
            {data: 'RBR_EQP_Contra_Otro', name: 'RBR_EQP_Contra_Otro'},
            {data: 'RBR_EQP_Total', name: 'RBR_EQP_Total'},  
        ];
        dataTableServer.init(tableef, urlef, columnsef);
        tableef = tableef.DataTable();

        

            $('.equip').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Rubro_Equipo').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearRubroEquipo = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.RubroEquiposStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('RBR_EQP_Descripcion', $('#RBR_EQP_Descripcion').val());
                        formData.append('RBR_EQP_Lab', $('#RBR_EQP_Lab').val());
                        formData.append('RBR_EQP_Actividades', $('#RBR_EQP_Actividades').val());
                        formData.append('RBR_EQP_Justificacion', $('#RBR_EQP_Justificacion').val());
                        formData.append('RBR_EQP_Cantidad', $('#RBR_EQP_Cantidad').val());
                        formData.append('RBR_EQP_Val', $('#RBR_EQP_Val').val());
                        formData.append('RBR_EQP_Solicitado', $('#RBR_EQP_Solicitado').val());
                        formData.append('RBR_EQP_Contra_Udec', $('#RBR_EQP_Contra_Udec').val());
                        formData.append('RBR_EQP_Contra_Otro', $('#RBR_EQP_Contra_Otro').val());
                        formData.append('RBR_EQP_Total', $('#RBR_EQP_Total').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
                        formData.append('CMMT_Formato', 1);
            


                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-Rubro_Equipo').modal('hide');
                                    $('#form_create_Rubro_Equipo')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var forme = $('#form_create_Rubro_Equipo');
            var rulese = {
                RBR_EQP_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Lab:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Actividades:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Cantidad:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_EQP_Val:{minlength: 1, maxlength: 190, required: true,number:true},
                RBR_EQP_Solicitado:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_Total:{minlength: 1, maxlength: 190, required: true,number:true},
               
            };


            FormValidationMd.init(forme, rulese, false, CrearRubroEquipo()); 

            tablee.on('click', '.EliminarE', function (e) {
            
                e.preventDefault();
                $tre = $(this).closest('tr');

                var dataTablee = tablee.row($tre).data();
                var routee = '{{ route('EstudianteGesap.RubroEquiposDelete') }}' + '/' + dataTablee.PK_RBR_Equipo;
                var typee = 'DELETE';
                var asynce = asynce || false;
                swal({
                        title: "¿Está seguro?",
                        text: "¿Está seguro de eliminar este Rubro?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "De acuerdo",
                        cancelButtonText: "Cancelar",
                        closeOnConfirm: true,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: routee,
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                cache: false,
                                type: typee,
                                contentType: false,
                                processData: false,
                                async: asynce,
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        tablee.ajax.reload();
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 && xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        } else {
                            swal("Cancelado", "No se eliminó ningun Rubro", "error");
                        }
                    });

        });

        var id_actividad_eq = 0;
            tablee.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-editar-Rubro_Equipo').modal('toggle');
            $tre = $(this).closest('tr');
            var dataTablee = tablee.row($tre).data();
            id_actividad_eq = dataTablee.PK_RBR_Equipo;
            $('#RBR_EQP_EDITAR_Descripcion').val(dataTablee.RBR_EQP_Descripcion);
            $('#RBR_EQP_EDITAR_Lab').val(dataTablee.RBR_EQP_Lab);
            $('#RBR_EQP_EDITAR_Actividades').val(dataTablee.RBR_EQP_Actividades);
            $('#RBR_EQP_EDITAR_Justificacion').val(dataTablee.RBR_EQP_Justificacion);
            $('#RBR_EQP_EDITAR_Cantidad').val(dataTablee.RBR_EQP_Cantidad);
            $('#RBR_EQP_EDITAR_Val').val(dataTablee.RBR_EQP_Val);
            $('#RBR_EQP_EDITAR_Solicitado').val(dataTablee.RBR_EQP_Solicitado);
            $('#RBR_EQP_EDITAR_Contra_Udec').val(dataTablee.RBR_EQP_Contra_Udec);
            $('#RBR_EQP_EDITAR_Contra_Otro').val(dataTablee.RBR_EQP_Contra_Otro);
            $('#RBR_EQP_EDITAR_Total').val(dataTablee.RBR_EQP_Total);
                        
        });

        var EditarRubroEquipo = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarRubroEquipos') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      

                        formData.append('PK_RBR_Equipo', id_actividad_eq);
                        formData.append('RBR_EQP_EDITAR_Descripcion', $('#RBR_EQP_EDITAR_Descripcion').val());
                        formData.append('RBR_EQP_EDITAR_Lab', $('#RBR_EQP_EDITAR_Lab').val());
                        formData.append('RBR_EQP_EDITAR_Actividades', $('#RBR_EQP_EDITAR_Actividades').val());
                        formData.append('RBR_EQP_EDITAR_Justificacion', $('#RBR_EQP_EDITAR_Justificacion').val());
                        formData.append('RBR_EQP_EDITAR_Cantidad', $('#RBR_EQP_EDITAR_Cantidad').val());
                        formData.append('RBR_EQP_EDITAR_Val', $('#RBR_EQP_EDITAR_Val').val());
                        formData.append('RBR_EQP_EDITAR_Solicitado', $('#RBR_EQP_EDITAR_Solicitado').val());
                        formData.append('RBR_EQP_EDITAR_Contra_Udec', $('#RBR_EQP_EDITAR_Contra_Udec').val());
                        formData.append('RBR_EQP_EDITAR_Contra_Otro', $('#RBR_EQP_EDITAR_Contra_Otro').val());
                        formData.append('RBR_EQP_EDITAR_Total', $('#RBR_EQP_EDITAR_Total').val());
                        

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-editar-Rubro_Equipo').modal('hide');
                                    $('#form_editar_Rubro_Equipo')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var formef = $('#form_editar_Rubro_Equipo');
            var rulesef = {
                RBR_EQP_EDITAR_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Lab:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Actividades:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Cantidad:{minlength: 1, maxlength: 190, required: true,number:true},
                RBR_EQP_EDITAR_Val:{minlength: 1, maxlength: 190, required: true,number:true},
                RBR_EQP_EDITAR_Solicitado:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_EQP_EDITAR_Total:{minlength: 1, maxlength: 190, required: true,number:true},
           
                 
             };


            FormValidationMd.init(formef, rulesef, false, EditarRubroEquipo()); 

        ///////////////////////////////////////////////////////////FIN RUBRO EQUIPO//////////////////////////////////////////////////
        
        var tablem, urlm, columnsm;
        
        tablem = $('#Rubro_Material');
       
           
        urlm = '{{ route('EstudianteGesap.RubroMaterial') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columnsm = [
            
            {data: 'RBR_MTL_Descripcion', name: 'RBR_MTL_Descripcion'},
            {data: 'RBR_MTL_Justificacion', name: 'RBR_MTL_Justificacion'},
            {data: 'RBR_MTL_Cantidad', name: 'RBR_MTL_Cantidad'},
            {data: 'RBR_MTL_Val', name: 'RBR_MTL_Val'},
            {data: 'RBR_MTL_Solicitado_Udec', name: 'RBR_MTL_Solicitado_Udec'},
            {data: 'RBR_MTL_Contra_Udec', name: 'RBR_MTL_Contra_Udec'},
            {data: 'RBR_MTL_Contra_Otro', name: 'RBR_MTL_Contra_Otro'},
            {data: 'RBR_MTL_Total', name: 'RBR_MTL_Total'},
          
           
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('GESAP_STUDENT_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(tablem, urlm, columnsm);
        tablem = tablem.DataTable();
       
        var tablemf, urlmf, columnsmf;
        tablemf = $('#Rubro_MaterialF');
        urlmf = '{{ route('EstudianteGesap.RubroMaterial') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnsmf = [
            
              
            {data: 'RBR_MTL_Descripcion', name: 'RBR_MTL_Descripcion'},
            {data: 'RBR_MTL_Justificacion', name: 'RBR_MTL_Justificacion'},
            {data: 'RBR_MTL_Cantidad', name: 'RBR_MTL_Cantidad'},
            {data: 'RBR_MTL_Val', name: 'RBR_MTL_Val'},
            {data: 'RBR_MTL_Solicitado_Udec', name: 'RBR_MTL_Solicitado_Udec'},
            {data: 'RBR_MTL_Contra_Udec', name: 'RBR_MTL_Contra_Udec'},
            {data: 'RBR_MTL_Contra_Otro', name: 'RBR_MTL_Contra_Otro'},
            {data: 'RBR_MTL_Total', name: 'RBR_MTL_Total'},
        ];
        dataTableServer.init(tablemf, urlmf, columnsmf);
        tablemf = tablemf.DataTable();

        

            $('.Material').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Rubro_Material').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearRubroMaterial = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.RubroMaterialStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('RBR_MTL_Descripcion', $('#RBR_MTL_Descripcion').val());
                        formData.append('RBR_MTL_Justificacion', $('#RBR_MTL_Justificacion').val());
                        formData.append('RBR_MTL_Cantidad', $('#RBR_MTL_Cantidad').val());
                        formData.append('RBR_MTL_Val', $('#RBR_MTL_Val').val());
                        formData.append('RBR_MTL_Solicitado_Udec', $('#RBR_MTL_Solicitado_Udec').val());
                        formData.append('RBR_MTL_Contra_Udec', $('#RBR_MTL_Contra_Udec').val());
                        formData.append('RBR_MTL_Contra_Otro', $('#RBR_MTL_Contra_Otro').val());
                        formData.append('RBR_MTL_Total', $('#RBR_MTL_Total').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
                        formData.append('CMMT_Formato', 1);
            


                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-Rubro_Material').modal('hide');
                                    $('#form_create_Rubro_Material')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var formm = $('#form_create_Rubro_Material');
            var rulesm = {
                RBR_MTL_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_Cantidad:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_MTL_Val:{minlength: 1, maxlength: 190, required: true, number:true,number:true},
                RBR_MTL_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_Total:{minlength: 1, maxlength: 190, required: true,number:true},
               
            };
            FormValidationMd.init(formm, rulesm, false, CrearRubroMaterial()); 


            tablem.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $trm = $(this).closest('tr');

            var dataTablem = tablem.row($trm).data();
            var routem = '{{ route('EstudianteGesap.RubroMaterialDelete') }}' + '/' + dataTablem.PK_RBR_Material;
            var typem = 'DELETE';
            var asyncm = asyncm || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este Rubro?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: routem,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: typem,
                            contentType: false,
                            processData: false,
                            async: asyncm,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    tablem.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun Rubro", "error");
                    }
                });

        });
        var id_actividad_mq = 0;
        tablem.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-editar-Rubro_Material').modal('toggle');
            $trm = $(this).closest('tr');
            var dataTablem = tablem.row($trm).data();
            id_actividad_mq = dataTablem.PK_RBR_Material;
            $('#RBR_MTL_EDITAR_Descripcion').val(dataTablem.RBR_MTL_Descripcion);
            $('#RBR_MTL_EDITAR_Justificacion').val(dataTablem.RBR_MTL_Justificacion);
            $('#RBR_MTL_EDITAR_Cantidad').val(dataTablem.RBR_MTL_Cantidad);
            $('#RBR_MTL_EDITAR_Val').val(dataTablem.RBR_MTL_Val);
            $('#RBR_MTL_EDITAR_Solicitado_Udec').val(dataTablem.RBR_MTL_Solicitado_Udec);
            $('#RBR_MTL_EDITAR_Contra_Udec').val(dataTablem.RBR_MTL_Contra_Udec);
            $('#RBR_MTL_EDITAR_Contra_Otro').val(dataTablem.RBR_MTL_Contra_Otro);
            $('#RBR_MTL_EDITAR_Total').val(dataTablem.RBR_MTL_Total);
                        
        });

        var EditarRubroMaterial = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarRubroMaterial') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      

                        formData.append('PK_RBR_Material', id_actividad_mq);
                        formData.append('RBR_MTL_EDITAR_Descripcion', $('#RBR_MTL_EDITAR_Descripcion').val());
                        formData.append('RBR_MTL_EDITAR_Justificacion', $('#RBR_MTL_EDITAR_Justificacion').val());
                        formData.append('RBR_MTL_EDITAR_Cantidad', $('#RBR_MTL_EDITAR_Cantidad').val());
                        formData.append('RBR_MTL_EDITAR_Val', $('#RBR_MTL_EDITAR_Val').val());
                        formData.append('RBR_MTL_EDITAR_Solicitado_Udec', $('#RBR_MTL_EDITAR_Solicitado_Udec').val());
                        formData.append('RBR_MTL_EDITAR_Contra_Udec', $('#RBR_MTL_EDITAR_Contra_Udec').val());
                        formData.append('RBR_MTL_EDITAR_Contra_Otro', $('#RBR_MTL_EDITAR_Contra_Otro').val());
                        formData.append('RBR_MTL_EDITAR_Total', $('#RBR_MTL_EDITAR_Total').val());
                        

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-editar-Rubro_Material').modal('hide');
                                    $('#form_editar_Rubro_Material')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var formmf = $('#form_editar_Rubro_Material');
            var rulesmf = {
                RBR_MTL_EDITAR_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_EDITAR_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_EDITAR_Cantidad:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_MTL_EDITAR_Val:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_MTL_EDITAR_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_EDITAR_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_EDITAR_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_MTL_EDITAR_Total:{minlength: 1, maxlength: 190, required: true,number:true},
           
                 
             };


            FormValidationMd.init(formmf, rulesmf, false, EditarRubroMaterial()); 

        ///////////////////////////////////////////////////////////FIN RUBRO MATERIAL//////////////////////////////////////////////////
        
        
   
        var tablet, urlt, columnst;
        
        tablet = $('#Rubro_Tecnologico');
       
           
        urlt = '{{ route('EstudianteGesap.RubroTecnologico') }}'+'/'+'{{$datos['Anteproyecto']}}';
       
       
        columnst = [
            
            {data: 'RBR_TEC_Descripcion', name: 'RBR_TEC_Descripcion'},
            {data: 'RBR_TEC_Justificacion', name: 'RBR_TEC_Justificacion'},
            {data: 'RBR_TEC_Val', name: 'RBR_TEC_Val'},
            {data: 'RBR_TEC_Entidad', name: 'RBR_TEC_Entidad'},
            {data: 'RBR_TEC_Solicitado_Udec', name: 'RBR_TEC_Solicitado_Udec'},
            {data: 'RBR_TEC_Contra_Udec', name: 'RBR_TEC_Contra_Udec'},
            {data: 'RBR_TEC_Contra_Otro', name: 'RBR_TEC_Contra_Otro'},
            {data: 'RBR_TEC_Total', name: 'RBR_TEC_Total'},
          
           
            {
                defaultContent: ' @permission('GESAP_STUDENT_DELETE')<a href="javascript:;" title="Eliminar" class="btn btn-danger Eliminar" ><i class="icon-trash"></i></a>@endpermission @permission('GESAP_STUDENT_UPDATE')<a href="javascript:;" title="Editar" class="btn btn-warning Editar" ><i class="icon-pencil"></i></a>@endpermission ' ,
                data: 'action',
                name: 'action',
                title: 'Acciones',
                orderable: false,
                searchable: false,
                exportable: false,
                printable: false,
                className: 'text-center',
                render: null,
                serverSide: false,
                responsivePriority: 2
            }
        ];
        dataTableServer.init(tablet, urlt, columnst);
        tablet = tablet.DataTable();
       
        var tabletf, urltf, columnstf;
        tabletf = $('#Rubro_TecnologicoF');
        urltf = '{{ route('EstudianteGesap.RubroTecnologico') }}'+'/'+'{{$datos['Anteproyecto']}}';
        columnstf = [
            
             
            {data: 'RBR_TEC_Descripcion', name: 'RBR_TEC_Descripcion'},
            {data: 'RBR_TEC_Justificacion', name: 'RBR_TEC_Justificacion'},
            {data: 'RBR_TEC_Val', name: 'RBR_TEC_Val'},
            {data: 'RBR_TEC_Entidad', name: 'RBR_TEC_Entidad'},
            {data: 'RBR_TEC_Solicitado_Udec', name: 'RBR_TEC_Solicitado_Udec'},
            {data: 'RBR_TEC_Contra_Udec', name: 'RBR_TEC_Contra_Udec'},
            {data: 'RBR_TEC_Contra_Otro', name: 'RBR_TEC_Contra_Otro'},
            {data: 'RBR_TEC_Total', name: 'RBR_TEC_Total'},
        ];
        dataTableServer.init(tabletf, urltf, columnstf);
        tabletf = tabletf.DataTable();

        

            $('.Tecnologic').on('click', function (e) {
            e.preventDefault();
            $('#modal-create-Rubro_Tecnologico').modal('toggle');
        });
        jQuery.validator.addMethod("noSpecialCharacters", function(value, element) {
                 return this.optional(element) || /^[0-9]+$/i.test(value);
        });
        var CrearRubroTecnologico = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.RubroTecnologicoStore') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('RBR_TEC_Descripcion', $('#RBR_TEC_Descripcion').val());
                        formData.append('RBR_TEC_Justificacion', $('#RBR_TEC_Justificacion').val());
                        formData.append('RBR_TEC_Val', $('#RBR_TEC_Val').val());
                        formData.append('RBR_TEC_Entidad', $('#RBR_TEC_Entidad').val());
                        formData.append('RBR_TEC_Solicitado_Udec', $('#RBR_TEC_Solicitado_Udec').val());
                        formData.append('RBR_TEC_Contra_Udec', $('#RBR_TEC_Contra_Udec').val());
                        formData.append('RBR_TEC_Contra_Otro', $('#RBR_TEC_Contra_Otro').val());
                        formData.append('RBR_TEC_Total', $('#RBR_TEC_Total').val());
                        
            
///LA OTRA TABLA///
                        formData.append('FK_NPRY_IdMctr008', '{{$datos['Anteproyecto']}}');
                        formData.append('FK_MCT_IdMctr008', '{{$datos[0]['PK_MCT_IdMctr008']}}');
                        formData.append('FK_User_Codigo', id);
                        formData.append('CMMT_Commit', 'Tabla Subida');
                        formData.append('FK_CHK_Checklist', 1);
                        formData.append('CMMT_Formato', 1);
            


                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-create-Rubro_Tecnologico').modal('hide');
                                    $('#form_create_Rubro_Tecnologico')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var formt = $('#form_create_Rubro_Tecnologico');
            var rulest = {
                RBR_TEC_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Val:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_TEC_Entidad:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_Total:{minlength: 1, maxlength: 190, required: true,number:true},
               
            };
            FormValidationMd.init(formt, rulest, false, CrearRubroTecnologico()); 


            tablet.on('click', '.Eliminar', function (e) {
            e.preventDefault();
            $trt = $(this).closest('tr');

            var dataTablet = tablet.row($trt).data();
            var routet = '{{ route('EstudianteGesap.RubroTecnologicoDelete') }}' + '/' + dataTablet.PK_RBR_Tecnologico;
            var typet = 'DELETE';
            var asynct = asynct || false;
            swal({
                    title: "¿Está seguro?",
                    text: "¿Está seguro de eliminar este Rubro?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "De acuerdo",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: routet,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: typet,
                            contentType: false,
                            processData: false,
                            async: asynct,
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                    tablet.ajax.reload();
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                }
                            }
                        });
                    } else {
                        swal("Cancelado", "No se eliminó ningun Rubro", "error");
                    }
                });

        });
        var id_actividad_tq = 0;
        tablet.on('click', '.Editar', function (e) {
            e.preventDefault();
            $('#modal-editar-Rubro_Tecnologico').modal('toggle');
            $trt = $(this).closest('tr');
            var dataTablet = tablet.row($trt).data();
            id_actividad_tq = dataTablet.PK_RBR_Tecnologico;
            $('#RBR_TEC_EDITAR_Descripcion').val(dataTablet.RBR_TEC_Descripcion);
            $('#RBR_TEC_EDITAR_Justificacion').val(dataTablet.RBR_TEC_Justificacion);
            $('#RBR_TEC_EDITAR_Val').val(dataTablet.RBR_TEC_Val);
            $('#RBR_TEC_EDITAR_Entidad').val(dataTablet.RBR_TEC_Entidad);
            $('#RBR_TEC_EDITAR_Solicitado_Udec').val(dataTablet.RBR_TEC_Solicitado_Udec);
            $('#RBR_TEC_EDITAR_Contra_Udec').val(dataTablet.RBR_TEC_Contra_Udec);
            $('#RBR_TEC_EDITAR_Contra_Otro').val(dataTablet.RBR_TEC_Contra_Otro);
            $('#RBR_TEC_EDITAR_Total').val(dataTablet.RBR_TEC_Total);
                        
        });

        var EditarRubroTecnologico = function () {
                return {
                    init: function () {
                        var route = '{{ route('EstudianteGesap.EditarRubroTecnologico') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();      

                        formData.append('PK_RBR_Tecnologico', id_actividad_tq);
                        formData.append('RBR_TEC_EDITAR_Descripcion', $('#RBR_TEC_EDITAR_Descripcion').val());
                        formData.append('RBR_TEC_EDITAR_Justificacion', $('#RBR_TEC_EDITAR_Justificacion').val());
                        formData.append('RBR_TEC_EDITAR_Val', $('#RBR_TEC_EDITAR_Val').val());
                        formData.append('RBR_TEC_EDITAR_Entidad', $('#RBR_TEC_EDITAR_Entidad').val());
                        formData.append('RBR_TEC_EDITAR_Solicitado_Udec', $('#RBR_TEC_EDITAR_Solicitado_Udec').val());
                        formData.append('RBR_TEC_EDITAR_Contra_Udec', $('#RBR_TEC_EDITAR_Contra_Udec').val());
                        formData.append('RBR_TEC_EDITAR_Contra_Otro', $('#RBR_TEC_EDITAR_Contra_Otro').val());
                        formData.append('RBR_TEC_EDITAR_Total', $('#RBR_TEC_EDITAR_Total').val());
                        

                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                if (request.status === 200 && xhr === 'success') {
                                   // table.ajax.reload();
                                    $('#modal-editar-Rubro_Tecnologico').modal('hide');
                                    $('#form_editar_Rubro_Tecnologico')[0].reset(); //Limpia formulario
                                    UIToastr.init(xhr, response.title, response.message);        
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                    
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    var route = '{{ route('EstudianteGesap.SubirActividad') }}' + '/' + '{{$datos[0]['PK_MCT_IdMctr008']}}' + '/'+ '{{$datos['Anteproyecto']}}';
                                    $(".content-ajax").load(route);
                                   
                                }
                            }
                        });
                    }
                }
            };
            var formtf = $('#form_editar_Rubro_Tecnologico');
            var rulestf = {
                RBR_TEC_EDITAR_Descripcion:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Justificacion:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Val:{minlength: 1, maxlength: 190, required: true, number:true},
                RBR_TEC_EDITAR_Entidad:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Solicitado_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Contra_Udec:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Contra_Otro:{minlength: 1, maxlength: 190, required: true},
                RBR_TEC_EDITAR_Total:{minlength: 1, maxlength: 190, required: true,number:true},
           
                 
             };


            FormValidationMd.init(formtf, rulestf, false, EditarRubroTecnologico()); 

        ///////////////////////////////////////////////////////////FIN RUBRO TECNOLOGICO//////////////////////////////////////////////////
        
        


        $('.button-cancel').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('EstudianteGesap.VerActividades') }}' + '/' + '{{$datos['Anteproyecto']}}';

            //location.href="{{route('EstudianteGesap.index')}}";
           $(".content-ajax").load(route);
        });
   
    
})
</script>    

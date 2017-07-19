@extends('material.layouts.dashboard')

@push('styles')
<!-- Datatables Styles -->
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('title', '| Gestion Funcionarios')

@section('page-title', 'Gestion Funcionarios')

@section('page-description', 'ver, modificar, eliminar y crear nuevos funcionarios.')

@section('content')
    <div class="col-md-12">

        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-users', 'title' => 'Gestion Funcionarios'])
            
           
            @include('audiovisuals.funcionario.modalregistrar')
            @include('audiovisuals.funcionario.modal')
            
            <div id="msj-error-nuevo" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <strong id="msj"></strong>
            </div> 
            <div id="msj-success-nuevo" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <strong>Funcionario Nuevo Correctamente</strong>
            </div> 
            <div id="msj-success-actualizar" class="alert alert-success alert-dismissible" role="alert" style="display:none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <strong>Funcionario Actualizado Correctamente</strong>
            </div>  

            <div id="msj-success-eliminar" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                  <strong>Funcionario Eliminado Correctamente</strong>
            </div>
            <div class="clearfix"> </div><br><br><br>
            <div class="row">
                    <div class="col-md-12">
                            <div class="actions">
                                <a href="javascript:;" class="btn btn-simple btn-success btn-icon create"><i class="fa fa-plus"></i></a>                    
                            </div>
                    </div>
                <div class="col-md-12">
                    
                    @component('themes.bootstrap.elements.tables.datatables', ['id' => 'gestionar-funcionarios-ajax'])
                        @slot('columns', [
                                '#' => ['style' => 'width:20px;'],
                                'Cedula',
                                'Nombres',
                                'Correo',
                                'Programa',
                                'Acciones' => ['style' => 'width:90px;']
                            ])
                    @endcomponent
                </div>
            </div>
        @endcomponent
    </div>
@endsection

@push('plugins')
<!-- Datatables Scripts -->
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>


{{-- VALIDACIONES --}}
<script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}" type="text/javascript"></script>


<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>

@endpush

@push('functions')
{{-- VALIDACIONES --}}

<script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript"></script>
<script>




jQuery(document).ready(function () {
    //UIToastr.init('success', 'Bien', 'Correcto');
    var table, url, columns;
    table = $('#gestionar-funcionarios-ajax');
    url = "{{ route('funcionario.listing') }}";

    columns = [
        {data: 'DT_Row_Index'},
        {data: 'PK_FNS_Cedula', name: 'Cedula'},
        {data: 'FNS_Nombres', name: 'Nombres'},
        {data: 'FNS_Correo', name: 'Correo Electronico'},
        {data: 'FK_FNS_Programa', name: 'Programa'},
        {
            defaultContent: '<a href="#" class="btn btn-simple btn-warning btn-icon edit" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i></a><a href="javascript:;" class="btn btn-simple btn-danger btn-icon remove"><i class="icon-trash"></i></a>',
            data:'action',
            name:'action',
            title:'Acciones',
            orderable: false,
            searchable: false,
            exportable: false,
            printable: false,
            className: 'text-right',
            render: null,
            responsivePriority:2
        }
    ];
    dataTableServer.init(table, url, columns);

    table = table.DataTable();
    table.on('click', '.remove', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();

        // alert(dataTable.PK_FNS_Cedula);
        var route = '{{ route('funcionario.delete') }}'+'/'+dataTable.PK_FNS_Cedula;
        var token = $("#token").val();


          $.ajax({
            url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'DELETE',
                dataType: 'json',
                
            success: function(){
              table.ajax.reload();
              $("#msj-success-eliminar").fadeIn();//MENSAJE
              
            }
          });

        $.get( "../../audiovisuales/funcionario/all/"+ dataTable.PK_FNS_Cedula, function( data ) {
            console.log(data);
            
            //table.ajax.reload();
        });
    });
    table.on('click', '.edit', function (e) {
        e.preventDefault();
        $tr = $(this).closest('tr');
        var dataTable = table.row($tr).data();
        // alert(dataTable.PK_FNS_Cedula);
        $.get( "../../audiovisuales/funcionario/all/"+ dataTable.PK_FNS_Cedula, function( data ) {
            console.log(data);
            //table.ajax.reload();
            $("#FNS_Nombres").val(data.FNS_Nombres);
            $("#FNS_Apellidos").val(data.FNS_Apellidos);
            $("#id").val(data.PK_FNS_Cedula);
            $("#PK_FNS_Cedula").val(data.PK_FNS_Cedula);
            $("#FNS_Correo").val(data.FNS_Correo);
            $("#FNS_Telefono").val(data.FNS_Telefono);
            $("#FNS_Direccion").val(data.FNS_Direccion);
            $("#FK_FNS_Estado").val(data.FK_FNS_Estado);
            $("#FK_FNS_Programa").val(data.FK_FNS_Programa);
            $("#FNS_Clave").val(data.FNS_Clave);

            // PARA SELECCIONAR LA OPCION DE RADIO
            if (data.FK_FNS_Rol=='Estudiante'){
                    $("input[name=FK_FNS_Rol][value='Estudiante']").prop("checked",true);
            }else {
                        $("input[name=FK_FNS_Rol][value='Docente']").prop("checked",true);
            }
        });
        // $("#actualizar").click(function(){
              
        //         var value = $("#id").val();
        //         var fns = $("#form_funcionario");
        //         var route = '{{ route('funcionario.update') }}'+'/'+value;
        //         var token = $("#token").val();


        //       $.ajax({
        //         url: route,
        //             headers: {'X-CSRF-TOKEN': token},
        //             type: 'PUT',
        //             dataType: 'json',
        //             data:$(fns).serialize(),
        //         success: function(){

        //           table.ajax.reload();
        //           $("#myModal").modal('toggle');// OCULTAR MODAL
        //           $("#msj-success-actualizar").fadeIn();//MENSAJE
                  
        //         }
        //       });
        // }); 


    });
    ///editar sin FOMR::
    /*$('#ipdate').on('click', function(){
        var id = $('#id_usu').val();
    });*/


    $( ".create" ).on('click', function (e) {
            e.preventDefault();
            $('#modal-registrar-funcionario').modal('toggle');
        });
    var updatePermissions = function () {
            return{
                init: function () {
                    var value = $("#id").val();
                    var fns = $("#form_funcionario");
                    var route = '{{ route('funcionario.update') }}'+'/'+value;
                    var token = $("#token").val();


                  $.ajax({
                    url: route,
                        headers: {'X-CSRF-TOKEN': token},
                        type: 'PUT',
                        dataType: 'json',
                        data:$(fns).serialize(),
                    success: function(){

                      table.ajax.reload();
                      $("#myModal").modal('toggle');// OCULTAR MODAL
                      $("#msj-success-actualizar").fadeIn();//MENSAJE
                  
                }
              });
                }
            }
        };

        var form = $('#form_funcionario');
        var rules = {
            PK_FNS_Cedula: {minlength: 5, required: true},
            FNS_Nombres: {minlength: 5, required: true},
            FNS_Apellidos: {minlength: 5},
            FK_FNS_Rol: {required: true},
            FNS_Telefono: {minlength: 5},
            FNS_Direccion: {minlength: 5},
            FK_FNS_Estado: {minlength: 5},
            FK_FNS_Programa: {minlength: 5},
            FNS_Clave: {minlength: 5},
            
        };


        var createPermissions= function () {
            return{
                init: function () {
                    
                    var route = '{{ route('funcionario.create') }}';
                    var type = 'POST';
                    var async = async || false;

              

                    var formData = new FormData();
                    formData.append('PK_FNS_Cedula', $('input:text[name="PK_FNS_Cedula_registrar"]').val());
                    formData.append('FNS_Nombres', $('input:text[name="FNS_Nombres_registrar"]').val());
                    formData.append('FNS_Apellidos', $('input:text[name="FNS_Apellidos_registrar"]').val());
                    formData.append('FNS_Correo', $('input:text[name="FNS_Correo_registrar"]').val());
                    formData.append('FNS_Telefono', $('input:text[name="FNS_Telefono_registrar"]').val());
                    formData.append('FNS_Direccion', $('input:text[name="FNS_Direccion_registrar"]').val());
                    formData.append('FK_FNS_Estado', $('input:text[name="FK_FNS_Estado_registrar"]').val());
                    formData.append('FK_FNS_Programa', $('input:text[name="FK_FNS_Programa_registrar"]').val());
                    formData.append('FNS_Clave', $('input:text[name="FNS_Clave_registrar"]').val());
                    formData.append('FK_FNS_Rol', 
                        //$("input[name='FK_FNS_Rol_registrar']:checked").val()
                        $('input:radio[name="FK_FNS_Rol_registrar"]:checked').val());
                    

                    $.ajax({
                            url: route,
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                            },

                            success: function(result){
                                
                                    table.ajax.reload();
                                    $('#modal-registrar-funcionario').modal('hide');
                                    $('#form_funcionario_registrar')[0].reset(); //Limpia formulario
                                    $("#msj-success-nuevo").fadeIn();
                                
                            },
                           
                            error: function(response, xhr, request){
                                if (request.status === 422 &&  xhr === 'success') {
                                    $("#msj-error-nuevo").fadeIn();
                                }
                                
                                // $("#msj").html(msj.responseJSON.fns);
                                // $("#msj-error").fadeIn();
                            }
                     
                    });

                  
                }
            }
        };

        var form_registrar = $('#form_funcionario_registrar');
        var rules_registrar = {
            PK_FNS_Cedula_registrar: {minlength: 5, required: true},
            FNS_Nombres_registrar: {minlength: 5, required: true},
            FNS_Apellidos_registrar: {minlength: 5},
            FK_FNS_Rol_registrar: {required: true},
            FNS_Telefono_registrar: {minlength: 5},
            FNS_Direccion_registrar: {minlength: 5},
            FK_FNS_Estado_registrar: {minlength: 5},
            FK_FNS_Programa_registrar: {minlength: 5},
            FNS_Clave_registrar: {minlength: 5},
            
        };
    
        FormValidationMd.init(form_registrar,rules_registrar,false,createPermissions());



});
</script>
@endpush
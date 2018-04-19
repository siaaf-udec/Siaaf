@component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'DOCUMENTOS USUARIOS'])
{!! Form::button('ATRAS', ['class' => 'btn red back']) !!}
<div class="row">
    <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Documento'])
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Nombre',
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
    </div>
</div>

@endcomponent

 <script>
jQuery(document).ready(function () {
     App.unblockUI('.portlet-form');
    var table, url, columns;
        table = $('#Listar_Documento');
        url = "{{ route('listarDocumentoUsuario.listarDocumentoUsuario',[$id]) }}";
        columns = [
            {data: 'DT_Row_Index'},
           {data: 'PK_DCET_Documentacion_Extra', "visible": true,name:"PK_DCET_Documentacion_Extra",className:'none' },
           {data: 'DCET_Nombre',searchable: true,name:"DCET_Nombre"},
           { data: 'action',
            className: '',
            searchable: false,
            name: 'action',
            title: 'Acciones',
            orderable: false,
            exportable: false,
            printable: false,
            defaultContent: '@permission(['INTE_DES_DOC_USU'])<a href="#" class="btn btn-simple btn-whrite btn-icon descargar" title="Descargar Documento"><i class="fa fa-cloud-download"> DESCARGAR</i></a>@endpermission'},
        ];
    dataTableServer.init(table, url, columns);
    table = table.DataTable();
            table.on('click', '.descargar', function(e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var O = table.row($tr).data();
                $.ajax({
                    type: "GET",
                    url: '',
                    dataType: "html",
                }).done(function(data) {
                    window.location.href = '{{route('documentoDescargaUsuario.documentoDescargaUsuario') }}'+'/'+ O.PK_DCET_Documentacion_Extra;
                    
                });
        });
   
    $('.back').on('click', function (e) {
            e.preventDefault();
            var route = '{{ route('documentosConvenios.documentosConvenios') }}'+'/@php echo $convenio @endphp/@php echo $estado @endphp';
            $(".content-ajax").load(route);
        });
    
});
</script>

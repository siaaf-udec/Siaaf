
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-list', 'title' => 'LISTAR NOTIFICACIONES'])

<br><br>
    <div class="row">
        <div class="clearfix"> </div><br><br>
        <div class="col-md-12">
            @component('themes.bootstrap.elements.tables.datatables', ['id' => 'Listar_Notificaciones'])
            
                @slot('columns', [
                    '#' => ['style' => 'width:20px;'],
                    'ID',
                    'Titulo',
                    'Visto',       
                    'Acciones' => ['style' => 'width:160px;']
                ])
            @endcomponent
        </div>
    </div>
    @endcomponent
 


<script>
jQuery(document).ready(function () {
    
   
    var table, url, columns;
        table = $('#Listar_Notificaciones');
        url = "{{ route('listarAlerta.listarAlerta') }}";
        columns = [
               {data: 'DT_Row_Index'},
               {data: 'PK_NTFC_Notificacion', className:'none',"visible": true, name:"documento" },
               {data: 'NTFC_Titulo', searchable: true},
               {data: 'NTFC_Bandera', searchable: true},
               {data:'action',className:'',searchable: false,
                name:'action',
                title:'Acciones',
                orderable: false,
                exportable: false,
                printable: false,
                defaultContent: '<a href="#" id="editar" title="Editar Convenio" class="btn btn-simple btn-warning btn-icon ver"><i class="icon-eye"></i></a>'
           }
        ];
    dataTableServer.init(table, url, columns);
   
    
     table = table.DataTable();
     table.on('click', '.ver', function (e) {
            e.preventDefault();
            $tr = $(this).closest('tr');
            var dataTable = table.row($tr).data(),
                route_edit = '/siaaf/public/index.php/interaccion-universitaria/verAlerta/'+dataTable.PK_NTFC_Notificacion;

            $(".content-ajax").load(route_edit);
        });
   
      
});
</script>

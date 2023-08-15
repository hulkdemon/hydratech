
@extends('adminlte::page')

@section('title', 'Búsqueda Contratos')

@section('content')

    <body> 
       
        <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                <h1>Búsqueda de contratos para cobros, abonos y condonaciones</h1>
                </div>
                <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Búsqueda de contratos</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Contratos registrados</h4>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa-solid fa-tools"></i> Opciones de Gestión
                      </button>
                      <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{url ("admin")}}"><i class="fa-solid fa-file-signature"></i> Registrar contrato</a></li>
                        <li class="dropdown-item"><a href="#"><i class="fa-solid fa-folder-open"></i> Registrar tipo de contrato</a></li>
                      </ul>                
                </div>
            </div>
            <div class="card-body">
                <h5 class="mb-4">Realizar búsqueda por nombre, apellido, domicilio o número de contrato</h5>
                <table id="datos" class="table table-bordered table-striped">
                    <h5 class="m-0">Funciones de la tabla</h5>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Número del contrato</th>
                            <th>Nombre de la persona</th>
                            <th>Domicilio</th>
                            <th class="text-center">Acciones para el contrato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                        <tr>
                            <td>{{ $contrato->id_contrato }}</td>
                            <td>{{ $contrato->numero_contrato }}</td>
                            <td>{{ $contrato->nombre }} {{ $contrato->apellido }}</td>
                            <td>{{ $contrato->domicilio }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-credit-card"></i>  Realizar cobro</button>
                                    <button class="btn btn-success btn-sm"><i class="fa-solid fa-wallet"></i> Registrar abono</button>
                                    <button class="btn btn-info btn-sm"><i class="fa-solid fa-hand-holding-dollar"></i> Asignar condonación</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </body>
    </html>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

@stop

@section('js')
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <!-- DataTables Buttons -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <!-- JSZip -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <!-- PDFMake -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <!-- DataTables Buttons HTML5 -->
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
    
    $(function () {
    $("#datos").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'print',
            'pdfHtml5',
            'colvis'
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "print": "Imprimir",
                "colvis": "Visibilidad"
            }
        }
    });
});
    </script>
@stop
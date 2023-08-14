
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
                    <h4 class="mb-0">Contratos Registrados</h4>
                    <a href="{{ url('caja/contratos/registrar_contrato') }}" class="btn btn-primary">Registrar nuevo contrato</a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="mb-4">Realizar búsqueda por nombre, apellido, domicilio o número de contrato</h5>
                <table id="datos" class="table table-bordered table-striped">
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
                                    <button class="btn btn-success btn-sm"><i class="fa-solid fa-wallet"></i> Registrar abono </button>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    
@stop

@section('js')
<script>
    $(function () {
        $("#datos").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
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
                    "colvis": "Visibilidad"
                }
            }
        });
    });
    </script>
@stop
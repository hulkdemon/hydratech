
@extends('adminlte::page')

@section('title', 'Gestión de transacciones')

@section('content')
    <body> 
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif  
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                <h1>Administración de Contratos para condonaciones</h1>
                </div>
                <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Asignación de condonaciones</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{url ("admin/condonaciones/gestion_condonaciones")}}" type="button" class="btn btn-primary ">
                        <i class="fa-solid fa-eye"></i> Ver condonaciones solicitadas
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="mb-2">Asignación de condonaciones por administrador</h5>
                <table id="datos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th >Num. contrato</th>
                            <th>Nombre de la persona</th>
                            <th>Domicilio</th>
                            <th >Condonaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                        <tr>
                            <td style="width: 10px;">{{ $contrato->id_contrato }}</td>
                            <td style="width:20px;">{{ $contrato->numero_contrato }}</td>
                            <td style="width:400px;">{{ $contrato->nombre }} {{ $contrato->apellido }}</td>
                            <td style="width:400px;">{{ $contrato->domicilio }}</td>
                            <td style="width:160px;">
                                @if(isset($contrato) && auth()->user()->rol)
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#asignar_condonaciones{{ $contrato->id_contrato }}">
                                    <i class="fa-solid fa-hand-holding-dollar"></i> Asignar condonación
                                </button>
                            @else
                                @if(isset($contrato))
                                    <div class="alert alert-danger" role="alert">
                                        El usuario no tiene rol para asignar condonaciones.
                                    </div>
                                @endif
                            @endif
                            
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
    
    @foreach ($contratos as $contrato)
    @include('admin.condonaciones.asignar_condonaciones')
    @endforeach
    
@stop

@section('css')

@stop

@section('js')
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($contrato)

    @endisset
<script>
    $(function () {
    $("#datos").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "No hay registros de contratos",
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
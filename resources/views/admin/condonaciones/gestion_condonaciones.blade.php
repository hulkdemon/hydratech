@extends('adminlte::page')

@section('title', 'Solicitudes de condonaciones')

@section('content')
    <body>
        <br>
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
                <div class="col-sm-6">
                <h1>Registro y gestión de solicitudes de condonación</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Registro y gestión de condonaciones</li>
                </ol>
                </div>
            </div>
            </div>
        </section>
        <div class="card shadow">
          
        </div>
            <div class="container-fluid">
    <div class="row">
        <!-- Columna de izquierda pa condonaciones pendientes -->
        <div class="col-md-5">
            <div class="card-header bg-primary text-white">
                <h5 class=" font-weight-bold">Hay {{ $condonacionesPendientes }} solicitud(es) de condonaciones pendientes</h5>
              </div>
        <div class="card">
            <div class="card-header">
                @if ($condonaciones->where('estado', 'pendiente')->isEmpty())
                <h3 class="card-title">No hay condonaciones pendiente</h3>
                @else
            <h3 class="card-title">Registro de condonaciones pendientes</h3>
            @endif
            </div>
            <div id="accordion">
                @foreach ($condonaciones->where('estado', 'pendiente') as $index => $condonacion)
                <div class="card">
                    <div class="card-header" id="heading{{ $index }}">
                    <h3 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                        Condonación del "{{ $condonacion->porcentaje }}" %
                        </button>
                    </h3>
                    </div>
                    <div id="collapse{{ $index }}" class="collapse" aria-labelledby="heading{{ $index }}" data-parent="#accordion">
                    <div class="card-body">
                        <p>Pedido por: {{ $condonacion->contratos->nombre }}</p>
                        <p>Realizado por cajero: {{ $condonacion->usuarios->name }}</p>
                        <p>Motivo: {{ $condonacion->motivo }}</p>
                        <p>Fecha: {{ $condonacion->inicio_vigencia }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary mr-3" onclick="aceptarCondonacion('{{ route('caja.condonaciones.aceptar_condonacion', ['id_condonacion' => $condonacion->id_condonacion]) }}')">Aceptar</a>
                        <a href="#" class="btn btn-danger" onclick="rechazarCondonacion('{{ route('caja.condonaciones.rechazar_condonacion', ['id_condonacion' => $condonacion->id_condonacion]) }}')">Rechazar</a>
                    </div>                      
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
        <!-- Columna con tabla de registros de condonaciones aceptadas o rechazadas -->
        <div class="col-md-7">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title ">Registros de condonaciones procesadas</h3>
            </div>
            <div class="card-body p-3">
                
            <table id="datos" class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Registrado por:</th>
                    <th>Solicitado por:</th>
                    <th>Descuento</th>
                    <th>Estado</th>
                    <th class="text-center">Motivo</th>
                </tr>
                </thead>
                <tbody>
                    @if ($condonaciones->isEmpty())
                    <tr>
                        <td colspan="10">No hay condonaciones solicitadas</td>
                    </tr>
                    @else
                    @foreach ($condonaciones as $condonacion)
                    @if ($condonacion->estado === 'aprobada' || $condonacion->estado === 'rechazada')
                    <tr>
                        <td>{{$condonacion->id_condonacion}}</td>
                        <td>
                            @if ($condonacion->usuarios->rol->tipo === 'Admin')
                            admin: {{ $condonacion->usuarios->name }}
                        @elseif ($condonacion->usuarios->rol->tipo === 'Caja')
                            cajero: {{ $condonacion->usuarios->name }}
                        @endif
                        </td>                       
                        <td>{{$condonacion->contratos->nombre}}</td>
                        <td>{{$condonacion->descuento}}</td>
                        <td>
                            @if ($condonacion->estado ==='aprobada')
                            <h6 class="text-success">Aprobada</h6>
                            @else
                                <h6 class="text-danger">Rechazada</h6>
                            @endif
                        </td>
                        <td>
                            <a href="#" data-toggle="popover" title="Motivo" data-content="{{$condonacion->motivo}}">
                                Ver motivo
                            </a>                    
                        </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </div>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@isset($condonacion)

<script>
    function aceptarCondonacion(route) {
        Swal.fire({
            title: 'Alerta',
            text: '¿Estás seguro de aceptar esta condonación?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, aceptar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = route;
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
            trigger: 'click', 
            placement: 'top', 
            html: true 
        });
    });
</script>
<script>
    function rechazarCondonacion(route) {
        Swal.fire({
            title: 'Alerta',
            text: '¿Estás seguro de rechazar esta condonación?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, rechazar',
            cancelButtonText: 'Cancelar',
            
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = route;
            }
        });
    }
</script>

@endisset
<script>
  $(function () {
    $("#datos").DataTable({
        "responsive": true,
        "autoWidth": false,
        "displayLength": 5,
        "info": false, 
        "bLengthChange": false,
        "language": {
            "sProcessing": "Procesando...",
            "sZeroRecords": "No se encontraron condonaciones",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
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

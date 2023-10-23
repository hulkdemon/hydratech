
@extends('adminlte::page')

@section('title', 'Historial de cobros del contrato a nombre de ' . $contrato->nombre)

@section('content')
    <body> 
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Cobros activos registrados al contrato</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Vistas de cobros</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabla_datos-tab" data-toggle="tab" href="#tabla_datos" role="tab" aria-controls="tabla_datos" aria-selected="true">Ver cobros activos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabla_fechas-tab" data-toggle="tab" href="#tabla_fechas" role="tab" aria-controls="tabla_fechas" aria-selected="false">Ver histórico de cobros</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <!-- Tabla para filtrar datos entre número contrato o nombre -->
                    <div class="tab-pane fade show active" id="tabla_datos" role="tabpanel" aria-labelledby="tabla_datos-tab">
                        <table id="cobros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <h5>Funciones para los cobros registrados en el contrato</h5>
                                </div>
                                    <th>#</th>
                                    <th>Folio del cobro</th>
                                    <th>Fecha del cobro</th>
                                    <th>Monto pagado</th>
                                    <th>IVA</th>
                                    <th>UMA </th>
                                    <th>Condonaciones</th>
                                    <th>Conceptos</th>
                                    <th>Total a pagar</th>
                                    <th class="text-center">Datos del cobro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cobros as $cobro)
                                <tr>
                                    <td>{{ $cobro->id_cobro}}</td>
                                    <td>{{ $cobro->folio }}</td>
                                    <td>{{ $cobro->fecha_cobro}}</td>
                                    <td>$ {{ $cobro->monto }}</td>
                                    <td>{{ $cobro->iva }} %</td>
                                    <td>{{ $cobro->uma->valor }} %</td>
                                    <td>
                                        @if ($cobro->condonaciones->count() > 0)
                                            @foreach ($cobro->condonaciones as $condonacion)
                                                {{ $condonacion->descuento }}% <br>
                                            @endforeach
                                        @else
                                            No se usaron condonaciones
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cobro->conceptos->count() > 0)
                                        @foreach ($cobro->conceptos as $concepto)
                                            ${{ $concepto->precio }}<br>
                                        @endforeach
                                    @else
                                        No hubo conceptos
                                    @endif
                                    </td>                                    
                                    <td>$ {{ $cobro->total}}</td>
                                    <td>
                                        @if(isset($contrato))
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa-solid fa-circle-info"></i> Opciones del cobro
                                            </button>
                                                <ul class="dropdown-menu">
                                                <li class="dropdown-item"> 
                                                    <a href="{{ route('caja.cobros.recibo', ['id_cobro' => $cobro->id_cobro]) }}" >
                                                        <i class="fa-solid fa-credit-card"></i> Ver recibo
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{ url('caja/cobros/'.$contrato->id_contrato.'/ver_cobros')}}" >
                                                        <i class="fa-solid fa-eye"></i> Ver factura
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{ url('caja/cobros/'.$contrato->id_contrato.'/ver_cobros')}}" >
                                                        <i class="fa-solid fa-ban"></i> Desactivar cobro
                                                    </a>
                                                </li>
                                                </ul>                
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach           
                            </tbody> 
                        </table>
                    </div>
                    <!-- Tabla para filtrar datos entre fechas -->
                    <div class="tab-pane fade" id="tabla_fechas" role="tabpanel" aria-labelledby="tabla_fechas-tab">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody><tr><h5>Seleccione las fechas para filtrar el histórico de cobros</h5>
                                <td>Fecha Inicio:</td>
                                <td><input type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td>Fecha Fin:</td>
                                <td><input type="text"  id="max" name="max"></td>
                            </tr>
                        </tbody></table><br>
                        <table id="historico" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <h5>Funciones para el histórico</h5>
                                </div>
                                    <th>#</th>
                                    <th>Folio del cobro</th>
                                    <th>Fecha del cobro</th>
                                    <th>Monto pagado</th>
                                    <th>IVA</th>
                                    <th>UMA </th>
                                    <th>Condonaciones</th>
                                    <th>Conceptos</th>
                                    <th>Total a pagar</th>
                                    <th class="text-center">Datos del cobro</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cobros as $cobro)
                                <tr>
                                    <td>{{ $cobro->id_cobro}}</td>
                                    <td>{{ $cobro->folio }}</td>
                                    <td>{{ $cobro->fecha_cobro}}</td>
                                    <td>$ {{ $cobro->monto }}</td>
                                    <td>{{ $cobro->iva }} %</td>
                                    <td>{{ $cobro->uma->valor }} %</td>
                                    <td>
                                        @if ($cobro->condonaciones->count() > 0)
                                            @foreach ($cobro->condonaciones as $condonacion)
                                                {{ $condonacion->descuento }}% <br>
                                            @endforeach
                                        @else
                                            No se usaron condonaciones
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cobro->conceptos->count() > 0)
                                        @foreach ($cobro->conceptos as $concepto)
                                            ${{ $concepto->precio }} <br>
                                        @endforeach
                                    @else
                                        No hubo conceptos
                                    @endif
                                    </td>                                    
                                    <td>$ {{ $cobro->total}}</td>
                                    <td>
                                        @if(isset($contrato))
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa-solid fa-circle-info"></i> Opciones del cobro
                                            </button>
                                                <ul class="dropdown-menu">
                                                <li class="dropdown-item"> 
                                                    <a href="{{ route('caja.cobros.registrar_cobro', ['id_contrato' => $contrato->id_contrato]) }}" >
                                                        <i class="fa-solid fa-credit-card"></i> Ver recibo
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{ url('caja/cobros/'.$contrato->id_contrato.'/ver_cobros')}}" >
                                                        <i class="fa-solid fa-eye"></i> Ver factura
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{ url('caja/cobros/'.$contrato->id_contrato.'/ver_cobros')}}" >
                                                        <i class="fa-solid fa-ban"></i> Desactivar cobro
                                                    </a>
                                                </li>
                                                </ul>                
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach           
                            </tbody>            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    @include('caja.datos_fiscales.registrar_datos_fiscales')

@stop

@section('css')
<!-- DataTables Functions -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!--DISEÑOS PARA LAS FECHAS-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
@stop

@section('js')
<script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<!--FILTRADO ENTRE FECHAS SCRIPT-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


<!---nada--->
    
<script>
    $(function () {
        var table = $("#cobros").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "dom": '<"top"Bfi>rt<"bottom"lp><"clear">',
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible' 
                },
                text: 'Exportar a Excel',
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible' 
                },
                text: 'Exportar a PDF',
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible' 
                },
                text: 'Imprimir cobros',
            },
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
            "search": "Busque el cobro por folio"
        }
        });
    });
</script>

<script>
    let minDate, maxDate;
    let table = null;

    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[2]); 

        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    minDate = new DateTime('#min', {
        format: 'D [de] MMMM [de] YYYY',
        locale: 'es'
    });
    maxDate = new DateTime('#max', {
        format: 'D [de] MMMM [de] YYYY',
        locale: 'es'
    });

    table = $("#historico").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "dom": '<"top"Bfi>rt<"bottom"lp><"clear">',
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                text: 'Exportar a Excel',
                className: 'btn btn-success' 
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                },
                text: 'Exportar a PDF', 
                className: 'btn btn-danger' 
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                },
                text: 'Imprimir histórico', 
                className: 'btn btn-primary' 
            },
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        "searching": false
    });

    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => table.draw());
    });

</script>

@stop


@extends('adminlte::page')

@section('title', 'Contratos registrados')

@section('content')
    <body> 
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Contratos registrados</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Vistas de contratos</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabla_datos-tab" data-toggle="tab" href="#tabla_datos" role="tab" aria-controls="tabla_datos" aria-selected="true">Filtrar por datos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabla_fechas-tab" data-toggle="tab" href="#tabla_fechas" role="tab" aria-controls="tabla_fechas" aria-selected="false">Filtrar entre fechas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent">
                    <!-- Tabla para filtrar datos entre número contrato o nombre -->
                    <div class="tab-pane fade show active" id="tabla_datos" role="tabpanel" aria-labelledby="tabla_datos-tab">
                        <table id="contratos" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <h5>Funciones para los contratos</h5>
                                    <th>#</th>
                                    <th>Número del contrato</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Domicilio</th>
                                    <th>Correo electrónico</th>
                                    <th>Fecha vigencia</th>
                                    <th>Tipo de contrato</th>
                                    <th>Editar Contrato</th>
                                    <th>Registrar datos fiscales</th>
                                </tr>
                            </thead>
                    <tbody>
                        @if ($contratos->isEmpty())
                            <tr>
                                <td colspan="10">No hay contratos registrados</td>
                            </tr>
                        @else
                            @foreach ($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->id_contrato}}</td>
                                    <td>{{ $contrato->numero_contrato }}</td>
                                    <td>{{ $contrato->nombre }}</td>
                                    <td>{{ $contrato->apellido }}</td>
                                    <td>{{ $contrato->domicilio }}</td>
                                    @if ($contrato->correo_electronico)
                                        <td>{{ $contrato->correo_electronico}}</td>
                                    @else
                                        <td>No hay correo registrado</td>
                                    @endif
                                    <td>{{ $contrato->fecha_vigencia }}</td>
                                    <td>{{ $contrato->tipos_contratos->nombre}}</td>
                                    <td class="exclude-column"><a href="{{ url('caja/contratos/'.$contrato->id_contrato.'/editar_contrato')}}"  class="btn btn-warning ">Editar</a></td>                     
                                    <td class="exclude-column">  
                                        @if(isset($contrato))
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrar_datos_fiscales{{ $contrato->id_contrato }}">
                                                Registrar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>            
                        </table>
                    </div>
                    <!-- Tabla para filtrar datos entre fechas -->
                    <div class="tab-pane fade" id="tabla_fechas" role="tabpanel" aria-labelledby="tabla_fechas-tab">
                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody><tr><h5>Filtrar entre fechas los contratos</h5>
                                <td>Fecha Inicio:</td>
                                <td><input type="text" id="min" name="min"></td>
                            </tr>
                            <tr>
                                <td>Fecha Fin:</td>
                                <td><input type="text"  id="max" name="max"></td>
                            </tr>
                        </tbody></table><br>
                        <table id="contratos_fechas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <h5>Funciones para los contratos</h5>
                                    <th>#</th>
                                    <th>Número del contrato</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Domicilio</th>
                                    <th>Correo electrónico</th>
                                    <th>Fecha vigencia</th>
                                    <th>Tipo de contrato</th>
                                    <th>Editar Contrato</th>
                                    <th>Registrar datos fiscales</th>
                                </tr>
                            </thead>
                        <tbody>
                        @if ($contratos->isEmpty())
                            <tr>
                                <td colspan="10">No hay contratos registrados</td>
                            </tr>
                        @else
                            @foreach ($contratos as $contrato)
                                <tr>
                                    <td>{{ $contrato->id_contrato}}</td>
                                    <td>{{ $contrato->numero_contrato }}</td>
                                    <td>{{ $contrato->nombre }}</td>
                                    <td>{{ $contrato->apellido }}</td>
                                    <td>{{ $contrato->domicilio }}</td>
                                    @if ($contrato->correo_electronico)
                                        <td>{{ $contrato->correo_electronico}}</td>
                                    @else
                                        <td>No hay correo registrado</td>
                                    @endif
                                    <td>{{ $contrato->fecha_vigencia }}</td>
                                    <td>{{ $contrato->tipos_contratos->nombre}}</td>
                                    <td class="exclude-column"><a href="{{ url('caja/contratos/'.$contrato->id_contrato.'/editar_contrato')}}"  class="btn btn-warning ">Editar</a></td>                     
                                    <td class="exclude-column">  
                                        @if(isset($contrato))
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrar_datos_fiscales{{ $contrato->id_contrato }}">
                                                Registrar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
@if ($contratos->isEmpty())

@else

<script>
    let minDate, maxDate;
    let table = null;

    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[6]); 

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

    table = $("#contratos_fechas").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "dom": '<"top"Bfi>rt<"bottom"lp><"clear">',
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)'
                },
                text: 'Exportar a Excel',
                className: 'btn btn-success' 
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)'
                },
                text: 'Exportar a PDF', 
                className: 'btn btn-danger' 
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)'
                },
                text: 'Imprimir', 
                className: 'btn btn-primary' 
            },
        ],
        "columnDefs": [
            {
                "targets": [8, 9],
                "className": "exclude-column"
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });

    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => table.draw());
    });

</script>

<script>
    $(function () {
        var table = $("#contratos").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "dom": '<"top"Bfi>rt<"bottom"lp><"clear">',
        "buttons": [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)' 
                },
                text: 'Exportar a Excel',
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)' 
                },
                text: 'Exportar a PDF',
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible:not(.exclude-column)' 
                },
                text: 'Imprimir',
            },
            'colvis'
        ],
        "columnDefs": [
            {
                "targets": [8, 9], 
                "className": "exclude-column" 
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });

    table.buttons(['.buttons-pdf']).nodes().each(function (button) {
        $(button).removeClass('exclude-column');
    });
});
    </script>

    
@endif





@stop

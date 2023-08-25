
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
                <div class="card-body">
                    <h5 class="m-1">Opciones para los contratos</h5>
                    <table id="contratos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
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
              <!-- /.card-body -->
            </div>
    </body>
    </html>
    @include('caja.datos_fiscales.registrar_datos_fiscales')

@stop

@section('css')
<!-- DataTables Functions -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!--DISEÑOS PARA LAS FECHAS 
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
-->
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

<!--FILTRADO ENTRE FECHAS SCRIPT
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
-->

<!---
<script>
    let minDate, maxDate;

    // Custom filtering function which will search data in column four between two values
    DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[4]);

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

    // Create date inputs
    minDate = new DateTime('#min', {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime('#max', {
        format: 'MMMM Do YYYY'
    });

    // DataTables initialisation
    let table = new DataTable('#contratos');

    // Refilter the table
    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => table.draw());
    });
</script>
--->


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
                    columns: ':visible' // Selecciona todas las columnas excepto las marcadas con la clase 'exclude-column'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible' // Selecciona todas las columnas excepto las marcadas con la clase 'exclude-column'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible' // Selecciona todas las columnas excepto las marcadas con la clase 'exclude-column'
                }
            },
            'colvis'
        ],
        "columnDefs": [
            {
                "targets": [8, 9], // Índices de las columnas de "Editar Contrato" y "Registrar datos fiscales"
                "className": "exclude-column" // Agrega la clase 'exclude-column' a estas columnas
            }
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros", // Cambia MENU a _MENU_
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", // Cambia START, END, TOTAL
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)", // Cambia MAX
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

    // Personaliza la exportación de PDF para que se muestren los botones en la tabla
    table.buttons(['.buttons-pdf']).nodes().each(function (button) {
        $(button).removeClass('exclude-column');
    });
});
    </script>







@stop

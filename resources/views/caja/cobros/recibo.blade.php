@extends('adminlte::page')

@section('title', 'Hydratech')

@section('content')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="center col-12">
                <!-- Main content -->
                <div id="contenedorParaImprimir">
                <div class="invoice p-3 mb-3 printable-content">
                <!-- title row -->
                <div class="row">
                    <div class="col-4">
                        <div class="flex justify-center">
                            <img src="{{ asset('storage/Hydratech_blanco.png') }}" width="200" alt="">
                        </div>
                    </div>
                    <div class="col-8">
                        <div style="text-align: center; background-color: #007bff; color: #fff; padding: 10px; border: 1px solid #ddd;">
                            <h2 style="font-size: 36px; font-weight: bold; margin: 0;">Recibo de agua</h2>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                    De
                    <address>
                        <strong>Cajero: {{$cobros->usuarios->name}}</strong><br>
                        Correo: {{$cobros->usuarios->email}}<br>
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    Para
                    <address>
                        <strong>{{ $cobros->contratos->nombre . ' ' . $cobros->contratos->apellido }}</strong><br>
                        Domicilio: {{$cobros->contratos->domicilio}}<br>
                        @if ($cobros->contratos->correo_electronico)
                            Correo: {{ $cobros->contratos->correo_electronico }}<br>
                        @else
                            No registró correo electrónico.
                        @endif
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    <b>Recibo: #{{$cobros->id_cobro}}</b><br>
                    <br>
                    <b>Num. contrato:</b> {{$cobros->contratos->numero_contrato}}<br>
                    <b>Fecha del cobro::</b> {{$cobros->fecha_cobro}}<br>
                    <b>Folio:</b> {{$cobros->folio}}
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <br>
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>Responsable del contrato:</th>
                        <th>Tipo de contrato</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>{{ $cobros->contratos->nombre . ' ' . $cobros->contratos->apellido }}</td>
                        <td>{{$cobros->contratos->tipos_contratos->nombre}}</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <br><br>
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        @if ($cobros->conceptos->count() > 0)
                        <p class="lead">Conceptos de:</p>
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        @foreach ($cobros->conceptos as $concepto)
                        <b>La persona tiene un concepto de  
                        ${{ $concepto->precio}} pesos, debido a:
                        {{ $concepto->descripcion}}</b><br>
                    @endforeach 
                    </p>
                    @endif
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Monto total:</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{$cobros->monto}} $</td>
                        </tr>
                        <tr>
                            <th>IVA:</th>
                            <td>{{$cobros->iva}}</td>
                        </tr>
                        <tr>
                            <th>UMA mensual:</th>
                            <td>{{ $uma_mes = $cobros->uma->valor * 30.4 }} </td>
                        </tr>
                        @if ($cobros->condonaciones->count() > 0)
                        @foreach ($cobros->condonaciones as $condonacion)
                            <tr>
                                <th>Condonación usada del:</th>
                                <td colspan="2">
                                    {{ $condonacion->porcentaje }} %
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        <th>Total:</th>
                        <td>{{$cobros->total}} $</td>
                        </tr>
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <a href="javascript:void(0);" id="imprimirBtn" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                    </div>
                </div>
                </div>
            </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
    <!-- Control Sidebar -->
@stop

@section('css')

@stop

@section('js')
<script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Esperar a que se cargue completamente la página
    window.onload = function () {
        const imprimirBtn = document.getElementById("imprimirBtn");

        imprimirBtn.addEventListener("click", function () {
            window.print(); // Imprimir la página actual
        });
    };
</script>
@if (!$facturaGenerada && isset($cobros->contratos->correo_electronico))
<script>
    Swal.fire({
        title: '¿Deseas generar una factura electrónica?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            // Obtener el valor de id_cobro
            const idCobro = '{{ $cobros->id_cobro }}';

            // Redirigir a la página de factura en una nueva ventana o pestaña
            const url = `/caja/cobros/${idCobro}/factura`;
            window.open(url, '_blank');
        }
    });
</script>
@endif



@stop
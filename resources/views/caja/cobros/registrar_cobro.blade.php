@extends('adminlte::page')

@section('title', 'Realizar cobros')

@section('content')
    <body>
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Registro de cobros al contrato de {{$contrato->nombre}}</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Registro de cobros</li>
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('caja.cobros.ver_cobros') }}" class="btn btn-primary">
                            Ver cobros realizados
                        </a>
                        </div>
                    </div>
                </div>
            </section>


            
            <div class="row mt-3">
                <div class="col-md-6">
                    @if ($creditosActivos->count() > 0)
                        <div class="alert alert-success" >
                            <strong>Créditos Activos:</strong>
                            <ul class="mb-0">
                                @foreach ($creditosActivos as $credito)
                                    <li>Monto: {{$credito->monto}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($cobros_conceptos->count() > 0)
                        <div class="alert alert-warning" >
                            <strong>Multas Pendientes:</strong>
                            <ul class="mb-0">
                                @foreach ($cobros_conceptos as $cobro_concepto)
                                    <li>Monto: {{$cobro_concepto->concepto->precio}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    @if ($uma)
                        <div class="alert alert-primary">
                            <strong>UMA del año actual:</strong>
                            <ul class="mb-0">
                                <li>Valor: {{$uma->valor}} %</li>
                            </ul>
                        </div>
                    @endif
                </div>
                
                <div class="col-md-6">
                    @if ($condonacionesVigentes->count() > 0)
                        <div class="alert alert-info" >
                            <strong>Condonaciones Activas:</strong>
                            <ul class="mb-0">
                                @foreach ($condonacionesVigentes as $condonacion)
                                    <li>Condonación: {{$condonacion->descuento}} %</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            
        
                <form id="formulario_cobros" action="{{url('caja/cobros')}}" method="post">
                    @csrf
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del cobro a registrar</h3>
                        </div>
            <div class="card-body">
                <input type="hidden" name="id_contrato" value="{{ $contrato->id_contrato }}">
                <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">
                <input type="hidden" id="uma_valor" value="{{ $uma ? $uma->valor : '' }}">
                
                <!-- Fecha del cobro -->
                <div class="form-group">
                    <label for="fecha_cobro">Fecha del cobro:</label>
                    <input type="date" name="fecha_cobro" class="form-control" id="fecha_cobro" value="{{old('fecha_cobro')}}">
                </div>
                
                <!-- Monto a cobrar -->
                <div class="form-group">
                    <label for="monto">Monto a cobrar:</label>
                    <div class="input-group">
                        <input type="number" name="monto" class="form-control" id="monto" value="{{old('monto')}}" placeholder="Ingrese el monto a cobrar">
                        <div class="input-group-append">
                            <button type="button" id="calcular_btn" class="btn btn-primary">Calcular</button>
                        </div>
                    </div>
                </div>
                
                <!-- Uma activo -->
                <div class="form-group">
                @if ($uma)
                    <label for="uma_valor">Uma del año actual:</label>
                    <input type="text" class="form-control" disabled id="uma_valor" name="uma_valor" value="{{ $uma->valor }} %">
                @endif
                </div>

                <!-- Créditos Activos -->
                <div class="form-group">
                @if ($creditosActivos->count() > 0)
                <label for="creditos_total">Créditos (abono) disponibles:</label>
                    <input type="text" class="form-control" disabled id="creditos_total" name="creditos_total" value="{{ $creditosActivos->sum('monto') }}">
                @endif
                </div>

                <!-- Multas Pendientes por Pagar -->
                <div class="form-group">
                @if ($cobros_conceptos->count() > 0)
                <label for="multas_total">Total por multas pendientes:</label>
                    <input type="text" class="form-control" disabled id="multas_total" name="multas_total" value="{{ $cobros_conceptos->sum('concepto.precio') }}">
                @endif
                </div>

                <!-- Condonaciones Activas -->
                <div class="form-group">
                @if ($condonacionesVigentes->count() > 0)
                <label for="condonaciones_total">Total descuento en condonaciones vigentes:</label>
                    <input type="text" class="form-control" disabled id="condonaciones_total" name="condonaciones_total" value="{{ $condonacionesVigentes->sum('descuento') }} %">
                @endif
                </div>

                <!-- IVA -->
                <div class="form-group">
                    <label for="iva">IVA:</label>
                    <input type="text" disabled name="iva" class="form-control" id="iva" name="iva" value="{{old('iva')}}" placeholder="IVA calculado al ingresar el monto">
                </div>
                
                <!-- Total -->
                <div class="form-group">
                    <label for="total">Total:</label>
                    <input type="number" disabled name="total" class="form-control" id="total" name="total" >
                </div>
                
                <div class="row">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Registrar</button>
                        <br>
                    </div>
                    <div class="col-lg-3">
                        <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-cancel"></i> Cancelar</button>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Obtener los elementos de los campos
            var precioInput = $('#monto');
            var ivaInput = $('#iva');
            var totalInput = $('#total');
            var creditosTotalInput = $('#creditos_total');
            var multasTotalInput = $('#multas_total');
            var condonacionesTotalInput = $('#condonaciones_total');
            
            // Función para calcular el total
            function calcularTotal() {
                var precio = parseFloat(precioInput.val()); // Convertir a número
                
                if (!isNaN(precio)) {
                    var iva = precio * 0.16; // 16% de IVA
                    
                    // Calcular los totales de créditos, multas y condonaciones
                    var creditosTotal = parseFloat(creditosTotalInput.val()) || 0;
                    var multasTotal = parseFloat(multasTotalInput.val()) || 0;
                    var condonacionesTotal = parseFloat(condonacionesTotalInput.val()) || 0;
                    
                    // Calcular el total a pagar incluyendo créditos
                    var total = precio + iva + multasTotal + condonacionesTotal;
                    
                    // Verificar si los créditos superan el total
                    if (creditosTotal > total) {
                        // Mostrar alerta
                        alert("Los créditos superan al total a pagar. El crédito restante es: " + (creditosTotal - total));
                        
                        // Establecer el total en cero
                        total = 0;
                    } else {
                        // Restar los créditos al total
                        total -= creditosTotal;
                    }
                    
                    // Actualizar los campos de iva y total con los nuevos valores
                    ivaInput.val(iva.toFixed(2)); // Redondear a 2 decimales
                    totalInput.val(total.toFixed(2)); // Redondear a 2 decimales
                } else {
                    // Si el valor no es válido, restablecer los campos de iva y total
                    ivaInput.val('');
                    totalInput.val('');
                }
            }
            
            // Agregar el evento click al botón Calcular
            $('#calcular_btn').on('click', function() {
                calcularTotal();
            });
        });
    </script>
    

    <script>
    $(document).ready(function () {
    $('#formulario_usuarios').submit(function (e) {
        e.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                        });
                        $('#formulario_usuarios')[0].reset();
                    } else {
                        let errorHtml = '<ul>';
                        $.each(response.errors, function (key, value) {
                            errorHtml += '<li>' + value + '</li>';
                        });
                        errorHtml += '</ul>';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de validación',
                            html: errorHtml,
                        });
                    }
                },
            });
        });
    });
    </script>
@stop

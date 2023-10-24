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
                </div>
            </section>
            <div class="row mt-3">
                <div class="col-md-6">
                    @if ($creditosActivos->count() > 0)
                        <div class="alert alert-success" >
                            <strong>Créditos Activos:</strong>
                            <ul class="mb-0">
                                @php
                                $totalMonto = $creditosActivos->sum('monto');
                                @endphp
                            <li>Monto Total: {{$totalMonto}}</li>
                            </ul>
                        </div>
                    @else
                        <div class="alert alert-success" >
                            <strong>No hay créditos activos:</strong>
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
                    @else
                    <div class="alert alert-warning" >
                        <strong>No hay multas activas:</strong>
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
                        @else 
                        <div class="alert alert-primary">
                            <strong>No hay condonaciones activas:</strong>
                        </div>
                    @endif
                </div>
            </div>
            @if (!$uma || $uma->fecha_vigencia < now())
            <div class="alert alert-danger">
                <h3>UMA requerida: Por favor, registra una UMA antes de continuar.
                <a href="{{ url('admin/uma/registrar_uma') }}" class="btn  btn-primary">Registrar UMA</a></h3>
            </div>
            @else
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
                <!-- Monto a cobrar -->
            <div class="form-group">
                <label for="monto">Monto a cobrar:</label>
                <div class="input-group">
                    <input type="number" name="monto" class="form-control" id="monto" onkeypress="return valideKey(event);" value="{{old('monto')}}" placeholder="Ingrese el monto a cobrar" min="1" pattern="^[1-9]\d*(\.\d+)?$" >
                <div class="input-group-append">
                    <button type="button" id="calcular_btn" class="btn btn-primary">Calcular</button>
                </div>
                </div>
                </div>
                <!-- Uma activo -->
                <div class="form-group">
                @if ($uma)
                <input type="hidden" name="id_uma" value="{{ $uma->id_uma }}">
                    <label for="uma_valor">Uma del año actual (valor sumado por mes):</label>
                    <input type="text" class="form-control" readonly id="uma_valor" name="uma_valor" value="{{ $uma_mes =$uma->valor * 30.4 }} %" >
                @endif
                </div>
                <!-- Créditos Activos -->
                <div class="form-group">
                @if ($creditosActivos->count() > 0)
                <label for="creditos_total">Créditos (abono) disponibles:</label>
                    <input type="text" class="form-control" readonly  id="creditos_total" name="creditos_total" value="{{ $creditosActivos->sum('monto') }}">
                @endif
                </div>
                <!-- Multas Pendientes por Pagar -->
                <div class="form-group">
                @if ($cobros_conceptos->count() > 0)
                <label for="multas_total">Total por multas pendientes:</label>
                    <input type="text" class="form-control" readonly  id="multas_total" name="multas_total" value="{{ $cobros_conceptos->sum('concepto.precio') }}">
                @endif
                </div>
                <!-- Condonaciones Activas -->
                <div class="form-group">
                @if ($condonacionesVigentes->count() > 0)
                <label for="condonaciones_total">Total descuento en condonaciones vigentes:</label>
                    <input type="text" class="form-control" readonly  id="condonaciones_total" name="condonaciones_total" value="{{ $condonacionesVigentes->sum('descuento') }} %">
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
                    <input type="number" disabled name="total" class="form-control" id="total" required name="total" >
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <button type="submit" id="registrarCobroBtn" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Registrar cobro</button>
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
    @endif
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
            var umaValorInput = $('#uma_valor'); // Campo para el valor de la UMA
            
            // Función para calcular el total
            function calcularTotal() {
                var precio = parseFloat(precioInput.val()); // Convertir a número
                
                if (!isNaN(precio)) {

                    if (precio <= 0 ) {
                    // Mostrar un mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Monto Negativo',
                        text: 'El monto no puede ser negativo o cero.',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    });
                    return;
                }

                    var iva = precio * 0.16; // 16% de IVA
                    
                    // Calcular los totales de créditos, multas y condonaciones
                    var creditosTotal = parseFloat(creditosTotalInput.val()) || 0;
                    var multasTotal = parseFloat(multasTotalInput.val()) || 0;
                    var condonacionesPorcentaje = parseFloat(condonacionesTotalInput.val()) || 0;
                    var condonacionesTotal = (precio * condonacionesPorcentaje) / 100;

                    // Obtener el valor de la UMA
                    var valorUMA = parseFloat(umaValorInput.val()) || 0;
                    
                    // Calcular el valor mensual de la UMA
                    var valorUMAMensual = valorUMA * 30.4;
                    
                    // Calcular el total a pagar incluyendo créditos, multas, condonaciones y UMA
                    var total = precio + iva + multasTotal - condonacionesTotal + valorUMAMensual;
                    
                    // Verificar si los créditos superan el total
                    if (creditosTotal > total) {
                        // Mostrar alerta
                        Swal.fire({
                        icon: 'warning',
                        title: 'Créditos Exceden Total',
                        text: 'Los créditos superan al total a pagar. El crédito restante es: ' + (creditosTotal - total),
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                            });    
                        } else {
                          // Restar los créditos al total
                        total -= creditosTotal;
                    }
                    
                    // Actualizar los campos de iva y total con los nuevos valores
                    ivaInput.val(iva.toFixed(2)); // Redondear a 2 decimales
                    totalInput.val(total.toFixed(2)); // Redondear a 2 decimales
                } else {
                    // Si el valor no es válido, restablecer los campos de iva, total y UMA
                    ivaInput.val('');
                    totalInput.val('');
                }
            }
            // Agregar el evento click al botón Calcular
            $('#calcular_btn').on('click', function() {
            calcularTotal();
            });
            // Agregar el evento submit al formulario
            $('#formulario_cobros').on('submit', function() {
                // Verificar si el campo de UMA tiene valor
                var umaValor = umaValorInput.val();
                if (!umaValor) {
                    // Mostrar alerta
                    Swal.fire({
                        icon: 'error',
                        title: 'UMA requerida',
                        text: 'Por favor, registra una UMA antes de continuar.',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    });
                    return false;
                }
                var totalValue = parseFloat(totalInput.val());
                if (isNaN(totalValue) || totalValue === 0) {
                    // Mostrar alerta
                    Swal.fire({
                        icon: 'error',
                        title: 'Total no calculado',
                        text: 'Por favor, calcula el total antes de registrar.',
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    });  
                    return false; 
                }
            });
            $('#registrarCobroBtn').on('click', function() {
        Swal.fire({
            title: '¿Estás seguro de realizar este cobro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir a la ruta de registro del cobro
                $('#formulario_cobros').submit();
            }
        });

        // Evitar que el botón realice la acción por defecto
        return false;
    });
        });
        function valideKey(evt){
            
            // code is the decimal ASCII representation of the pressed key.
            var code = (evt.which) ? evt.which : evt.keyCode;
            
            if(code==8) { // backspace.
            return true;
            } else if(code>=48 && code<=57) { // is a number.
            return true;
            } else{ // other keys.
            return false;
            }
                }
</script>
@stop

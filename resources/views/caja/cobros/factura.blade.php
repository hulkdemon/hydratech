<!DOCTYPE html>
<html>
<head>
    <title>Factura de Cobro</title>
   
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
        .header {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .invoice-details {
            margin-top: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .customer-details {
            float: left;
            width: 50%;
        }
        .invoice-number {
            text-align: right;
        }
        .invoice-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        .logo {
            text-align: center;
        }
        .logo img {
            max-width: 100%;
        }
        .invoice-title {
            font-size: 36px;
            font-weight: bold;
            margin: 0;
        }
        .invoice-info {
            display: flex;
        }
        .invoice-col {
            flex: 1;
            padding: 10px;
        }
        .customer-address {
            font-weight: bold;
        }
        .table-responsive {
            width: 100%;
        }
        .table table {
            width: 100%;
            border-collapse: collapse;
        }
        .table table th, .table table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .table table th {
            background-color: #007bff;
            color: #fff;
        }
        .lead {
            font-size: 16px;
            font-weight: bold;
        }
        .well {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .text-muted {
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="logo">
            <img src="{{ public_path('storage/Hydratech_blanco.png') }}" alt="">
        </div>
        <div class="header">
            <h2 class="invoice-title">Factura de cobro</h2>
        </div>
        <div class="invoice-details">
            <div class="invoice-info">
                <div class="invoice-col">
                    <p class="customer-address">De</p>
                    <address>
                        <strong>Cajero: {{$cobros->usuarios->name}}</strong><br>
                        Correo: {{$cobros->usuarios->email}}<br>
                    </address>
                </div>
                <div class="invoice-col">
                    <p class="customer-address">Para</p>
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
                <div class="invoice-col invoice-number">
                    <b>Recibo: #{{$cobros->id_cobro}}</b><br>
                    <b>Num. contrato:</b> {{$cobros->contratos->numero_contrato}}<br>
                    <b>Fecha del cobro:</b> {{$cobros->fecha_cobro}}<br>
                    <b>Folio:</b> {{$cobros->folio}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Responsable del contrato</th>
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
        </div>
        <div class="row">
            <div class="col-6">
                @if ($cobros->conceptos->count() > 0)
                    <p class="lead">Conceptos de:</p>
                    <p class="text-muted well" style="margin-top: 10px;">
                        @foreach ($cobros->conceptos as $concepto)
                            <b>La persona tiene un concepto de ${{ $concepto->precio}} pesos, debido a: {{ $concepto->descripcion}}</b><br>
                        @endforeach 
                    </p>
                @endif
            </div>
            <div class="col-6">
                <p class="lead">Monto total:</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal</th>
                            <td>{{$cobros->monto}} $</td>
                        </tr>
                        <tr>
                            <th>IVA</th>
                            <td>{{$cobros->iva}}</td>
                        </tr>
                        <tr>
                            <th>UMA mensual</th>
                            <td>{{ $uma_mes = $cobros->uma->valor * 30.4 }} </td>
                        </tr>
                        @if ($cobros->condonaciones->count() > 0)
                            @foreach ($cobros->condonaciones as $condonacion)
                                <tr>
                                    <th>Condonación usada del</th>
                                    <td colspan="2">
                                        {{ $condonacion->porcentaje }} %
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <th>Total</th>
                        <td>{{$cobros->total}} $</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

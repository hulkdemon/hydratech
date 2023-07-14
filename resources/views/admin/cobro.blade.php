@extends('adminlte::page')

@section('title', 'HydraTech')

@section('content_header')
    <h1>HydraTech</h1>
@stop

@section('content')
    <p>Pagina Caja Cobros HydraTech.</p>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos de Usuario</h3>
                        </div>

            <div class="card-body">
<label>Numero de contrato</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                            </div>
                            <input type="number" class="form-control" placeholder="No. Contrato">
                        </div>

<label>Fecha de cobro</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

<label>Cantidad</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" disabled>
                            <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                            </div>
                        </div>
<br>
<label>Encargado del pago</label>
                        <div class="input-group mb-12">
                            <div class="input-group-prepend">
                            <span class="input-group-text">*</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Cajero">
                        </div>
                    <br>
                        <div class="form-group text-center" >
                        <div class="input-group input-group-sm align-middle text-center">
                            <div class="input-group-prepend" >
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
Navegar
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item"><a href="#">Asignar Condonaciones</a></li>
                                <li class="dropdown-item"><a href="#">Busqueda de Recibo</a></li>
                                <li class="dropdown-item"><a href="#">Contratos</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-item"><a href="#">Catalogo de Contratos</a></li>
                            </ul>
                            </div> 
                            <div class="row" >
                                <div class="col-lg-12">
                                    <div class="card-body row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-primary btn-block"><i class="fa fa-bell"></i> Aceptar</button>
                                        <br>
                                        <button type="button" class="btn btn-danger btn-block btn-md"><i class="fa fa-bell"></i> Cancelar</button>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /btn-group -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


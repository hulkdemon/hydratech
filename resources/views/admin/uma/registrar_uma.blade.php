@extends('adminlte::page')

@section('title', 'Registrar UMA')

@section('content')
@php
use Carbon\Carbon;
@endphp
<head>
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>

</head>
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
                <h1>Registro y datos guardados de UMA</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Registro de UMA</li>
                </ol>
                </div>
            </div>
            </div>
        </section>
            <div class="container-fluid">
    <div class="row">
        <!-- Columna izquierda para el formulario -->
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Registrar valor del UMA</h3>
            </div>
            <div class="card-body p-0">
            <form action="{{url('admin/uma')}}" method="post">
                @csrf
                <div class="card-body">
                <label>Ingrese el valor del UMA:</label>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                    </div>
                    <input type="text" name="valor" class="form-control" id="valor" value="{{old('valor')}}" placeholder="Ingrese el valor del UMA a registrar">
                    </div>
                </div>
                <label>Ingrese la fecha de aplicación del UMA:</label>
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                    </div>
                    <input type="date" name="fecha_aplicacion" class="form-control" id="fecha_aplicacion" value="{{old('fecha_aplicacion')}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-block "><i class="fa fa-check"></i> Registrar</button>
                    </div>
                    <div class="col-lg-6">
                    <button type="reset" class="btn btn-danger btn-block "><i class="fa fa-cancel"></i> Cancelar</button>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
        <!-- Columna con tabla de registros de UMA -->
        <div class="col-md-6">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Registros de datos del UMA</h3>
            </div>
            <div class="card-body p-0">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Valor</th>
                    <th>Fecha de aplicación</th>
                    <th>Fecha de vigencia</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($umas as $uma)
                    <tr>
                        <td>{{ $uma->id_uma }}</td>
                        <td>{{ $uma->valor }}</td>                    
                        <td>{{ $uma->fecha_aplicacion }}</td>                    
                        <td>{{ $uma->fecha_vigencia }}</td>
                        <td>
                                @php
                                //Validación para saber si la fecha está activa y mostrar el mensaje
                                $fechaActual = Carbon::now(); 
                                $fechaAplicacion = Carbon::parse($uma->fecha_aplicacion); 
                                $fechaVigencia = Carbon::parse($uma->fecha_vigencia); 
                                
                                //Uso de Less Than or Equal y Greater Than or Equal
                                if ($fechaVigencia->lte($fechaActual) && $fechaVigencia->gte($fechaAplicacion)) {
                                    echo 'Finalizado';
                                } else {
                                    echo '<h6 class=" text-success font-weight-bold">Activo</h6>';
                                }
                                @endphp
                        </td>
                    </tr>
                    @endforeach
                
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
    <script> console.log('Hi!'); </script>
@stop


@extends('adminlte::page')

@section('title', 'Mostrar Contratos')

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
                <h3 class="card-title">Tabla con los contratos registrados</h3>
              </div>
              <div class="card-header">
                <a href="{{url('caja/contratos/registrar_contrato')}}" class="btn btn-primary ">Registrar nuevo contrato</a><br><br>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Número del contrato</th>
                    <th>Nombres de la persona</th>
                    <th>Apellidos de la persona</th>
                    <th>Domicilio</th>
                    <th>Correo electrónico</th>
                    <th>Fecha vigencia</th>
                    <th>Tipo de contrato registrado</th>
                    <th>Editar Contrato</th>
                    <th>Registrar datos fiscales</th>
                  </tr>
                  </thead>
                  <tbody>
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
                        <td><a href="{{ url('caja/contratos/'.$contrato->id_contrato.'/editar_contrato')}}" class="btn btn-warning ">Editar</a></td>                     
                          <td>  
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrar_datos_fiscales{{ $contrato->id_contrato }}">
                              Registrar
                          </button>
                          </td>
                      </tr>
                    @endforeach
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop


@extends('adminlte::page')

@section('title', 'Mostrar tipos de contrato')

@section('content')
    <body> 
        
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Tipos de contrato registrados</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Vistas de tipos de contrato</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla con los tipos de contrato registrados</h3>
              </div>
              <div class="card-header">
                <a href="{{url('caja/tipos_contrato/registrar_tipo_contrato')}}" class="btn btn-primary ">Registrar nuevo tipo de contrato</a><br><br>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre del tipo de contrato</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($tipos_contrato as $tipo_contrato)
                    <tr>
                        <td>{{ $tipo_contrato->id_tipo_contrato }}</td>
                        <td>{{ $tipo_contrato->nombre }}</td>
                        <td><a href="{{ url('caja/tipos_contrato/'.$tipo_contrato->id_tipo_contrato.'/editar_tipos_contrato')}}" class="btn btn-warning btn-sm">Editar</a></td>
                        <td>
                          <form method="POST" action="{{route('caja.tipos_contrato.destroy', $tipo_contrato)}}" >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
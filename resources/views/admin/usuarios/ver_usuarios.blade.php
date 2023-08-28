
@extends('adminlte::page')

@section('title', 'Mostrar Usuarios')

@section('content')
    <body> 
        
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Usuarios registrados</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Vistas de usuarios</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla con los usuarios registrados</h3>
              </div>
              <div class="card-header">
                <a href="{{url('admin/usuarios/registrar_usuario')}}" class="btn btn-primary ">Registrar nuevo usuario</a><br><br>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombres del usuario</th>
                    <th>Nombre de usuario (username)</th>
                    <th>Correo</th>
                    <th>Rol del usuario</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($usuarios->isEmpty())
                    <tr>
                        <td colspan="10">No hay usuarios registrados</td>
                    </tr>
                    @else
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id}}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->email }}</td>
                        @if ($usuario->id_rol)
                        <td>{{ $usuario->rol->tipo }}</td>
                        @else
                            <td>No tiene rol asignado</td>
                        @endif
                        <td><a href="{{ url('admin/usuarios/'.$usuario->id.'/editar_usuario')}}" class="btn btn-warning btn-sm">Editar</a></td>
                        <td>
                          <form method="POST" action="{{route('admin.usuarios.destroy', $usuario)}}" >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@extends('adminlte::page')

@section('title', 'Mostrar roles')

@section('content')
    <body> 
        
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Roles registrados</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Vistas de roles</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
         <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabla con los roles registrados</h3>
              </div>
              <div class="card-header">
                <a href="{{url('admin/roles/registrar_rol')}}" class="btn btn-primary ">Registrar nuevo rol</a><br><br>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre del rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if ($roles->isEmpty())
                    <tr>
                        <td colspan="10">No hay roles registrados</td>
                    </tr>
                    @else
                    @foreach ($roles as $rol)
                    <tr>
                        <td>{{ $rol->id_rol }}</td>
                        <td>{{ $rol->tipo }}</td>
                        <td><a href="{{ url('admin/roles/'.$rol->id_rol.'/editar_roles')}}" class="btn btn-warning btn-sm">Editar</a></td>
                        <td>
                          <form method="POST" action="{{route('admin.roles.destroy', $rol)}}" >
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
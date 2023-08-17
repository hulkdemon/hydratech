@extends('adminlte::page')

@section('title', 'Registrar usuarios')

@section('content')
<head>
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>

</head>
    <body>
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
                <h1>Registro de nuevos usuarios</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Registro de usuarios</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
                <form action="{{url('admin/usuarios')}}" method="post">
                    @csrf
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del usuario a registrar</h3>
                        </div>
            <div class="card-body">
                    <label>Nombres del usuario:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-person"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" placeholder="Ingrese los nombres del usuario">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    <label>Nombre de usuario (username):</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control" id="username" value="{{old('username')}}" placeholder="Ingrese el usuario (username)">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <label>Correo:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" placeholder="Ingrese el correo del usuario">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Contraseña:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" id="password" value="{{old('password')}}" placeholder="Ingrese la contraseña del usuario">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Rol del usuario:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                            </div>
                            <select name="id_rol" id="id_rol" class="form-control">
                                <option value="">Seleccione el rol del usuario</option>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id_rol}}">{{ $rol -> tipo}}</option>
                                @endforeach
                            </select>                              </div>
                            <!-- /.input group -->
                            </div>
                            <div class="row" >
                                <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Registrar</button>
                                        <br>
                            </div>
                            <div class="col-lg-3">
                                <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-cancel"></i> Cancelar</button>
                                <br>
                            </div>
                                    </div>
                                <!-- /.card -->
                            <!-- /btn-group -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </form>
    </body>
    </html>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@extends('adminlte::page')

@section('title', 'Registrar usuarios')

@section('content')
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
                </div>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('admin.usuarios.ver_usuarios') }}" class="btn btn-primary">
                            Ver usuarios registrados
                        </a>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
                <form id="formulario_usuarios" action="{{url('admin/usuarios')}}" method="post">
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
                            @if (count($roles) === 0)
                            <div class="alert alert-danger">
                                Para registrar el usuario, primero debe registrar un rol.
                            </div>
                        @else
                        <label>Rol del usuario:</label>
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
                            </select>                              
                            </div>
                            </div>
                        @endif
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
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

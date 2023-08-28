@extends('adminlte::page')

@section('title', 'Registrar roles')

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
                <h1>Creación de nuevos roles</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Creación de roles</li>
                </ol>
            </div>
            </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('admin.roles.ver_roles') }}" class="btn btn-primary">
                            Ver roles registrados
                        </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
                <form id="formulario_roles" action="{{url('admin/roles')}}" method="post">
                    @csrf
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del rol a crear</h3>
                        </div>
                        <div class="card-body">
                        <label>Ingrese el rol a registrar:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                            </div>
                            <input type="text" name="tipo" class="form-control" id="tipo" value="{{old('tipo')}}" placeholder="Ingrese el rol a registrar">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    <br>
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
    $('#formulario_roles').submit(function (e) {
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
                    $('#formulario_roles')[0].reset();
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

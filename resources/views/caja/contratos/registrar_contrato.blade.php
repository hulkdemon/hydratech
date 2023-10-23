@extends('adminlte::page')

@section('title', 'Registrar contratos')

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
                <h1>Registro de nuevos contratos</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Registro de contratos</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
                <form id="formulario_contrato" action="{{url('caja/contratos')}}" method="post">
                    @csrf
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del contrato a registrar</h3>
                        </div>
            <div class="card-body">
                    <label>Nombres de la persona</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        </div>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre')}}" placeholder="Ingrese los nombres de la persona a registrar el contrato">
                        </div>
                        <!-- /.input group -->
                    </div>
                        <label>Apellidos:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-signature"></i></span>
                            </div>
                            <input type="text" name="apellido" class="form-control" id="apellido" value="{{old('apellido')}}" placeholder="Ingrese los apellidos de la persona">
                            </div>
                            <!-- /.input group -->
                    </div>
                        <label>Domicilio:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                            </div>
                            <input type="text" name="domicilio" class="form-control" id="domicilio" value="{{old('domicilio')}}" placeholder="Ingrese el domicilio de la persona">
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
                            <input type="email" name="correo_electronico" class="form-control" id="coreo_electronico" value="{{old('correo_electronico')}}" placeholder="Ingrese el correo electrónico de la persona">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Tipo de contrato a registrar:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                            </div>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                <option value="">Seleccione el tipo de contrato que se registrará al contrato</option>
                                @foreach ($tipos_contratos as $tipo_contrato)
                                    <option value="{{ $tipo_contrato->id_tipo_contrato}}">{{ $tipo_contrato -> nombre}}</option>
                                @endforeach
                            </select>                              
                            </div> 
                        </div>
                        @if (count($tipos_contratos) === 0)
                            <div class="alert alert-danger">
                                Para registrar el contrato, primero debe registrar un tipo de contrato.
                            </div>
                        @endif
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
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
   $(document).ready(function () {
    $('#formulario_contrato').submit(function (e) {
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
                    $('#formulario_contrato')[0].reset();
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
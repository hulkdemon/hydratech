@extends('adminlte::page')

@section('title', 'Registrar tipos de contrato')

@section('content')
    <body>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Registro de tipos de contrato</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url ("admin")}}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Registro de tipos de contrato</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('caja.tipos_contrato.ver_tipos_contrato') }}" class="btn btn-primary">
                            Ver tipos de contratos registrados
                        </a>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        
            <div>
                <form id="formulario_tipo_contrato" action="{{url('caja/tipos_contrato')}}" method="post">
                    @csrf
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del tipo de contrato a registrar</h3>
                        </div>
                <div class="card-body">
                    <label>Tipo de contrato:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                            </div>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre')}}" placeholder="Ingrese el tipo de contrato a registrar">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
   $(document).ready(function () {
    $('#formulario_tipo_contrato').submit(function (e) {
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
                    $('#formulario_tipo_contrato')[0].reset();
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

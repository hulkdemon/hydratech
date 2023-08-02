@extends('adminlte::page')

@section('title', 'Editar tipos de contrato')

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
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <section class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Editar tipos de contrato</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Edición de tipos de contrato</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
                <form action="{{url('caja/tipos_contrato/' .$tipo_contrato->id_tipo_contrato )}}" method="post">
                    @csrf
                    @method("PUT")
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del tipo de contrato a editar</h3>
                        </div>
            <div class="card-body">
<label>Nombre del tipo de contrato a editar:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-pen"></i></span>
                            </div>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{$tipo_contrato->nombre}}" >
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    <br>
                            <div class="row" >
                                <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Editar</button>
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

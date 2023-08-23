@extends('adminlte::page')

@section('title', 'Editar contrato')

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
                <form action="{{url('caja/contratos/' .$contrato->id_contrato)}}" method="post">
                    @csrf
                    @method("PUT")
                    <!-- Input addon -->
                    <div class="card card-info">
                        <div class="card-header">
                          <h3 class="card-title">Datos del contrato a registrar</h3>
                        </div>
            <div class="card-body">
                    <label>Número del contrato:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                            </div>
                            <input type="text" name="numero_contrato" class="form-control" id="numero_contrato" value="{{$contrato->numero_contrato}}" placeholder="Ingrese el número del contrato">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    <label>Nombres de la persona</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                        </div>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{$contrato->nombre}}" placeholder="Ingrese los nombres de la persona a registrar el contrato">
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
                            <input type="text" name="apellido" class="form-control" id="apellido" value="{{$contrato->apellido}}" placeholder="Ingrese los apellidos de la persona">
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
                            <input type="text" name="domicilio" class="form-control" id="domicilio" value="{{$contrato->domicilio}}" placeholder="Ingrese el domicilio de la persona">
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
                            <input type="email" name="correo_electronico" class="form-control" id="correo_electronico" value="{{$contrato->correo_electronico}}" placeholder="Ingrese el correo electrónico de la persona">
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
                                <option value="{{ $tipo_contrato->id_tipo_contrato}}" @if ($tipo_contrato->id_tipo_contrato == $contrato->id_tipo_contrato) {{'selected'}} @endif>{{ $tipo_contrato -> nombre}}</option>
                            @endforeach
                            </select>                              
                            </div> 
                        </div>
                        <!-- /.form group -->
                            <label>Fecha de vigencia del contrato:</label>
                            <!-- Date mm/dd/yyyy -->
                            <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                </div>
                                <input type="date" name="fecha_vigencia" class="form-control" id="fecha_vigencia" value="{{$contrato->fecha_vigencia}}">
                                </div>
                                <!-- /.input group -->
                            </div>
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
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

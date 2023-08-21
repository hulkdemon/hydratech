

@extends('adminlte::page')

@section('title', 'Mostrar empleados')

@section('content')
    <body>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Gestión de condonaciones solicitadas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Caja</a></li>
                <li class="breadcrumb-item active">Gestión condonaciones</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>


      <div class="col-sm-6 ">
        <u><h2>Solicitudes de condonaciones</h2></u>
      </div>          
      <br>
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h5 class=" font-weight-bold">Hay "número" solicitudes de condonaciones pendientes</h5>
        </div>
      </div>
      
      

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Condonación del "número" %</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            </button>
          </div>
        </div>
        <div class="card-body">
          Pedido por: 
        </div>
        <div class="card-body">
          Realizado por caja: 
        </div>
        <div class="card-body">
          Motivo: "Texto de motivo"
        </div>
        <div class="card-body">
          Fecha: "fecha"
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <button class="btn btn-primary mr-3">Aceptar</button>
        <button class="btn btn-danger">Rechazar</button>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </div>
      <br>
      
    </body>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
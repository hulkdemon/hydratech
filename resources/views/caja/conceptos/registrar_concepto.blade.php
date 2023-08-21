<div class="modal fade" id="registrar_concepto" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Registro de conceptos para los cobros</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
            <form action="{{url('caja/conceptos')}}" method="post">
                @csrf
                <!-- Input addon -->
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Datos del concepto a registrar</h3>
                    </div>
                <div class="card-body">
                <label>Descripción del concepto:</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-circle-info"></i></span>
                        </div>
                        <input type="text" name="descripcion" class="form-control" id="descripcion" value="{{old('descripcion')}}" placeholder="Ingrese el motivo de la multa">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                <label>Monto de la multa: </label>
                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i></span>
                    </div>
                    <input type="text" name="precio" class="form-control" id="precio" value="{{old('precio')}}" placeholder="Ingrese el monto a pagar por la multa">
                    </div>
                    <!-- /.input group -->
                </div>
                        </div>
                        <div class="row justify-content-center" >
                            <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary btn-block" data-bs-backdrop="static"><i class="fa fa-check"></i> Registrar</button>
                        </div>
                        <div class="col-lg-3">
                            <button type="reset" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-cancel"></i> Cerrar</button>
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
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
@if(isset($contrato))
<div class="modal fade" id="registrar_datos_fiscales{{ $contrato->id_contrato }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registro de datos fiscales</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('caja/datos_fiscales')}}" method="post">
                @csrf
                <!-- Input addon -->
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Datos fiscales a registrar</h3>
                    </div>
        <div class="card-body">
                <label>RFC a registrar:</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        </div>
                        <input type="text" name="rfc" class="form-control" id="rfc" value="{{old('rfc')}}" placeholder="Ingrese el RFC a registrar">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                <label>Ingrese la razón social</label>
                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                    <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    </div>
                    <input type="text" name="razon_social" class="form-control" id="razon_social" value="{{old('razon_social')}}" placeholder="Ingrese la razón social">
                    </div>
                    <!-- /.input group -->
                </div>
                        <input type="hidden" name="id_contrato" value="{{ $contrato->id_contrato }}">
                        </div>
                        <div class="row justify-content-center" >
                            <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Registrar</button>
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
            @endif

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
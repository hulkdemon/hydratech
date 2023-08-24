@if(isset($contrato))
<div class="modal fade" id="solicitar_condonaciones{{ $contrato->id_contrato}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Solicitud de condonaciones al contrato registrado a nombre de: {{$contrato->nombre}} {{$contrato->apellido}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('caja.condonaciones.guardar_condonacion_solicitada') }}" method="post">
                @csrf
                <!-- Input addon -->
                <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Solicitar de condonaciones al contrato</h3>
                    </div>
        <div class="card-body">
                        <label>Ingrese el descuento:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                            </div>
                            <input type="text" name="descuento" class="form-control" id="descuento" value="{{old('descuento')}}" placeholder="Ingrese el descuento que se va registrar en la condonación">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Ingrese el porcentaje:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                            </div>
                            <input type="text" name="porcentaje" class="form-control" id="porcentaje" value="{{old('porcentaje')}}" placeholder="Ingrese el porcentaje a registrar">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Ingrese el motivo:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-clipboard-question"></i></span>
                            </div>
                            <input type="text" name="motivo" class="form-control" id="motivo" value="{{old('motivo')}}" placeholder="Ingrese el motivo por el cual se solicita la condonación">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <label>Ingrese la fecha inicio de vigencia:</label>
                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            </div>
                            <input type="date" name="inicio_vigencia" class="form-control" id="inicio_vigencia" value="{{old('inicio_vigencia')}}" >
                            </div>
                            <!-- /.input group -->
                        </div>
                        <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="id_contrato" value="{{ $contrato->id_contrato }}">
                    </div>
                        <div class="row justify-content-center" >
                            <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Solicitar</button>
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
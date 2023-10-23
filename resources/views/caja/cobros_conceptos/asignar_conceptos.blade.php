@if(isset($contrato))
<div class="modal fade" id="asignar_conceptos{{ $contrato->id_contrato }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Registro de conceptos al contrato registrado a nombre de: {{$contrato->nombre}} {{$contrato->apellido}}</h4>
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
            <form action="{{url('caja/cobros_conceptos')}}" method="post">
                @csrf
                <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">Asignación de conceptos al contrato</h3>
                    </div>
                    <div class="card-body">
                    <label>Concepto a asignar:</label>
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-gavel"></i></span>
                        </div>
                        <select name="id_concepto" id="id_concepto" class="form-control">
                            <option value="">Seleccione el concepto a registrar al contrato</option>
                            @foreach ($conceptos as $conceptos)
                            @if ($conceptos->activo == 1 && !$conceptos->cobrosConceptos->count())
                                <option value="{{ $conceptos->id_concepto}}">{{ $conceptos -> descripcion}}</option>
                                @endif
                                @endforeach
                        </select>
                        </div>
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
                    </div>
                </div>
            </form>
            @endif

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
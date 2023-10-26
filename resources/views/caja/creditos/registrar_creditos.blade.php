@if(isset($contrato))
<div class="modal fade" id="registrar_creditos{{ $contrato->id_contrato }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Registro de créditos (abonos) al contrato registrado a nombre de: {{$contrato->nombre}} {{$contrato->apellido}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('caja/creditos')}}" id="formulario_creditos" method="post">
                @csrf
                <!-- Input addon -->
                <div class="card card-success">
                    <div class="card-header">
                      <h3 class="card-title">Registro de créditos al contrato</h3>
                    </div>
        <div class="card-body">
                <label>Ingrese la cantidad a abonar:</label>
                    <!-- Date mm/dd/yyyy -->
                    <div class="form-group">
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-solid fa-sack-dollar"></i></span>
                        </div>
                        <input type="text" name="monto" class="form-control" id="monto" value="{{old('monto')}}" placeholder="Ingrese el monto a registrar para poder dar abono automático al siguiente cobro">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                        <input type="hidden" name="id_contrato" value="{{ $contrato->id_contrato }}">
                        </div>
                        <div class="row justify-content-center" >
                            <div class="col-lg-3">
                            <button type="submit" id="submitBtn" name="submitted" class="btn btn-primary btn-block"><i class="fa fa-check"></i> Registrar</button>
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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const creditForm = document.getElementById('formulario_creditos');
        const submitBtn = creditForm.querySelector('button[type="submit"]');
        const processingMessage = document.getElementById('processingMessage');

        creditForm.addEventListener('submit', function (event) {
            submitBtn.disabled = true; // Deshabilita el botón
            processingMessage.style.display = 'block'; // Muestra el mensaje de procesamiento
        });
    });
</script>


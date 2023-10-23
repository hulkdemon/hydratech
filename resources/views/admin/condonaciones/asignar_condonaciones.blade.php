@if(isset($contrato))
<div class="modal fade" id="asignar_condonaciones{{ $contrato->id_contrato}}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Asignación de condonaciones al contrato registrado a nombre de: {{$contrato->nombre}} {{$contrato->apellido}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formulario_asignar_condonaciones" action="{{ route('admin.condonaciones.registrar_condonacion') }}" method="post">
                @csrf
                <!-- Input addon -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Asignación de condonaciones al contrato</h3>
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
                        <input type="hidden" name="id_usuario" value="{{ auth()->user()->id }}">
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
            @section('js')
                <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script>
            $(document).ready(function () {
                $('#formulario_asignar_condonaciones').submit(function (e) {
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
                                $('#formulario_asignar_condonaciones')[0].reset();
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
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
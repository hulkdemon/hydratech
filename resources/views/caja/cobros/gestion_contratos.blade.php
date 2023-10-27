
@extends('adminlte::page')

@section('title', 'Gestión de transacciones')

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
                <div class="col-sm-9">
                <h1>Administración de Contratos para Transacciones Financieras</h1>
                </div>
                <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                    <a href="{{url ("admin")}}">
                        <i class="fa fa-home"></i>
                    </a>
                    </li>
                    <li class="breadcrumb-item active">Administración de Transacciones</li>
                </ol>
                </div>
            </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa-solid fa-tools"></i> Opciones de Gestión
                    </button>
                        <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="{{url ("caja/contratos/registrar_contrato")}}"><i class="fa-solid fa-file-signature"></i> Registrar contrato</a></li>
                        <li class="dropdown-item"><a href="{{url ("caja/tipos_contrato/registrar_tipo_contrato")}}"><i class="fa-solid fa-folder-open"></i> Registrar tipo de contrato</a></li>
                        <li class="dropdown-item"><a class="primary button cursor-pointer" style="cursor: pointer;" data-toggle="modal" data-target="#registrar_concepto"><i class="fa-regular fa-circle-xmark" ></i> Registrar concepto </a></li>
                    </ul>                
                </div>
            </div>
            <div class="card-body">
                <h5 class="mb-2">Realizar búsqueda por nombre, apellido, domicilio o número de contrato</h5>
                <table id="datos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th >Num. contrato</th>
                            <th>Nombre de la persona</th>
                            <th>Domicilio</th>
                            <th class="text-center">Acciones para el contrato</th>
                            <th class="text-center">Conceptos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                        <tr>
                            <td style="width: 10;">{{ $contrato->id_contrato }}</td>
                            <td style="width: 80px;">{{ $contrato->numero_contrato }}</td>
                            <td>{{ $contrato->nombre }} {{ $contrato->apellido }}</td>
                            <td style="width: 100px;">{{ $contrato->domicilio }}</td>
                            <td>
                                @if(isset($contrato))
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('caja.cobros.registrar_cobro', ['id_contrato' => $contrato->id_contrato]) }}" class="btn btn-primary btn-sm realizarCobroBtn">
                                        <i class="fa-solid fa-credit-card"></i> Realizar cobro
                                    </a>
                                    <a href="{{ url('caja/cobros/'.$contrato->id_contrato.'/ver_cobros')}}" class="btn btn-success btn-sm verCobrosBtn" style="display: none;">
                                        <i class="fa-solid fa-eye"></i> Ver cobros
                                    </a>
                                    <div class="switch-icon">
                                        <i class="fa-solid fa-toggle-off switch"></i>
                                    </div>  
                                @endif
                                    @if(isset($contrato))
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#registrar_creditos{{ $contrato->id_contrato }}">
                                            <i class="fa-solid fa-wallet"></i> Registrar crédito
                                        </button>
                                    @endif
                                    @if(isset($contrato))
                                    <button type="button" class="btn btn-info btn-sm" onclick="showConfirmationDialog()">
                                        <i class="fa-solid fa-hand-holding-dollar"></i> Solicitar condonación
                                    </button>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                @if(isset($contrato))
                                <button type="button" class="btn center btn-danger btn-sm" data-toggle="modal" data-target="#asignar_conceptos{{ $contrato->id_contrato }}">
                                    <i class="fa-solid fa-gavel"></i> Aplicar concepto
                                </button>
                            @endif
                        </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
    
    @foreach ($contratos as $contrato)
    @include('caja.conceptos.registrar_concepto')
    @include('caja.creditos.registrar_creditos')
    @include('caja.cobros_conceptos.asignar_conceptos')
    @include('caja.condonaciones.solicitar_condonaciones')
    @endforeach
    
@stop

@section('css')

@stop

@section('js')
    <script src="https://kit.fontawesome.com/42813926db.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @isset($contrato)

    <script>
        function showConfirmationDialog() {
            Swal.fire({
                title: '¿Deseas solicitar una condonación al administrador',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#solicitar_condonaciones{{ $contrato->id_contrato }}').modal('show');
                }
            });
        }
    </script>
        
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const realizarCobroBtns = document.querySelectorAll(".realizarCobroBtn");
        const verCobrosBtns = document.querySelectorAll(".verCobrosBtn");
        const switchIcons = document.querySelectorAll(".switch-icon");

        switchIcons.forEach((switchIcon, index) => {
            switchIcon.addEventListener("click", function () {
                if (realizarCobroBtns[index].style.display === "none") {
                    realizarCobroBtns[index].style.display = "block";
                    verCobrosBtns[index].style.display = "none";
                    switchIcon.innerHTML = '<i class="fa-solid fa-toggle-off switch"></i>';
                } else {
                    realizarCobroBtns[index].style.display = "none";
                    verCobrosBtns[index].style.display = "block";
                    switchIcon.innerHTML = '<i class="fa-solid fa-toggle-on switch"></i>';
                }
            });
        });
    });

    </script>

    @endisset
<script>
    $(function () {
    $("#datos").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });
});
    </script>
@stop
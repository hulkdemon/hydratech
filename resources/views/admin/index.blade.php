@extends('adminlte::page')

@section('title', 'Hydratech')

@section('content_header')
{{-- Vista --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center">
                <h1>Página principal Hydratech</h1>
            </div>
            <ul class="list-group list-group-flush">
                <!-- Agrega más enlaces a las funciones de administrador -->
            </ul>
        </div>
    </div>
</div> 
@stop

@section('content')
@if (auth()->user()->rol->tipo === 'Administrador')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Funciones de Administrador
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('admin.usuarios.registrar_usuario') }}">Registrar Usuarios</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.usuarios.ver_usuarios') }}">Ver Usuario</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.roles.registrar_rol') }}">Registrar Roles</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.roles.ver_roles') }}">Ver Roles</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.condonaciones.gestion_contratos') }}">Asignar condonaciones</a></li>
                    <li class="list-group-item"><a href="{{ route('admin.condonaciones.gestion_condonaciones') }}">Administrar Condonaciones</a></li>
                    <!-- Agrega más enlaces a las funciones de administrador -->
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Aquí puedes agregar el contenido principal de tu página de administrador -->
            <div class="card">
                <div class="card-header">
                    @auth
                    @if(auth()->user()->rol)
                    <h3>Bienvenido, usuario: {{ auth()->user()->name }} con rol de:  {{ auth()->user()->rol->tipo }}</h3>
                    @else
                    <h3>Bienvenido, usuario: {{ auth()->user()->name }} </h3>
                    @endif
                @endauth   
                </div>
                <div class="card-body">
                    <p>Contenido principal de la página de administrador.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif (auth()->user()->rol->tipo === 'Cajero')
    
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Funciones de Cajero
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ route('caja.contratos.registrar_contrato') }}">Registrar contrato</a></li>
                    <li class="list-group-item"><a href="{{ route('caja.contratos.ver_contratos') }}">Ver contratos</a></li>
                    <li class="list-group-item"><a href="{{ route('caja.tipos_contrato.registrar_tipo_contrato') }}">Registrar tipos de contrato</a></li>
                    <li class="list-group-item"><a href="{{ route('caja.tipos_contrato.ver_tipos_contrato') }}">Ver tipos de contrato</a></li>
                    <li class="list-group-item"><a href="{{ route('caja.cobros.gestion_contratos') }}">Realizar cobros</a></li>
                    <!-- Agrega más enlaces a las funciones de administrador -->
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Aquí puedes agregar el contenido principal de tu página de administrador -->
            <div class="card">
                <div class="card-header">
                    @auth
                    @if(auth()->user()->rol)
                    <h3>Bienvenido, usuario: {{ auth()->user()->name }} con rol de:  {{ auth()->user()->rol->tipo }}</h3>
                    @else
                    <h3>Bienvenido, usuario: {{ auth()->user()->name }} </h3>
                    @endif
                @endauth   
                </div>
                <div class="card-body">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
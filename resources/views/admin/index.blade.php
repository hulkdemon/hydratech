@extends('adminlte::page')

@section('title', 'HydraTech')

@section('content_header')
{{-- Vista --}}
@auth
    @if(auth()->user()->rol)
    <h1>Bienvenido, usuario: {{ auth()->user()->name }} con rol de:  {{ auth()->user()->rol->tipo }}</h1>
    @else
    <h1>Bienvenido, usuario: {{ auth()->user()->name }} </h1>
    @endif
@endauth
@stop

@section('content')
    <p>Pagina de administrador Hydratech</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
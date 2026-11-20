@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    <h1>Sistema de Control de Farmacia</h1>
    <p>Proyecto base funcionando con Laravel {{ app()->version() }}.</p>
    <p>Base de datos conectada:
        <strong>{{ DB::connection()->getDatabaseName() }}</strong>
    </p>
@endsection
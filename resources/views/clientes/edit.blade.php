<!-- resources/views/clientes/edit.blade.php -->
@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('contenido')
    <h1>Editar cliente</h1>

    <form method="POST" novalidate action="{{ route('clientes.update', $cliente) }}">
        @csrf
        @method('PUT')
        @include('clientes._form')

        <div class="acciones">
            <button type="submit">Guardar cambios</button>
            <a href="{{ route('clientes.show', $cliente) }}">Cancelar</a>
        </div>
    </form>
@endsection
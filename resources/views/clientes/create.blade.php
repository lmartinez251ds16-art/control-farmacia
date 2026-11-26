<!-- resources/views/clientes/create.blade.php -->
@extends('layouts.app')

@section('titulo', 'Registrar cliente')

@section('contenido')
    <h1>Registrar cliente</h1>

    <form method="POST" action="{{ route('clientes.store') }}" novalidate>
        @csrf
        @include('clientes._form')

        <div class="acciones">
            <button type="submit">Guardar</button>
            <a href="{{ route('clientes.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
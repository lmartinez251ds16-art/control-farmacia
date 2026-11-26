@extends('layouts.app')

@section('titulo', 'Editar medicamento')

@section('contenido')
    <h1>Editar medicamento</h1>

    <form method="POST" novalidate action="{{ route('medicamentos.update', $medicamento) }}">
        @csrf
        @method('PUT')
        @include('medicamentos._form')

        <div class="acciones">
            <button type="submit">Guardar cambios</button>
            <a href="{{ route('medicamentos.show', $medicamento) }}">Cancelar</a>
        </div>
    </form>
@endsection
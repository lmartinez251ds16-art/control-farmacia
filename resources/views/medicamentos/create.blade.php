@extends('layouts.app')

@section('titulo', 'Registrar medicamento')

@section('contenido')
    <h1>Registrar medicamento</h1>

    <form method="POST" novalidate action="{{ route('medicamentos.store') }}">
        @csrf
        @include('medicamentos._form')

        <div class="acciones">
            <button type="submit">Guardar</button>
            <a href="{{ route('medicamentos.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
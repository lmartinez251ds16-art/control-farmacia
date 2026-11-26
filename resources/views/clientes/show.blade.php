<!-- resources/views/clientes/show.blade.php -->
@extends('layouts.app')

@section('titulo', 'Ficha del cliente')

@section('contenido')
    <hgroup>
        <h1>{{ $cliente->apellidos }}, {{ $cliente->nombres }}</h1>
        <p>DNI {{ $cliente->dni }}</p>
    </hgroup>

    <article>
        <p><strong>Celular:</strong> {{ $cliente->telefono ?? '—' }}</p>
        <p><strong>Fecha de registro:</strong> {{ $cliente->created_at->format('d/m/Y') }}</p>
    </article>

    <h2>Últimas dispensaciones</h2>
    @forelse ($dispensaciones as $disp)
        <p>{{ $disp->fecha->format('d/m/Y H:i') }} · Total: S/ {{ number_format($disp->total, 2) }} · {{ $disp->estado }}</p>
    @empty
        <p>Este cliente no tiene dispensaciones registradas.</p>
    @endforelse

    <div class="acciones">
        <a href="{{ route('clientes.edit', $cliente) }}" role="button">Editar</a>
        <a href="{{ route('clientes.index') }}">Volver al listado</a>
        <form method="POST" action="{{ route('clientes.destroy', $cliente) }}"
              onsubmit="return confirm('¿Desactivar a este cliente?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="secondary">Desactivar</button>
        </form>
    </div>
@endsection
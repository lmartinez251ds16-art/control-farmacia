<!-- resources/views/clientes/index.blade.php -->
@extends('layouts.app')

@section('titulo', 'Clientes')

@section('contenido')
    <hgroup>
        <h1>Clientes</h1>
        <p>{{ $clientes->total() }} clientes encontrados</p>
    </hgroup>

    <form method="GET" action="{{ route('clientes.index') }}" role="search">
        <input type="search" name="buscar" value="{{ $buscar }}"
               placeholder="Buscar por DNI o apellidos">
        <button type="submit">Buscar</button>
    </form>

    <p>
        <a href="{{ route('clientes.create') }}" role="button">+ Registrar cliente</a>
    </p>

    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Apellidos y nombres</th>
                <th>Teléfono</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->dni }}</td>
                    <td>{{ $cliente->apellidos }}, {{ $cliente->nombres }}</td>
                    <td>{{ $cliente->telefono ?? '—' }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente) }}">Ver</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No se encontraron clientes.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $clientes->links('pagination::simple-default') }}
@endsection
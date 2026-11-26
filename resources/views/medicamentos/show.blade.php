@extends('layouts.app')

@section('titulo', 'Ficha de medicamento')

@section('contenido')
    <hgroup>
        <h1>{{ $medicamento->nombre_comercial }} ({{ $medicamento->codigo_interno }})</h1>
        <p>{{ $medicamento->principio_activo }} · {{ $medicamento->presentacion }} · <x-estado :activo="$medicamento->activo" /></p>
    </hgroup>

    <article>
        <p><strong>Categoría:</strong> {{ $medicamento->categoria->nombre }}</p>
        <p><strong>Condición de venta:</strong> {{ \App\Models\Medicamento::CONDICIONES_VENTA[$medicamento->condicion_venta] }}</p>
        @if ($medicamento->listaControl)
            <p><strong>Lista de control:</strong> {{ $medicamento->listaControl->codigo }} ({{ $medicamento->listaControl->tipo }})</p>
        @endif
        <p><strong>Precio de venta:</strong> S/ {{ number_format($medicamento->precio_venta, 2) }}</p>
        <p><strong>Stock vigente actual:</strong> {{ $medicamento->stock_vigente }} unidades (Mínimo: {{ $medicamento->stock_minimo }})</p>
    </article>

    <h2>Lotes registrados (ordenados por vencimiento FEFO)</h2>
    @forelse ($lotes as $lote)
        <p>Lote <strong>{{ $lote->numero_lote }}</strong> · Vence: {{ $lote->fecha_vencimiento->format('d/m/Y') }} · Stock: {{ $lote->cantidad_actual }}/{{ $lote->cantidad_inicial }} · Estado: {{ $lote->estado }}</p>
    @empty
        <p>Este medicamento no tiene lotes registrados.</p>
    @endforelse

    <div class="acciones">
        <a href="{{ route('medicamentos.edit', $medicamento) }}" role="button">Editar</a>
        <a href="{{ route('medicamentos.index') }}">Volver al listado</a>
        <form method="POST" action="{{ route('medicamentos.estado', $medicamento) }}"
              onsubmit="return confirm('¿Cambiar el estado de este medicamento?')">
            @csrf
            @method('PATCH')
            <button type="submit" class="secondary">
                {{ $medicamento->activo ? 'Desactivar' : 'Activar' }}
            </button>
        </form>
    </div>
@endsection
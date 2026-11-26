@extends('layouts.app')

@section('titulo', 'Medicamentos')

@section('contenido')
    <hgroup>
        <h1>Catálogo de Medicamentos</h1>
        <p>{{ $medicamentos->total() }} medicamentos encontrados</p>
    </hgroup>

    <form method="GET" action="{{ route('medicamentos.index') }}">
        <div class="grid">
            <input type="search" name="buscar" value="{{ $buscar }}"
                   placeholder="Código, nombre o principio activo">
            <select name="categoria_id">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $cat)
                    <option value="{{ $cat->id }}" @selected($categoriaId == $cat->id)>
                        {{ $cat->nombre }}
                    </option>
                @endforeach
            </select>
            <select name="condicion_venta">
                <option value="">Todas las condiciones</option>
                @foreach (\App\Models\Medicamento::CONDICIONES_VENTA as $clave => $etiqueta)
                    <option value="{{ $clave }}" @selected($condicion === $clave)>
                        {{ $etiqueta }}
                    </option>
                @endforeach
            </select>
            <select name="estado">
                <option value="activos" @selected($estado === 'activos')>Activos</option>
                <option value="inactivos" @selected($estado === 'inactivos')>Inactivos</option>
                <option value="todos" @selected($estado === 'todos')>Todos</option>
            </select>
            <button type="submit">Filtrar</button>
        </div>
    </form>

    <p><a href="{{ route('medicamentos.create') }}" role="button">+ Registrar medicamento</a></p>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre comercial / DCI</th>
                <th>Categoría</th>
                <th>Condición</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($medicamentos as $med)
                @php $stock = (int) ($med->stock_vigente_total ?? 0); @endphp
                <tr>
                    <td>{{ $med->codigo_interno }}</td>
                    <td>
                        <strong>{{ $med->nombre_comercial }}</strong><br>
                        <small>{{ $med->principio_activo }} · {{ $med->presentacion }}</small>
                    </td>
                    <td>{{ $med->categoria->nombre }}</td>
                    <td>{{ \App\Models\Medicamento::CONDICIONES_VENTA[$med->condicion_venta] }}</td>
                    <td>S/ {{ number_format($med->precio_venta, 2) }}</td>
                    <td>
                        {{ $stock }}
                        @if ($stock < $med->stock_minimo)
                            <small style="color:#b3261e;">(Mín: {{ $med->stock_minimo }})</small>
                        @endif
                    </td>
                    <td><x-estado :activo="$med->activo" /></td>
                    <td><a href="{{ route('medicamentos.show', $med) }}">Ver</a></td>
                </tr>
            @empty
                <tr><td colspan="8">No se encontraron medicamentos.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $medicamentos->links('pagination::simple-default') }}
@endsection
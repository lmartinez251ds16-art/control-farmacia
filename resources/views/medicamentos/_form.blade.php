<div class="grid">
    <label>Código interno
        <input name="codigo_interno" maxlength="30"
               value="{{ old('codigo_interno', $medicamento->codigo_interno) }}"
               @error('codigo_interno') aria-invalid="true" @enderror>
        @error('codigo_interno') <small>{{ $message }}</small> @enderror
    </label>
    <label>Categoría
        <select name="categoria_id" @error('categoria_id') aria-invalid="true" @enderror>
            <option value="">Seleccione…</option>
            @foreach ($categorias as $cat)
                <option value="{{ $cat->id }}" @selected(old('categoria_id', $medicamento->categoria_id) == $cat->id)>
                    {{ $cat->nombre }}
                </option>
            @endforeach
        </select>
        @error('categoria_id') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Nombre comercial
        <input name="nombre_comercial" value="{{ old('nombre_comercial', $medicamento->nombre_comercial) }}"
               @error('nombre_comercial') aria-invalid="true" @enderror>
        @error('nombre_comercial') <small>{{ $message }}</small> @enderror
    </label>
    <label>Principio activo (DCI)
        <input name="principio_activo" value="{{ old('principio_activo', $medicamento->principio_activo) }}"
               @error('principio_activo') aria-invalid="true" @enderror>
        @error('principio_activo') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Presentación (unidad mínima)
        <input name="presentacion" placeholder="Ej. Tableta, Cápsula, Ampolla"
               value="{{ old('presentacion', $medicamento->presentacion) }}"
               @error('presentacion') aria-invalid="true" @enderror>
        @error('presentacion') <small>{{ $message }}</small> @enderror
    </label>
    <label>Precio de venta (S/)
        <input type="number" step="0.01" name="precio_venta"
               value="{{ old('precio_venta', $medicamento->precio_venta) }}"
               @error('precio_venta') aria-invalid="true" @enderror>
        @error('precio_venta') <small>{{ $message }}</small> @enderror
    </label>
    <label>Stock mínimo
        <input type="number" name="stock_minimo"
               value="{{ old('stock_minimo', $medicamento->stock_minimo) }}"
               @error('stock_minimo') aria-invalid="true" @enderror>
        @error('stock_minimo') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Condición de venta
        <select name="condicion_venta" @error('condicion_venta') aria-invalid="true" @enderror>
            @foreach (\App\Models\Medicamento::CONDICIONES_VENTA as $clave => $etiqueta)
                <option value="{{ $clave }}" @selected(old('condicion_venta', $medicamento->condicion_venta) === $clave)>
                    {{ $etiqueta }}
                </option>
            @endforeach
        </select>
        @error('condicion_venta') <small>{{ $message }}</small> @enderror
    </label>
    <label>Lista de control (solo si es controlado)
        <select name="lista_control_id" @error('lista_control_id') aria-invalid="true" @enderror>
            <option value="">No aplica</option>
            @foreach ($listas as $lista)
                <option value="{{ $lista->id }}" @selected(old('lista_control_id', $medicamento->lista_control_id) == $lista->id)>
                    {{ $lista->codigo }} · {{ $lista->descripcion }}
                </option>
            @endforeach
        </select>
        @error('lista_control_id') <small>{{ $message }}</small> @enderror
    </label>
</div>
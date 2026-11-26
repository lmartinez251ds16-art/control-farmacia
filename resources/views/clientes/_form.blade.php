<!-- resources/views/clientes/_form.blade.php -->
<div class="grid">
    <label>DNI
        <input name="dni" value="{{ old('dni', $cliente->dni) }}" maxlength="8"
               @error('dni') aria-invalid="true" @enderror>
        @error('dni') <small>{{ $message }}</small> @enderror
    </label>
    <label>Celular (opcional)
        <input name="telefono" maxlength="9" value="{{ old('telefono', $cliente->telefono) }}"
               @error('telefono') aria-invalid="true" @enderror>
        @error('telefono') <small>{{ $message }}</small> @enderror
    </label>
</div>

<div class="grid">
    <label>Nombres
        <input name="nombres" value="{{ old('nombres', $cliente->nombres) }}"
               @error('nombres') aria-invalid="true" @enderror>
        @error('nombres') <small>{{ $message }}</small> @enderror
    </label>
    <label>Apellidos
        <input name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}"
               @error('apellidos') aria-invalid="true" @enderror>
        @error('apellidos') <small>{{ $message }}</small> @enderror
    </label>
</div>
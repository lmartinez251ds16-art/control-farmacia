<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = trim($request->input('buscar', ''));

        $clientes = Cliente::query()
            ->when($buscar, function ($consulta, $buscar) {
                $consulta->where('dni', 'like', "$buscar%")
                         ->orWhere('apellidos', 'ilike', "%$buscar%");
            })
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        return view('clientes.create', ['cliente' => new Cliente()]);
    }

    public function store(StoreClienteRequest $request)
    {
        $cliente = Cliente::create($request->validated());

        return redirect()->route('clientes.show', $cliente)
            ->with('ok', 'Cliente registrado correctamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $dispensaciones = $cliente->dispensaciones()
            ->with('usuario')
            ->latest('fecha')
            ->take(5)
            ->get();

        return view('clientes.show', compact('cliente', 'dispensaciones'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.show', $cliente)
            ->with('ok', 'Datos del cliente actualizados.');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->dispensaciones()->where('estado', 'registrada')->exists()) {
            return back()->with('error',
                'No se puede desactivar: el cliente tiene dispensaciones activas registradas.');
        }

        $cliente->delete(); // Ejecuta SoftDeletes (deleted_at) definido en RNF04

        return redirect()->route('clientes.index')
            ->with('ok', 'Cliente desactivado correctamente.');
    }

}

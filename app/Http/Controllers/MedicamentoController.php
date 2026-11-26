<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Http\Requests\StoreMedicamentoRequest;
use App\Http\Requests\UpdateMedicamentoRequest;
use App\Models\Categoria;
use App\Models\ListaControl;
use Illuminate\Http\Request;


class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar      = trim($request->input('buscar', ''));
        $categoriaId = $request->integer('categoria_id') ?: null;
        $condicion   = $request->input('condicion_venta');
        $estado      = $request->input('estado', 'activos');

        $medicamentos = Medicamento::query()
            ->with(['categoria', 'listaControl'])
            ->withSum(['lotes as stock_vigente_total' => function ($q) {
                $q->where('estado', 'vigente');
            }], 'cantidad_actual')
            ->deCategoria($categoriaId)
            ->deCondicion($condicion)
            ->when($estado === 'activos', fn ($q) => $q->activos())
            ->when($estado === 'inactivos', fn ($q) => $q->where('activo', false))
            ->when($buscar, function ($q, $buscar) {
                $q->where(function ($q) use ($buscar) {
                    $q->where('nombre_comercial', 'ilike', "%$buscar%")
                      ->orWhere('principio_activo', 'ilike', "%$buscar%")
                      ->orWhere('codigo_interno', 'ilike', "$buscar%");
                });
            })
            ->orderBy('nombre_comercial')
            ->paginate(10)
            ->withQueryString();

        $categorias = Categoria::where('activo', true)->orderBy('nombre')->get();

        return view('medicamentos.index', compact(
            'medicamentos', 'categorias', 'buscar', 'categoriaId', 'condicion', 'estado'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicamentoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamento $medicamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicamento $medicamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicamentoRequest $request, Medicamento $medicamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
}

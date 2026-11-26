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
        return view('medicamentos.create', [
            'medicamento' => new Medicamento(['precio_venta' => 0, 'stock_minimo' => 10, 'condicion_venta' => 'libre']),
            'categorias'  => Categoria::where('activo', true)->orderBy('nombre')->get(),
            'listas'      => ListaControl::where('activa', true)->orderBy('codigo')->get(),
        ]);
    }

    public function store(StoreMedicamentoRequest $request)
    {
        $datos = $request->validated();
        if ($datos['condicion_venta'] !== 'controlado') {
            $datos['lista_control_id'] = null;
        }

        $medicamento = Medicamento::create($datos);

        return redirect()->route('medicamentos.show', $medicamento)
            ->with('ok', 'Medicamento registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicamento $medicamento)
    {
        $lotes = $medicamento->lotes()
            ->with('proveedor')
            ->orderBy('fecha_vencimiento')
            ->get();

        return view('medicamentos.show', [
            'medicamento' => $medicamento->load(['categoria', 'listaControl']),
            'lotes'       => $lotes,
        ]);
    }

    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', [
            'medicamento' => $medicamento,
            'categorias'  => Categoria::where('activo', true)->orderBy('nombre')->get(),
            'listas'      => ListaControl::where('activa', true)->orderBy('codigo')->get(),
        ]);
    }

    public function update(UpdateMedicamentoRequest $request, Medicamento $medicamento)
    {
        $datos = $request->validated();
        if ($datos['condicion_venta'] !== 'controlado') {
            $datos['lista_control_id'] = null;
        }

        $medicamento->update($datos);

        return redirect()->route('medicamentos.show', $medicamento)
            ->with('ok', 'Datos del medicamento actualizados.');
    }

    public function cambiarEstado(Medicamento $medicamento)
    {
        $medicamento->update(['activo' => ! $medicamento->activo]);

        if ($medicamento->activo) {
            return back()->with('ok', 'Medicamento activado.');
        }

        $stockVigente = $medicamento->stock_vigente;
        $aviso = 'Medicamento desactivado (baja lógica aplicada).';
        if ($stockVigente > 0) {
            $aviso .= " Aún cuenta con $stockVigente unidades en lotes vigentes.";
        }

        return back()->with('ok', $aviso);
    }


    /**
     * Remove the specified resource from storage.
     */
    
}

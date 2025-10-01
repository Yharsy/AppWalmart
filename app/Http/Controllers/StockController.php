<?php

namespace App\Http\Controllers;

use App\Models\MovimientoStock;
use App\Models\Product;
use Illuminate\Http\Request;

class MovimientoStockController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));

        $movimientos = MovimientoStock::query()
            ->with('producto:id,name') // ajusta si tu modelo Product usa otro campo
            ->when($q, function ($query) use ($q) {
                $query->where('reason', 'like', "%{$q}%")
                      ->orWhere('note', 'like', "%{$q}%");
            })
            ->orderByDesc('movement_date')
            ->paginate(10)
            ->withQueryString();

        return view('movimientos.index', compact('movimientos', 'q'));
    }

    public function create()
    {
        $productos = Product::orderBy('name')->get(['id', 'name']);
        return view('movimientos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'     => ['required', 'integer', 'exists:products,id'],
            'movement_date'  => ['required', 'date'],
            'reason'         => ['required', 'string', 'max:50'],
            'qty_change'     => ['required', 'numeric'],
            'ref_type'       => ['nullable', 'string', 'max:50'],
            'ref_id'         => ['nullable', 'integer'],
            'note'           => ['nullable', 'string', 'max:255'],
        ]);

        MovimientoStock::create($data);
        return redirect()->route('movimientos.index')->with('ok', 'Movimiento registrado correctamente.');
    }

    public function edit(MovimientoStock $movimiento)
    {
        $productos = Product::orderBy('name')->get(['id', 'name']);
        return view('movimientos.edit', compact('movimiento', 'productos'));
    }

    public function update(Request $request, MovimientoStock $movimiento)
    {
        $data = $request->validate([
            'product_id'     => ['required', 'integer', 'exists:products,id'],
            'movement_date'  => ['required', 'date'],
            'reason'         => ['required', 'string', 'max:50'],
            'qty_change'     => ['required', 'numeric'],
            'ref_type'       => ['nullable', 'string', 'max:50'],
            'ref_id'         => ['nullable', 'integer'],
            'note'           => ['nullable', 'string', 'max:255'],
        ]);

        $movimiento->update($data);
        return redirect()->route('movimientos.index')->with('ok', 'Movimiento actualizado correctamente.');
    }

    public function destroy(MovimientoStock $movimiento)
    {
        $movimiento->delete();
        return back()->with('ok', 'Movimiento eliminado.');
    }
}
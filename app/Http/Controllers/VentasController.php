<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\User;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));

        $ventas = Venta::query()
            ->with(['user:id,name']) // solo usamos la relación con User
            ->when($q, function ($query) use ($q) {
                $query->where('total', 'like', "%{$q}%")
                      ->orWhere('status', 'like', "%{$q}%");
            })
            ->orderByDesc('sale_date')
            ->paginate(10)
            ->withQueryString();

        return view('ventas.index', compact('ventas', 'q'));
    }

    public function create()
    {
        $usuarios = User::orderBy('name')->get(['id','name']);
        return view('ventas.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'     => ['required','integer','exists:users,id'],
            'customer_id' => ['required','integer'], // solo validamos como entero
            'sale_date'   => ['required','date'],
            'status'      => ['required','string','max:50'],
            'total'       => ['required','numeric','min:0'],
        ]);

        Venta::create($data);
        return redirect()->route('ventas.index')->with('ok', 'Venta registrada correctamente.');
    }

    public function edit(Venta $venta)
    {
        $usuarios = User::orderBy('name')->get(['id','name']);
        return view('ventas.edit', compact('venta','usuarios'));
    }

    public function update(Request $request, Venta $venta)
    {
        $data = $request->validate([
            'user_id'     => ['required','integer','exists:users,id'],
            'customer_id' => ['required','integer'],
            'sale_date'   => ['required','date'],
            'status'      => ['required','string','max:50'],
            'total'       => ['required','numeric','min:0'],
        ]);

        $venta->update($data);
        return redirect()->route('ventas.index')->with('ok', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();
        return back()->with('ok', 'Venta eliminada.');
    }
}
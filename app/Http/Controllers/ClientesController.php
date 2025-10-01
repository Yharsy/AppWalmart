<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));

        $clientes = Cliente::query()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('phone', 'like', "%{$q}%")
                      ->orWhere('address', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes', 'q'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:100'],
            'phone'      => ['required', 'string', 'max:20'],
            'address'    => ['required', 'string', 'max:255'],
            'created_at' => ['required', 'date'],
        ]);

        Cliente::create($data);
        return redirect()->route('clientes.index')->with('ok', 'Cliente registrado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:100'],
            'phone'      => ['required', 'string', 'max:20'],
            'address'    => ['required', 'string', 'max:255'],
            'created_at' => ['required', 'date'],
        ]);

        $cliente->update($data);
        return redirect()->route('clientes.index')->with('ok', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return back()->with('ok', 'Cliente eliminado.');
    }
}
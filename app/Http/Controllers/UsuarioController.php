<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q'));

        $usuarios = Usuario::query()
            ->when($q, fn($qr) =>
                $qr->where('name','like',"%{$q}%")
                   ->orWhere('email','like',"%{$q}%")
            )
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('usuarios.index', compact('usuarios','q'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255','unique:tb_usuarios,email'],
            'password' => ['required','string','min:6','confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('ok','Usuario creado.');
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $data = $request->validate([
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('tb_usuarios','email')->ignore($usuario->id,'id')],
            'password' => ['nullable','string','min:6','confirmed'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('ok','Usuario actualizado.');
    }

public function destroy(Usuario $usuario)
{
    if ($usuario->ventas()->exists()) {
        return back()->with('err','No se puede eliminar: el usuario tiene ventas asociadas.');
    }

    try {
        $usuario->delete();
        return back()->with('ok','Usuario eliminado.');
    } catch (QueryException $e) {
        return back()->with('err','No se pudo eliminar el usuario (restricción de integridad).');
    }
}
}
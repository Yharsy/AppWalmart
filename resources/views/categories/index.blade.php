@extends('layouts.app')
@section('title','Categorías')

@section('content')
  <section class="hero"><h1>Categorías</h1></section>

  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <a class="btn" href="{{ route('categories.create') }}">+ Nueva</a>
      </div>
    </div>

    <div class="panel-body">
      @if (session('ok'))
        <div style="background:#ecfdf5;border:1px solid #10b98133;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('ok') }}
        </div>
      @endif
      @if (session('err'))
        <div style="background:#fef2f2;border:1px solid #fecaca;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('err') }}
        </div>
      @endif

      <form method="get" style="margin-bottom:14px; display:flex; gap:10px;">
        <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Buscar por nombre">
        <button class="btn secondary" type="submit">Buscar</button>
      </form>

      <div style="overflow:auto;">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th style="width:220px">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $c)
              <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td style="display:flex; gap:8px;">
                  <a class="btn secondary" href="{{ route('categories.edit',$c) }}">Editar</a>
                  <form method="post" action="{{ route('categories.destroy',$c) }}"
                        onsubmit="return confirm('¿Eliminar categoría?');">
                    @csrf @method('DELETE')
                    <button class="btn" style="background:#ef4444">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="3" style="color:#64748b;padding:16px">Sin resultados.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div style="margin-top:14px;">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
@endsection

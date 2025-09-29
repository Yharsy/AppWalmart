@extends('layouts.app')
@section('title','Productos')

@section('content')
  <section class="hero"><h1>Productos</h1></section>

  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <a class="btn" href="{{ route('products.create') }}">+ Nuevo</a>
      </div>
    </div>

    <div class="panel-body">
      @if (session('ok'))
        <div style="background:#ecfdf5;border:1px solid #10b98133;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('ok') }}
        </div>
      @endif

      <form method="get" style="margin-bottom:14px; display:flex; gap:10px;">
        <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Buscar por nombre o SKU">
        <button class="btn secondary" type="submit">Buscar</button>
      </form>

      <div style="overflow:auto;">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>SKU</th>
              <th>Precio</th>
              <th>Categoría</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($products as $p)
              <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->sku }}</td>
                <td>Q {{ number_format($p->price,2) }}</td>
                <td>{{ optional($p->category)->name }}</td>
                <td style="display:flex; gap:8px;">
                  <a class="btn secondary" href="{{ route('products.edit',$p) }}">Editar</a>
                  <form method="post" action="{{ route('products.destroy',$p) }}"
                        onsubmit="return confirm('¿Eliminar producto?')">
                    @csrf @method('DELETE')
                    <button class="btn" style="background:#ef4444">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" style="color:#64748b;padding:16px">Sin resultados.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div style="margin-top:14px;">
        {{ $products->links() }}
      </div>
    </div>
  </div>
@endsection

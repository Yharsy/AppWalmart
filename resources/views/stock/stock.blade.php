@extends('layouts.app')
@section('title', isset($movimiento) ? 'Editar movimiento' : 'Nuevo movimiento')

@section('content')
  <section class="hero">
    <h1>{{ isset($movimiento) ? 'Editar movimiento #' . $movimiento->id : 'Nuevo movimiento' }}</h1>
  </section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ isset($movimiento) ? route('movimientos.update', $movimiento) : route('movimientos.store') }}" style="display:grid; gap:12px;">
        @csrf
        @if(isset($movimiento)) @method('PUT') @endif

        <div style="display:grid; gap:12px; max-width:640px;">
          <label>
            <span>Producto</span>
            <select class="input" name="product_id" required>
              <option value="">-- Selecciona --</option>
              @foreach ($productos as $p)
                <option value="{{ $p->id }}"
                  @selected(old('product_id', $movimiento->product_id ?? null) == $p->id)>{{ $p->name }}</option>
              @endforeach
            </select>
          </label>

          <input class="input" name="movement_date" value="{{ old('movement_date', $movimiento->movement_date ?? '') }}" type="datetime-local" required>
          <input class="input" name="qty_change" value="{{ old('qty_change', $movimiento->qty_change ?? '') }}" type="number" step="1" placeholder="Cantidad" required>
          <input class="input" name="reason" value="{{ old('reason', $movimiento->reason ?? '') }}" placeholder="Motivo" required>
          <input class="input" name="ref_type" value="{{ old('ref_type', $movimiento->ref_type ?? '') }}" placeholder="Tipo de referencia">
          <input class="input" name="ref_id" value="{{ old('ref_id', $movimiento->ref_id ?? '') }}" type="number" placeholder="ID de referencia">
          <input class="input" name="note" value="{{ old('note', $movimiento->note ?? '') }}" placeholder="Nota">

          @foreach (['product_id','movement_date','qty_change','reason','ref_type','ref_id','note'] as $f)
            @error($f)<div class="err">{{ $message }}</div>@enderror
          @endforeach
        </div>

        <div style="display:flex; gap:10px;">
          <button class="btn">{{ isset($movimiento) ? 'Actualizar' : 'Guardar' }}</button>
          <a class="btn secondary" href="{{ route('movimientos.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <section class="hero" style="margin-top:40px;">
    <h1>Movimientos de Stock</h1>
  </section>

  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <a class="btn" href="{{ route('movimientos.create') }}">+ Nuevo</a>
      </div>
    </div>

    <div class="panel-body">
      @if (session('ok'))
        <div style="background:#ecfdf5;border:1px solid #10b98133;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('ok') }}
        </div>
      @endif

      <form method="get" style="margin-bottom:14px; display:flex; gap:10px;">
        <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Buscar por motivo o nota">
        <button class="btn secondary" type="submit">Buscar</button>
      </form>

      <div style="overflow:auto;">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Producto</th>
              <th>Fecha</th>
              <th>Cantidad</th>
              <th>Motivo</th>
              <th>Referencia</th>
              <th>Nota</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($movimientos as $m)
              <tr>
                <td>{{ $m->id }}</td>
                <td>{{ $m->producto->name ?? '—' }}</td>
                <td>{{ $m->movement_date }}</td>
                <td>{{ $m->qty_change }}</td>
                <td>{{ $m->reason }}</td>
                <td>{{ $m->ref_type }} #{{ $m->ref_id }}</td>
                <td>{{ $m->note }}</td>
                <td style="display:flex; gap:8px;">
                  <a class="btn secondary" href="{{ route('movimientos.edit',$m) }}">Editar</a>
                  <form method="post" action="{{ route('movimientos.destroy',$m) }}"
                        onsubmit="return confirm('¿Eliminar movimiento?')">
                    @csrf @method('DELETE')
                    <button class="btn" style="background:#ef4444">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="8" style="color:#64748b;padding:16px">Sin resultados.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div style="margin-top:14px;">
        {{ $movimientos->links() }}
      </div>
    </div>
  </div>
@endsection
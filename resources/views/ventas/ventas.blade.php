@extends('layouts.app')
@section('title', isset($venta) ? 'Editar venta' : 'Nueva venta')

@section('content')
  <section class="hero">
    <h1>{{ isset($venta) ? 'Editar venta #' . $venta->id : 'Nueva venta' }}</h1>
  </section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ isset($venta) ? route('ventas.update', $venta) : route('ventas.store') }}" style="display:grid; gap:12px;">
        @csrf
        @if(isset($venta)) @method('PUT') @endif

        <div style="display:grid; gap:12px; max-width:640px;">
          <label>
            <span>Usuario</span>
            <select class="input" name="user_id" required>
              <option value="">-- Selecciona --</option>
              @foreach ($usuarios as $u)
                <option value="{{ $u->id }}"
                  @selected(old('user_id', $venta->user_id ?? null) == $u->id)>{{ $u->name }}</option>
              @endforeach
            </select>
          </label>

          <input class="input" name="customer_id" value="{{ old('customer_id', $venta->customer_id ?? '') }}" placeholder="ID del cliente" required>
          <input class="input" name="sale_date" value="{{ old('sale_date', $venta->sale_date ?? '') }}" type="datetime-local" required>
          <input class="input" name="status" value="{{ old('status', $venta->status ?? '') }}" placeholder="Estado (COMPLETADA, BORRADOR)" required>
          <input class="input" name="total" value="{{ old('total', $venta->total ?? '') }}" type="number" step="0.01" min="0" placeholder="Total" required>

          @foreach (['user_id','customer_id','sale_date','status','total'] as $f)
            @error($f)<div class="err">{{ $message }}</div>@enderror
          @endforeach
        </div>

        <div style="display:flex; gap:10px;">
          <button class="btn">{{ isset($venta) ? 'Actualizar' : 'Guardar' }}</button>
          <a class="btn secondary" href="{{ route('ventas.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <section class="hero" style="margin-top:40px;">
    <h1>Ventas</h1>
  </section>

  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <a class="btn" href="{{ route('ventas.create') }}">+ Nueva</a>
      </div>
    </div>

    <div class="panel-body">
      @if (session('ok'))
        <div style="background:#ecfdf5;border:1px solid #10b98133;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('ok') }}
        </div>
      @endif

      <form method="get" style="margin-bottom:14px; display:flex; gap:10px;">
        <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Buscar por total o estado">
        <button class="btn secondary" type="submit">Buscar</button>
      </form>

      <div style="overflow:auto;">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Cliente ID</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Total</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($ventas as $v)
              <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->user->name ?? '—' }}</td>
                <td>{{ $v->customer_id }}</td>
                <td>{{ $v->sale_date }}</td>
                <td>{{ $v->status }}</td>
                <td>Q {{ number_format($v->total,2) }}</td>
                <td style="display:flex; gap:8px;">
                  <a class="btn secondary" href="{{ route('ventas.edit',$v) }}">Editar</a>
                  <form method="post" action="{{ route('ventas.destroy',$v) }}"
                        onsubmit="return confirm('¿Eliminar venta?')">
                    @csrf @method('DELETE')
                    <button class="btn" style="background:#ef4444">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" style="color:#64748b;padding:16px">Sin resultados.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div style="margin-top:14px;">
        {{ $ventas->links() }}
      </div>
    </div>
  </div>
@endsection
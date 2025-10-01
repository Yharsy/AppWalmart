@extends('layouts.app')
@section('title', isset($cliente) ? 'Editar cliente' : 'Nuevo cliente')

@section('content')
  <section class="hero">
    <h1>{{ isset($cliente) ? 'Editar cliente #' . $cliente->id : 'Nuevo cliente' }}</h1>
  </section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ isset($cliente) ? route('clientes.update', $cliente) : route('clientes.store') }}" style="display:grid; gap:12px;">
        @csrf
        @if(isset($cliente)) @method('PUT') @endif

        <div style="display:grid; gap:12px; max-width:640px;">
          <input class="input" name="name" value="{{ old('name', $cliente->name ?? '') }}" placeholder="Nombre" required>
          <input class="input" name="email" value="{{ old('email', $cliente->email ?? '') }}" type="email" placeholder="Correo" required>
          <input class="input" name="phone" value="{{ old('phone', $cliente->phone ?? '') }}" placeholder="Teléfono" required>
          <input class="input" name="address" value="{{ old('address', $cliente->address ?? '') }}" placeholder="Dirección" required>
          <input class="input" name="created_at" value="{{ old('created_at', $cliente->created_at ?? '') }}" type="datetime-local" required>

          @foreach (['name','email','phone','address','created_at'] as $f)
            @error($f)<div class="err">{{ $message }}</div>@enderror
          @endforeach
        </div>

        <div style="display:flex; gap:10px;">
          <button class="btn">{{ isset($cliente) ? 'Actualizar' : 'Guardar' }}</button>
          <a class="btn secondary" href="{{ route('clientes.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>

  <section class="hero" style="margin-top:40px;">
    <h1>Clientes</h1>
  </section>

  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <a class="btn" href="{{ route('clientes.create') }}">+ Nuevo</a>
      </div>
    </div>

    <div class="panel-body">
      @if (session('ok'))
        <div style="background:#ecfdf5;border:1px solid #10b98133;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
          {{ session('ok') }}
        </div>
      @endif

      <form method="get" style="margin-bottom:14px; display:flex; gap:10px;">
        <input class="input" type="text" name="q" value="{{ $q }}" placeholder="Buscar por nombre, correo o teléfono">
        <button class="btn secondary" type="submit">Buscar</button>
      </form>

      <div style="overflow:auto;">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($clientes as $c)
              <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->phone }}</td>
                <td>{{ $c->address }}</td>
                <td>{{ $c->created_at }}</td>
                <td style="display:flex; gap:8px;">
                  <a class="btn secondary" href="{{ route('clientes.edit',$c) }}">Editar</a>
                  <form method="post" action="{{ route('clientes.destroy',$c) }}"
                        onsubmit="return confirm('¿Eliminar cliente?')">
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
        {{ $clientes->links() }}
      </div>
    </div>
  </div>
@endsection
@extends('layouts.app')
@section('title','Nuevo usuario')

@section('content')
  <section class="hero"><h1>Nuevo usuario</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('usuarios.store') }}" style="display:grid; gap:12px;">
        @include('usuarios._form')
        <div style="display:flex; gap:10px;">
          <button class="btn">Guardar</button>
          <a class="btn secondary" href="{{ route('usuarios.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection

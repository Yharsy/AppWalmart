@extends('layouts.app')
@section('title','Editar usuario')

@section('content')
  <section class="hero"><h1>Editar: {{ $usuario->name }}</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('usuarios.update',$usuario) }}" style="display:grid; gap:12px;">
        @method('PUT')
        @include('usuarios._form', ['usuario'=>$usuario])
        <div style="display:flex; gap:10px;">
          <button class="btn">Actualizar</button>
          <a class="btn secondary" href="{{ route('usuarios.index') }}">Volver</a>
        </div>
      </form>
    </div>
  </div>
@endsection

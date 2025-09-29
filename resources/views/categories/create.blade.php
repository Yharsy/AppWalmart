@extends('layouts.app')
@section('title','Nueva categoría')

@section('content')
  <section class="hero"><h1>Nueva categoría</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('categories.store') }}" style="display:grid; gap:12px;">
        @include('categories._form')
        <div style="display:flex; gap:10px;">
          <button class="btn">Guardar</button>
          <a class="btn secondary" href="{{ route('categories.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection

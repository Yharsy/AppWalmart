@extends('layouts.app')
@section('title','Nuevo producto')

@section('content')
  <section class="hero"><h1>Nuevo producto</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('products.store') }}" style="display:grid; gap:12px;">
        @include('products._form')
        <div style="display:flex; gap:10px;">
          <button class="btn">Guardar</button>
          <a class="btn secondary" href="{{ route('products.index') }}">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection

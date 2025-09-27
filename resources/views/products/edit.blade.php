@extends('layouts.app')
@section('title','Editar producto')

@section('content')
  <section class="hero"><h1>Editar: {{ $product->name }}</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('products.update',$product) }}" style="display:grid; gap:12px;">
        @method('PUT')
        @include('products._form', ['product'=>$product])
        <div style="display:flex; gap:10px;">
          <button class="btn">Actualizar</button>
          <a class="btn secondary" href="{{ route('products.index') }}">Volver</a>
        </div>
      </form>
    </div>
  </div>
@endsection

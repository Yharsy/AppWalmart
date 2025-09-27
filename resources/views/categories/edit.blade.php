@extends('layouts.app')
@section('title','Editar categoría')

@section('content')
  <section class="hero"><h1>Editar: {{ $category->name }}</h1></section>

  <div class="panel">
    <div class="panel-body">
      <form method="post" action="{{ route('categories.update',$category) }}" style="display:grid; gap:12px;">
        @method('PUT')
        @include('categories._form', ['category'=>$category])
        <div style="display:flex; gap:10px;">
          <button class="btn">Actualizar</button>
          <a class="btn secondary" href="{{ route('categories.index') }}">Volver</a>
        </div>
      </form>
    </div>
  </div>
@endsection

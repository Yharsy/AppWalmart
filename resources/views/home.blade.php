@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
  <!-- HERO -->
  <section class="hero">
    <h1>CRUD de productos</h1>
  </section>

  <!-- PANEL PRINCIPAL -->
  <div class="panel">
    <div class="panel-header">
      <h2>Listado / Acciones</h2>
      <div class="panel-actions">
        <button class="btn">+ Nuevo</button>
        <button class="btn secondary">Exportar</button>
      </div>
    </div>

    <section class="carousel carousel--contain" id="hero-carousel">

  <div class="carousel-track">
    {{-- Slide 1 --}}
    <div class="carousel-slide is-active">
      <img src="{{ asset('img/slide1.png') }}" alt="Oferta 1" />
    </div>

    {{-- Slide 2 --}}
    <div class="carousel-slide">
      <img src="{{ asset('img/slide2.png') }}" alt="Oferta 2" />
    </div>

    {{-- Slide 3 --}}
    <div class="carousel-slide">
      <img src="{{ asset('img/slide3.png') }}" alt="Oferta 3" />
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-btn prev" aria-label="Anterior">‹</button>
  <button class="carousel-btn next" aria-label="Siguiente">›</button>

  <!-- Bullets -->
  <div class="carousel-dots" aria-label="Indicadores"></div>
</section>
  </div>
@endsection

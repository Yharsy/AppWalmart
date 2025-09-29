<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Panel')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="">


  <!-- NAVBAR -->
  <header class="navbar">
    <div class="nav-wrap">
      <div class="brand">
        <!-- coloca tu logo en /public/images/logo.svg o .png -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <span>Walmart Guatemala</span>
      </div>
      <nav class="nav-links">
        <a href="{{ route('products.index') }}"
        class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
        Productos
        </a>

        <a href="#">Ventas</a>

        <a href="{{ route('categories.index') }}"
        class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
        Categoría
        </a>


        <a href="{{ route('usuarios.index') }}"
           class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
          Usuarios
        </a>

        <a href="#">Stock</a>

        <!--  Botones nuevos -->
       
        <a href="" class="btn-nav">
          Mi cuenta
        </a>
       
      </nav>
    </div>
  </header>

  <!-- CONTENIDO -->
  <main class="content">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="footer-wrap">
      <div>
        <h3>Redes sociales</h3>
        <p>Instagram: <strong>@walmart.gt</strong></p>
      </div>
      <div>
        <h3>Contáctanos</h3>
        <p>Teléfono: <strong>+502 2344 5586</strong></p>
      </div>
    </div>
  </footer>

</body>
</html>

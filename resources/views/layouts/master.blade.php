
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema para el Control de Visitas e incidencias PCR en Granja Boraure C.A">
  <meta name="author" content="Creative Tim - Luis Rojas">
  <title>GBPCR 1.0 | @yield('title-page')</title>

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/gbapp.css') }}" type="text/css">

  @yield('additionals-css')

</head>

<body>

   {{-- Menu Lateral --}}
   @include('layouts.includes.frame.my_sidebar')

    
  <!-- Main content -->
  <div class="main-content" id="app">
  
  <!-- Topnav -->
  @include('layouts.includes.frame.my_navbar')

  {{-- breadcrumbs --}}
  @include('layouts.includes.frame.my_breadcrumbs')

  <!-- Page content -->
  <div class="container-fluid mt--6">

    {{-- Mensajes de Estatus y Error --}}
    @yield('message')

    {{-- Contenido de la Pagina --}}
    @yield('content')
    
    {{-- Footer --}}
    @include('layouts.includes.frame.my_footer')
    
  </div>
  <!--End Main COntent-->
  </div>
</body>
   <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('js/gbapp.js') }}"></script>

  {{-- Scripts Adicionales --}}
    @yield('additionals-scripts')
  
  {{-- Script Principal --}}
<script src="{{ asset('js/argon.js') }}"></script>  
</html>
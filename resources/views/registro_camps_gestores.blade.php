@vite(['resources/js/app.js','resources/css/app.css','resources/sass/app.scss'])
<!DOCTYPE html>
<html>
<head>
  <title>Registro de gestores y campañas</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
</head>
<body style="background: rgb(149,71,244);
background: radial-gradient(circle, rgba(149,71,244,1) 0%, rgba(152,35,130,1) 100%);">
  <div class="container">
    <div style="display:flex;justify-content:space-between;">
      <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">
      <div class="p-2">

        <a class="text-purple-800 text-2xl" href="{{route('home')}}"><i class="fa-solid fa-backward"></i>  Volver</a><br>
      </div>
      
    </div>
    <h2 class="text-3xl p-4">Registro de campañas y gestores</h2>
    <!-- framework Vue.js -->
    
    <div id="app">
      <div class="grid grid-cols-3 border-2 mb-4 p-3 justify-between">
        <h3 class="mb-3 text-2xl text-white bg-purple-950 col-span-3 p-2 text-center">Detalles de entidad</h3>
        <div class="flex justify-center">
          {{-- Modal gestor --}}
          <modal-gestor/>
          {{-- Modal componente --}}
        </div>
        {{-- Modal campaña --}}
        <div class="flex justify-center">
          
          <modal-camp/>
        </div>

        <div class="flex justify-center">
          
          <modal-componente/>
        </div>
      </div>
      <div class="p-3 border-2">
        <h2 class="text-2xl border-2 bg-purple-950 text-white p-2">Datos de busqueda</h2>
        {{-- Tabla de busqueda con vue --}}
        <tabla-acciones/>
      </div>
    </div>
    
  </body>
  <script src="{{ asset('js/app.js') }}"></script>
</html>
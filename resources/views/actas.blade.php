@vite(['resources/js/app.js','resources/css/app.css'])

<!DOCTYPE html>
<html>
<head>
  <title>Acta de Responsabilidad de Equipos de Trabajo</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{asset('images/americas.png')}}" type="image/png">
</head>
<body style="background-image:url('{{asset('images/5556661.jpg')}}');">
  <div class="bg-purple-200 p-3 w-5/6 mx-auto">
    <div style="display:flex;justify-content:space-between;">
      <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">

    </div>
    
    <h2 class="text-4xl">ACTAS</h2>
    
    
    <!-- framework Vue.js -->
    
    <div id="app">
      <div>
        <navbar-actas/>
      </div>
      <label for="option">Seleccione una opción:</label>
      <select id="option" v-model.number="seleccion_operacion" class="mt-2 p-2 rounded-md bg-purple-50 bg-opacity-70">
        {{-- <option value="1">ACTA DE RESPONSABILIDAD AL GESTOR</option> --}}
        <option class="mt-2 p-3" value="2">ACTA DE CAMBIO A INVENTARIO DE OPERACION</option>
        <option class="mt-2 p-3" value="3">ACTA DE RETORNOS DE EQUIPO</option>
      </select>
      <!-- Componentes de formularios -->
      <form-gestor class="p-2" v-if="seleccion_operacion===1"></form-gestor>
      <form-operacion  class="p-2" v-if="seleccion_operacion===2"></form-operacion>
      <form-retorno  class="p-2" v-if="seleccion_operacion===3"></form-retorno>
    </div>

</body>
{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</html>
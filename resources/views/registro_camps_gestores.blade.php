@extends('layouts.app')

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

        <a class="enlaces" href="{{route('home')}}"><i class="fa-solid fa-backward"></i>  Volver</a><br>
      </div>
      
    </div>
    
    <h2>Registro de campañas y gestores</h2>
    <!-- framework Vue.js -->
    
    <div id="app">
      <div class="input-group mb-3 p-3" style="display: flex; flex-direction:row;justify-content:space-around">
        <div>
          {{-- Modal gestor --}}
          <modal-gestor/>
          {{-- Modal componente --}}
        </div>
        {{-- Modal campaña --}}
        <div>
          
          <modal-camp/>
        </div>
        <modal-componente/>
      </div>
      <div class="p-3">
        <h2>Datos de busqueda</h2>
        {{-- Tabla de busqueda con vue --}}
        <tabla-acciones/>
      </div>
    </div>
    
  </body>
  <script src="{{ asset('js/app.js') }}"></script>
</html>
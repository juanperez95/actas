@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
  <title>Registro de gestores y campañas</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container">
    <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">
    
    <h2>Registro de campañas y gestores</h2>
    
    
    <!-- framework Vue.js -->
    
    <div id="app">
      <div class="container" style="display: flex; flex-direction:row;justify-content:space-around">
        <div>
          {{-- Modal gestor --}}
          <modal-gestor/>
        </div>
        {{-- Modal campaña --}}
        <modal-camp/>
      </div>
      <div class="container p-3">
        <h2>Datos de busqueda</h2>
        {{-- Tabla de busqueda con vue --}}
        <tabla-acciones/>
      </div>
    </div>
    
  </body>
  <script src="{{ asset('js/app.js') }}"></script>
</html>
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
      <modal-gestor/>
    </div>
    
  </body>
  <script src="{{ mix('js/app.js') }}"></script>
</html>
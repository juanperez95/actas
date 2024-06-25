@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
  <title>Acta de Responsabilidad de Equipos de Trabajo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container">
    <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">
    
    <h2>ACTA DE RESPONSABILIDAD DE EQUIPOS DE TRABAJO</h2>
    
    
    <!-- framework Vue.js -->
    
    <label for="option">Seleccione una opción:</label>
    <div id="app">
      <select id="option" v-model.number="seleccion_operacion">
        <option value="1">Gestores</option>
        <option value="2">Operaciones</option>
      </select>
      <!-- Componentes de formularios -->
      <form-gestor v-if="seleccion_operacion===1"></form-gestor>
      <form-operacion  v-if="seleccion_operacion===2"></form-operacion>
    </div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
</html>
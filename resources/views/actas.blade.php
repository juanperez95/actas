@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
  <title>Acta de Responsabilidad de Equipos de Trabajo</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container">
    <div style="display:flex;justify-content:space-between;">
      <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">
      <div>

        <a href="{{route('cerrar_sesion')}}"><i class="fa-solid fa-right-from-bracket"></i>  Cerrar Sesion</a><br>
        <a href="{{route('registro_camps_gestor')}}"><i class="fa-solid fa-gear"></i>  Configuracion Avanzada</a>
      </div>
    </div>
    
    <h2>ACTAS</h2>
    
    
    <!-- framework Vue.js -->
    
    <label for="option">Seleccione una opción:</label>
    <div id="app">
      <select id="option" v-model.number="seleccion_operacion" class="form-select">
        <option value="1">ACTA DE RESPONSABILIDAD AL GESTOR</option>
        <option value="2">ACTA DE CAMBIO A INVENTARIO DE OPERACION</option>
        <option value="3">ACTA DE RETORNOS DE EQUIPO</option>
      </select>
      <!-- Componentes de formularios -->
      <form-gestor v-if="seleccion_operacion===1"></form-gestor>
      <form-operacion  v-if="seleccion_operacion===2"></form-operacion>
      <form-retorno  v-if="seleccion_operacion===3"></form-retorno>
    </div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
<!DOCTYPE html>
<html>
<head>
  <title>Acta de Responsabilidad de Equipos de Trabajo</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  <div class="container">
  <img src="{{ asset('images/americas.png') }}" alt="Descripción de la imagen" class="logo">

    <h2>ACTA DE RESPONSABILIDAD DE EQUIPOS DE TRABAJO</h2>

    <label for="option">Seleccione una opción:</label>
    <select id="option">
      <option value="">Seleccione una opción</option>
      <option value="gestores">Gestores</option>
      <option value="operaciones">Operaciones</option>
    </select>

    <div id="gestores" class="hidden">
      <p>Señor <input type="text" placeholder="Ingrese el nombre"></p>
      <p>CC. <input type="text" placeholder="Ingrese el número de CC"></p>
      <p>Correo: <input type="email" placeholder="Ingrese el correo"></p>
      <p>Respetada Señor <input type="text" placeholder="Ingrese el nombre"></p>
      <p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado al gestor <input type="text" placeholder="Ingrese el gestor"></p>
      <p>Definiciones:</p>
      <ul>
        <li>Motivo de Solicitud <input type="text" placeholder="Ingrese el motivo"></li>
        <li>Operación Solicitante <input type="text" placeholder="Ingrese la operación"></li>
      </ul>
      <p>Fecha de entrega del activo: <input type="date"></p>
      <p>Activos relacionados:</p>
      <table>
        <tr>
          <th>Elemento</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento"></td>
          <td><input type="text" placeholder="Ingrese el serial"></td>
          <td><input type="text" placeholder="Ingrese el activo"></td>
          <td><input type="text" placeholder="Ingrese las observaciones"></td>
        </tr>
      </table>
      <p>Observación: <textarea placeholder="Ingrese la observación"></textarea></p>
      <p>Con la firma de esta acta el gestor que solicita el elemento se hará responsable de este en su totalidad hasta que sea entregada a la operación la cual deberá de ser certificada por un acta de entrega similar, firmada por la operación y cargada a GLPI.</p>
      <table>
        <tr>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
            <p>Firma de quien entrega: Gestor de Soluciones Tecnológica</p>
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
          <td>
            <p>Firma de quien recibe: Gestor de Soluciones Tecnológica</p>
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
        </tr>
      </table>
    </div>

    <div id="operaciones" class="hidden">
      <p>Señor <input type="text" placeholder="Ingrese el nombre">.</p>
      <p>CC. <input type="text" placeholder="Ingrese el número de CC"></p>
      <p>Correo: <input type="email" placeholder="Ingrese el correo"></p>
      <p>Respetada Señor <input type="text" placeholder="Ingrese el nombre"></p>
      <p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado a la operación retirando el activo anterior según el caso: <input type="text" placeholder="Ingrese el caso"></p>
      <p>Definiciones:</p>
      <ul>
        <li>Motivo de Solicitud <input type="text" placeholder="Ingrese el motivo"></li>
        <li>Operación Solicitante <input type="text" placeholder="Ingrese la operación"></li>
        <li>Estado de Entrega del Nuevo Activo <input type="text" placeholder="Ingrese el estado"></li>
        <li>Estado de Recibido del Activo Recogido <input type="text" placeholder="Ingrese el estado"></li>
      </ul>
      <p>Fecha de entrega del activo: <input type="date"></p>
      <p>Activos relacionados:</p>
      <table>
        <tr>
          <th>Elemento Recogido</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento"></td>
          <td><input type="text" placeholder="Ingrese el serial"></td>
          <td><input type="text" placeholder="Ingrese el activo"></td>
          <td><input type="text" placeholder="Ingrese las observaciones"></td>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento"></td>
          <td><input type="text" placeholder="Ingrese el serial"></td>
          <td><input type="text" placeholder="Ingrese el activo"></td>
          <td><input type="text" placeholder="Ingrese las observaciones"></td>
        </tr>
      </table>
      <table>
        <tr>
          <th>Elemento Entregado</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento"></td>
          <td><input type="text" placeholder="Ingrese el serial"></td>
          <td><input type="text" placeholder="Ingrese el activo"></td>
          <td><input type="text" placeholder="Ingrese las observaciones"></td>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento"></td>
          <td><input type="text" placeholder="Ingrese el serial"></td>
          <td><input type="text" placeholder="Ingrese el activo"></td>
          <td><input type="text" placeholder="Ingrese las observaciones"></td>
        </tr>
      </table>
      <p>Observación: <textarea placeholder="Ingrese la observación"></textarea></p>
      <hr>
      <table>
        <tr>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
            <p>Firma de quien entrega</p>
            <p>Gestor de Soluciones Tecnológica</p>
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
          <td>
            <p>Firma Operación</p>
            <p>Cargo: <input type="text" placeholder="Ingrese el cargo"></p>
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
        </tr>
      </table>
    </div>
  </div>

  <script>
    const optionSelect = document.getElementById('option');
    const gestoresDiv = document.getElementById('gestores');
    const operacionesDiv = document.getElementById('operaciones');

    optionSelect.addEventListener('change', function() {
      if (optionSelect.value === 'gestores') {
        gestoresDiv.classList.remove('hidden');
        operacionesDiv.classList.add('hidden');
      } else if (optionSelect.value === 'operaciones') {
        gestoresDiv.classList.add('hidden');
        operacionesDiv.classList.remove('hidden');
      } else {
        gestoresDiv.classList.add('hidden');
        operacionesDiv.classList.add('hidden');
      }
    });
  </script>
</body>
</html>
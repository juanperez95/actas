<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTA DE RESPONSABILIDAD DE EQUIPOS DE TRABAJO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 12px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .signature {
            margin-top: 40px;
        }
        p{
            font-size:14px;
        }
    </style>
</head>
<body>

<h3 align="center">ACTA DE RESPONSABILIDAD DE EQUIPOS DE TRABAJO</h3>

<p>Señor(@) <b>{{$nombre_encargado}}</b></p>
<p>CC: <b>{{$documento_encargado}}</b></p>
<p>Correo: <b>{{$correo_encargado}}</b></p>

<p>Respetada Señor(@) <b>{{$nombre_encargado}}</b></p>

<p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado a la operación retirando el activo anterior según el caso: <strong>{{$n_caso}}</strong></p>

<h2>Definiciones:</h2>

<p>Motivo de Solicitud: <b>{{$motivo_solicitud}}</b></p>
<p>Operación Solicitante:  <b>{{$op_solicitante}}</b></p>
<p>Estado de Entrega del Nuevo Activo: <b>{{$est_entrega_nuevoActivo}}</b></p>
<p>Estado de Recibido del Activo Recogido: <b>{{$est_recibido_activo}}</b></p>

<p>Fecha de entrega del activo: <b>{{$fecha_entrega}}</b></p>

<h2>Activos relacionados:</h2>

<table>
    <thead>
        <tr>
            <th>Elemento Recogido</th>
            <th>Serial</th>
            <th>Activo</th>
            <th>Observaciones (Estado)</th>
        </tr>
    </thead>
    <tbody>
        <!-- Iterar todos los elementos recogidos -->     
        @foreach ($data_recogido as $elemento)      
        <tr>
            <td>{{$elemento['elemento_recogido']}}</td>
            <td>{{$elemento['serial_recogido']}}</td>
            <td>{{$elemento['activo_recogido']}}</td>
            <td>{{$elemento['observaciones_recogido']}}</td>
        </tr>
        @endforeach

    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Elemento Entregado</th>
            <th>Serial</th>
            <th>Activo</th>
            <th>Observaciones (Estado)</th>
        </tr>
    </thead>
    <tbody>
        <!-- Iterar todos los elementos entregados -->
        @foreach ($data_entregado as $entregado)
        
        <tr>
            <td>{{$entregado['elemento_entregado']}}</td>
            <td>{{$entregado['serial_entregado']}}</td>
            <td>{{$entregado['activo_entregado']}}</td>
            <td>{{$entregado['observaciones_entregado']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>Observación: {{$observaciones}}</p>

<div class="signature">
    <p>Firma de quien entrega: __________________________</p>
    <p>Gestor de soluciones tecnologicas</p>
    <p>Nombre Gestor: <b>{{$nombre_gestor}}</b></p>
    <p>Firma Operación: __________________________</p>
    <p>Cargo: <b>{{$cargo_operacion}}</b></p>
    <p>Nombre Operacion: <b>{{$nombre_operacion}}</b></p>
</div>

</body>
</html>

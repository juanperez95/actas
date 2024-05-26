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
        h1, h2, h4 {
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
            font-size:14px
        }
    </style>
</head>
<body>

<h4>ACTA DE RESPONSABILIDAD DE EQUIPOS DE TRABAJO</h4>

<p>Señor (@): <b>{{$nombre_persona}}</b></p>
<p>CC: <b>{{$documento_persona}}</b></p>
<p>Correo: <b>{{$correo_persona}}</b></p>

<p>Respetada Señor (@)</p>

<p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado al gestor: <b>{{$nombre_gestor}}</b></p>

<h2>Definiciones:</h2>

<p>Motivo de Solicitud: <b>{{$motivo_solicitud}}</b></p>
<p>Operación Solicitante: <b>{{$op_solicitante}}</b></p>
<p>Fecha de entrega del activo: <b>{{$fecha_entregaActivo}}</b></p>

<h2>Activos relacionados:</h2>

<table>
    <thead>
        <tr>
            <th>Elemento</th>
            <th>Serial</th>
            <th>Activo</th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
        <!-- Agregar filas según sea necesario -->
        @foreach ($data_elemento as $data)
        
        <tr>
            <td>{{$data['ingreso_elemento']}}</td>
            <td>{{$data['serial_elemento']}}</td>
            <td>{{$data['activo_elemento']}}</td>
            <td>{{$data['observaciones_elemento']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>Observación: Con la firma de esta acta el gestor que solicita el elemento se hará responsable de este en su totalidad hasta que sea entregada a la operación la cual deberá de ser certificada por un acta de entrega similar, firmada por la operación y cargada a GLPI.</p>

<div class="signature">
    <p>Firma de quien entrega: __________________________</p>
    <p>Gestor de Soluciones Tecnológica</p>
    <p>Nombre: <b>{{$nombre_persona}}</b></p>
    <br>
    <p>Firma de quien recibe: __________________________</p>
    <p>Gestor de Soluciones Tecnológica</p>
    <p>Nombre: <b>{{$nombre_gestor}}</b></p>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTA DE RETORNO DE EQUIPOS</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 12px;
        }
        h1, h2, h3 {
            text-align: center;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size:12px;
        }
        th{
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            color: aliceblue;
            background-color: rgb(0, 0, 0);
        }
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        .signature {
            margin-top: 40px;
            display:flex;
            flex-direction:row;
        }
        p{
            font-size:11px;
        }
        .firmas_p{
            font-size: 15px;
        }
    </style>
</head>
<body>
<script src="{{asset('js/styles.js')}}"></script>
<img src="data:image/png;base64,{{$rutaLogo}}" alt="Logo" width="30%">

<h3>ACTA DE RETORNO DE EQUIPOS</h3>

<p>Número de Caso: <b>{{$numeroCaso}}</b></p>
<p>Nombre: <b>{{$nombres}}</b></p>
<p>Campaña: <b>{{$campana}}</b></p>
<p>Correo Personal: <b>{{$correoPersonal}}</b></p>
<p>Correo del Jefe: <b>{{$correoJefe}}</b></p>

<h2>Detalles del Dispositivo</h2>

<table>
    <tr>
        <th>Tipo de Dispositivo</th>
        <td>{{$dispositivo}}</td>
        <th>Tipo de Escritorio</th>
        <td>{{$Tipoescritorio ?? 'N/A'}}</td>
    </tr>
    <tr>
        <th>Serial del Dispositivo</th>
        <td>{{$serialDispositivo}}</td>
        <th>Activo del Dispositivo</th>
        <td>{{$activoDispositivo}}</td>
    </tr>
    <tr>
        <th>Estado del Dispositivo</th>
        <td>{{$estadoDispositivo}}</td>
        <th>Serial del Monitor</th>
        <td>{{$serialMonitor}}</td>
    </tr>
    <tr>
        <th>Activo del Monitor</th>
        <td>{{$activoMonitor}}</td>
        <th>Estado del Monitor</th>
        <td>{{$estadoMonitor}}</td>
    </tr>
</table>

<h2>Periféricos</h2>

<table>
    <tr>
        <th>Ratón</th>
        <td>{{$raton}}</td>
        <th>Estado del Ratón</th>
        <td>{{$estadoRaton ?? 'N/A'}}</td>
    </tr>
    <tr>
        <th>Teclado</th>
        <td>{{$teclado}}</td>
        <th>Estado del Teclado</th>
        <td>{{$estadoTeclado ?? 'N/A'}}</td>
    </tr>
    <tr>
        <th>Diadema</th>
        <td>{{$diadema}}</td>
        <th>Serial de la Diadema</th>
        <td>{{$serialDiadema ?? 'N/A'}}</td>
    </tr>
    <tr>
        <th>Cámara</th>
        <td>{{$camara}}</td>
        <th>Segundo Monitor</th>
        <td>{{$segundoMonitor}}</td>
    </tr>
</table>

@if($segundoMonitor === 'Si')
<h2>Detalles del Segundo Monitor</h2>
<table>
    <tr>
        <th>Serial del Segundo Monitor</th>
        <td>{{$serialMonitor2}}</td>
        <th>Activo del Segundo Monitor</th>
        <td>{{$activoMonitor2}}</td>
    </tr>
</table>
@endif

<h2>Observaciones</h2>
<p>{{$observaciones}}</p>

<div class="signature">
    <table>
        <tr>
            <td>
                <div class="container">
                    <p class="firmas_p">Firma de quien entrega: <img src="data:image/png;base64,{{$ruta1}}" alt="" width="30%"></p>
                    <p class="firmas_p">Nombre: <b>{{$nombres}}</b></p>
                </div>
            </td>
            <td>
                <div class="container">
                    <p class="firmas_p">Firma de quien recibe: <img src="data:image/png;base64,{{$ruta2}}" alt="" width="30%"></p>
                    <p class="firmas_p">Nombre Gestor: <b>{{$nombreRecibe}}</b></p>
                </div>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
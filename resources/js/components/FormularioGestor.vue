<template>
  <div>
    <div id="gestores">
      <p>
        Señor
        <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_persona"/>
      </p>
      <p>
        CC.
        <input type="text" placeholder="Ingrese el número de CC" v-model="form_data.documento_persona"/>
      </p>
      <p>
        Correo:
        <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_persona"/>
      </p>
      <p>
        Respetada Señor
        <b>{{form_data.nombre_persona.toUpperCase()}}</b>
      </p>
      <p>
        El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado al gestor
        <input type="text" placeholder="Ingrese el gestor" v-model="form_data.nombre_gestor"/>
      </p>
      <p>Definiciones:</p>
      <ul>
        <li>
          Motivo de Solicitud
          <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud"/>
        </li>
        <li>
          Operación Solicitante
          <input type="text" placeholder="Ingrese la operación" v-model="form_data.op_solicitante"/>
        </li>
      </ul>
      <p>
        Fecha de entrega del activo:
        <input type="date" v-model="form_data.fecha_entregaActivo"/>
      </p>
      <p>Activos relacionados:</p>
      <table>
        <tr>
          <th>Elemento</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones</th>
        </tr>
        <tr>
          <td>
            <input type="text" placeholder="Ingrese el elemento" v-model="form_data.ingreso_elemento"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_elemento"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_elemento"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_elemento"/>
          </td>
        </tr>
      </table>
      <p>
        Observación:
        <textarea placeholder="Ingrese la observación" v-model="form_data.observaciones"></textarea>
      </p>
      <p>Con la firma de esta acta el gestor que solicita el elemento se hará responsable de este en su totalidad hasta que sea entregada a la operación la cual deberá de ser certificada por un acta de entrega similar, firmada por la operación y cargada a GLPI.</p>
      <table>
        <tr>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
            <p>Firma de quien entrega: Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <input type="text" v-model="form_data.nombre_deEntrega">
            </p>
            <p>
              Firma:
              <input type="file" accept="image/*" />
            </p>
          </td>
          <td>
            <p>Firma de quien recibe: Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_gestor.toUpperCase()}}</b>
            </p>
            <p>
              Firma:
              <input type="file" accept="image/*" />
            </p>
          </td>
        </tr>
      </table>
    </div>
    <div class="container">
      <button class="btn btn-danger mt-2">Generar PDF</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "formulario-gestor",
  data(){
    return {
      form_data:{
        // Datos basicos
        nombre_persona:'',
        documento_persona:'',
        correo_persona:'',
        // Nombre gestor
        nombre_gestor:'',
        // Motivos
        motivo_solicitud:'',
        op_solicitante:'',
        fecha_entregaActivo:'',
        // Datos de elementos y observaciones
        ingreso_elemento:'',
        serial_elemento:'',
        activo_elemento:'',
        observaciones_elemento:'',
        observaciones:'',
        // Nombre de quien entrega e elemento
        nombre_deEntrega:'',
        // Datos de elemento
        data_elemento:[],
      }
    }
  },
  methods: {
    
  },
};
</script>

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
          <th>Acciones</th>
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
            <input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_elemento" @keyup.enter="agregarElementos"/>
          </td>
          <td>
            <button class="btn btn-danger" @click="agregarElementos">Agregar</button>
          </td>
        </tr>
      </table>

      <!-- Lista de elementos agregados -->

      <div class="container p-3">
        <table class="table">
          <thead>
            <tr>
              <th>Elemento</th>
              <th>N° Serial</th>
              <th>N° Activo</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in form_data.data_elemento" :key="data.id">
              <td scope="col">{{data.ingreso_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.serial_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.activo_elemento.toUpperCase()}}</td>
              <td scope="col">
                <button class="btn btn-danger" @click="quitarElementos(data)">x</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p>
        Observación:
        <textarea placeholder="Ingrese la observación" v-model="form_data.observaciones"></textarea>
      </p>
      <p>Con la firma de esta acta el gestor que solicita el elemento se hará responsable de este en su totalidad hasta que sea entregada a la operación la cual deberá de ser certificada por un acta de entrega similar, firmada por la operación y cargada a GLPI.</p>
      <table>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
            <p>Firma de quien entrega: <br>
              Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_persona.toUpperCase()}}</b>
            </p>
            <p>
              Firma:
              <input type="file" accept="image/*" />
            </p>
          </td>
          <td>
            <p>Firma de quien recibe: <br> Gestor de Soluciones Tecnológica</p>
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
      <button class="btn btn-danger mt-2" @click="generarPDFGestor">Generar PDF</button>
    </div>
    <div class="container">
      <a href="" download="" id="enlace"></a>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
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
        observaciones:'',
        // Nombre de quien entrega e elemento
        nombre_deEntrega:'',
        // Datos de elemento
        data_elemento:[],
      }
    }
  },
  methods: {
    generarPDFGestor: async function(){
      // Generar la alerta
      Swal.fire({
          title:'¡Se esta generado el PDF!',
          timer:2000,
          imageUrl: 'https://play-lh.googleusercontent.com/9XKD5S7rwQ6FiPXSyp9SzLXfIue88ntf9sJ9K250IuHTL7pmn2-ZB0sngAX4A2Bw4w',
          imageHeight: 180,
        });
      await axios.post('/PDF_G',this.form_data,{
        responseType:'blob'
      })
      .then((res)=>{
        if(res.status == 200){
          var enlace = document.getElementById('enlace');
          enlace.download = (new Date().getDate().toLocaleString() +'_'+ (new Date().getMonth()+1).toString() +'_'+ new Date().getTime().toString()) + '_' + this.form_data.nombre_gestor.toUpperCase() + '.pdf';
          enlace.href = URL.createObjectURL(res.data);
          enlace.click();
          URL.revokeObjectURL(enlace.href);
        }else{
          Swal.fire({
            title:'¡Oops!',
            text:'Ha ocurrido un error al generar el pdf',
            icon:'error',
          });
        }
      }).catch((err)=>{
        Swal.fire({
          title:'¡Oops!',
          text:'Ha ocurrido un error en la peticion, verifique los campos',
          icon:'error',
        });
      })
    },
    agregarElementos(){
      if(this.form_data.serial_elemento != '' && this.form_data.activo_elemento != ''){
        this.form_data.data_elemento.unshift(
          {
            // Datos de elementos y observaciones
            ingreso_elemento:this.form_data.ingreso_elemento.toUpperCase(),
            serial_elemento:this.form_data.serial_elemento.toUpperCase(),
            activo_elemento:this.form_data.activo_elemento.toUpperCase(),
            observaciones_elemento:this.form_data.observaciones_elemento,
          }  
        );
        this.form_data.ingreso_elemento = '';
        this.form_data.serial_elemento = '';
        this.form_data.activo_elemento = '';
        this.form_data.observaciones_elemento = '';
      }else{
        alert('Llene los campos ACTIVO, SERIAL');
      }
    },
    quitarElementos(elemento){
      for(let elem in this.form_data.data_elemento){
        if(elemento.serial_elemento === this.form_data.data_elemento[elem].serial_elemento){
          this.form_data.data_elemento.splice(elem,1);
        }
      }
    }
  },
};
</script>

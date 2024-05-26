<template>
    <div>
        <div id="operaciones">
      <p>Señor <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_encargado"></p>
      <p>CC. <input type="text" placeholder="Ingrese el número de CC" v-model.number="form_data.documento_encargado"></p>
      <p>Correo: <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_encargado"></p>
      <p>Respetada Señor/a <b>{{form_data.nombre_encargado.toUpperCase()}}</b></p>
      <p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado a la operación retirando el activo anterior según el caso: <input type="text" placeholder="Ingrese el caso" v-model="form_data.n_caso"></p>
      <p>Definiciones:</p>
      <ul>
        <li>Motivo de Solicitud <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud"></li>
        <li>Operación Solicitante <input type="text" placeholder="Ingrese la operación" v-model="form_data.op_solicitante"></li>
        <li>Estado de Entrega del Nuevo Activo <input type="text" placeholder="Ingrese el estado" v-model="form_data.est_entrega_nuevoActivo"></li>
        <li>Estado de Recibido del Activo Recogido <input type="text" placeholder="Ingrese el estado" v-model="form_data.est_recibido_activo"></li>
      </ul>
      <p>Fecha de entrega del activo: <input type="date" v-model="form_data.fecha_entrega"></p>
      <p>Activos relacionados:</p>
      <table>
        <tr>
          <th>Elemento Recogido</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento" v-model="form_data.elemento_recogido"></td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_recogido"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_recogido"></td>
          <td><input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_recogido" @keyup.enter="agregarRecogidos"></td>
          <td>
            <button class="btn btn-danger" @click="agregarRecogidos">Agregar</button>
          </td>
        </tr>
      </table>
        <!-- vista de agregados de equipos recogidos -->
        <div class="container">
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
              <tr v-for="data in form_data.data_recogido" :key="data.id">
                <td scope="col">{{data.elemento_recogido}}</td>
                <td scope="col">{{data.serial_recogido}}</td>
                <td scope="col">{{data.activo_recogido}}</td>
                <td scope="col">
                  <button class="btn btn-danger" @click="quitarRecogidos(data)">x</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Tabla entregados -->
      <table>
        <tr>
          <th>Elemento Entregado</th>
          <th>Serial</th>
          <th>Activo</th>
          <th>Observaciones (Estado)</th>
          <th>Acciones</th>
        </tr>
        <tr>
          <td><input type="text" placeholder="Ingrese el elemento" v-model="form_data.elemento_entregado"></td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_entregado"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_entregado"></td>
          <td><input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_entregado" @keyup.enter="agregarEntregados"></td>
          <td>
            <button @click="agregarEntregados" class="btn btn-danger">Agregar</button>
          </td>
        </tr>
      </table>

      <!-- Vista de elementos entregados -->
      <div class="container">

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
            <tr v-for="data in form_data.data_entregado" :key="data.id">
              <td scope="col">{{data.elemento_entregado}}</td>
              <td scope="col">{{data.serial_entregado}}</td>
              <td scope="col">{{data.activo_entregado}}</td>
              <td scope="col">
                <button class="btn btn-danger" @click="quitarEntregados(data)">x</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <p>Observación: <textarea placeholder="Ingrese la observación" v-model="form_data.observaciones"></textarea></p>
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
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_gestor"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
          <td>
            <p>Firma Operación</p>
            <p>Cargo: <input type="text" placeholder="Ingrese el cargo" v-model="form_data.cargo_operacion"></p>
            <p>Nombre: <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_operacion"></p>
            <p>Firma: <input type="file" accept="image/*"></p>
          </td>
        </tr>
      </table>
      <div class="container">
        <!-- Llamar a la funcion para generar el pdf -->
        <button class="btn btn-danger" @click="generarPDF">Generar PDF</button>
        <a href="#" download="" id="link"></a>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios'

import Swal from 'sweetalert2'


export default{
    name:'form-operacion',
    // Recoger los datos del formulario
    data(){
        return {    
            form_data:{
                // Datos basicos de la persona
                nombre_encargado:'',
                documento_encargado:null,
                correo_encargado:'',
                // N° Caso
                n_caso:'',
                // Motivos
                motivo_solicitud:'',
                op_solicitante:'',
                est_entrega_nuevoActivo:'',
                est_recibido_activo:'',
                // Fecha entrega
                fecha_entrega:'',
                // Datos del equipos recogido
                data_recogido:[],
                // Datos del equipos entregado
                data_entregado:[],
                // observaciones
                observaciones:'',
                // Firmas
                nombre_gestor:'',
                cargo_operacion:'',
                nombre_operacion:'',

            }
        }
    },
    mounted() {
    },
    methods: {
        generarPDF: async function(){
            // Generar la alerta
            Swal.fire({
              title:'¡Se esta generado el PDF!',
              timer:2000,
              imageUrl: 'https://play-lh.googleusercontent.com/9XKD5S7rwQ6FiPXSyp9SzLXfIue88ntf9sJ9K250IuHTL7pmn2-ZB0sngAX4A2Bw4w',
              imageHeight: 180,
            });
            await axios.post('/PDF_OP',this.form_data,{
                responseType:'blob'
            })
            .then((res)=>{
                if(res.status == 200){
                  // Descargar el pdf desde laravel
                  var link = document.getElementById('link');
                  link.download = (new Date().getDate().toLocaleString() +'_'+ (new Date().getMonth()+1).toString() +'_'+ new Date().getTime().toString()) + '_' + this.form_data.cargo_operacion.toUpperCase() + '.pdf';
                  link.href = URL.createObjectURL(res.data);
                  link.click();

                  URL.revokeObjectURL(link.href);

                }else{
                  Swal.fire({
                    title:'¡Oops!',
                    text:'Ha ocurrido un error al generar el pdf',
                    icon:'error',
                  });
                }
            })
            .catch((err)=>{
              Swal.fire({
                    title:'¡Oops!',
                    text:'Ha ocurrido un error en la peticion, verifique los campos',
                    icon:'error',
                  });
            });
            
        },
        // Agregar los elementos recogidos de la operacion
        agregarRecogidos(){
          // Validar que los cmapos no esten vacios
          if(this.form_data.serial_recogido != '' && this.form_data.activo_recogido != ''){
            this.form_data.data_recogido.unshift({
                elemento_recogido:this.form_data.elemento_recogido.toUpperCase(),
                serial_recogido:this.form_data.serial_recogido.toUpperCase(),
                activo_recogido:this.form_data.activo_recogido.toUpperCase(),
                observaciones_recogido:this.form_data.observaciones_recogido,
            });
            this.form_data.elemento_recogido = '';
            this.form_data.serial_recogido = '';
            this.form_data.activo_recogido = '';
            this.form_data.observaciones_recogido = '';
          }else{
            alert('Complete el activo o serial');
          }
        },
        // Quitar elementos recogidos por equivocacion del usuario
        quitarRecogidos(elemento){
          for(let ind in this.form_data.data_recogido){
            if(elemento.serial_recogido === this.form_data.data_recogido[ind].serial_recogido){
              this.form_data.data_recogido.splice(ind,1);
            }
          }

        },

        // Agregar datos del entragado
        agregarEntregados(){
        if(this.form_data.serial_entregado !== '' && this.form_data.activo_entregado !== ''){
          this.form_data.data_entregado.unshift(
            {               
              elemento_entregado:this.form_data.elemento_entregado.toUpperCase(),
              serial_entregado:this.form_data.serial_entregado.toUpperCase(),
              activo_entregado:this.form_data.activo_entregado.toUpperCase(),
              observaciones_entregado:this.form_data.observaciones_entregado,
            }
          );
          this.form_data.elemento_entregado = '';
          this.form_data.serial_entregado = '';
          this.form_data.activo_entregado = '';
          this.form_data.observaciones_entregado = '';
        }else{
          alert('Complete el activo o serial');
        }
        },
        // Quitar elementos entregados
        quitarEntregados(elemento){
          for(let ind in this.form_data.data_entregado){
            if(elemento.serial_entregado === this.form_data.data_entregado[ind].serial_entregado){
              this.form_data.data_entregado.splice(ind,1);
            }
          }
        } 
    },
}
</script>
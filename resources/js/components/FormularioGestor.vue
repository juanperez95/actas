<template>
  <div>
    <div id="gestores">
      <p>
        Señor(a)
        <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_persona" class="form-control"/>
      </p>
      <p>
        CC.
        <input type="number" placeholder="Ingrese el número de CC" v-model="form_data.documento_persona" class="form-control"/>
      </p>
      <p>
        Correo:
        <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_persona" class="form-control"/>
      </p>
      <p>
        El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado al gestor {{cargar1}}
        <span :class="[cargar2]"></span><select class="form-select" v-model="form_data.nombre_gestor" @click="mostrarGestores">
          <option :value="gestor.nombre_gestor" v-for="gestor in lista_gestores" :key="gestor.id">{{gestor.nombre_gestor.toUpperCase()}}</option>
        </select>
      </p>
      <p>Definiciones:</p>
      <ul>
        <li>
          Numero de caso: 
          <input type="text" name="" id="" class="form-control" v-model="form_data.numero_caso" placeholder="Ingrese el numero de caso">
        </li>
        <li>
          Motivo de Solicitud
          <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud" class="form-control"/>
        </li>
        <li>
          Operación Solicitante
          <span :class="[cargar1]"></span><input type="text" placeholder="Ingrese la operación" class="form-select" v-model="form_data.op_solicitante" list="listaOp" @click="mostrarCamps"/>
          
          <datalist id="listaOp">
            <option :value="cam.nombre_camp.toUpperCase()" v-for="cam in lista_camps" :key="cam.id">{{cam.nombre_camp.toUpperCase()}}</option>
          </datalist>
        </li>
      </ul>
      <p>Activos relacionados:</p>
      <!-- Tabla de elementos entregados -->
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
            <select name="" id="" class="form-select" v-model="form_data.ingreso_elemento">
              <option value="Torre">Torre</option>
              <option value="Diadema">Diadema</option>
              <option value="Monitor">Monitor</option>
              <option value="Minitorre">Minitorre</option>
            </select>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_elemento" class="form-control"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_elemento" class="form-control"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_elemento" @keyup.enter="agregarElementos" class="form-control"/>
          </td>
          <td>
            <button class="btn btn-outline-danger" @click="agregarElementos"><i class="fa-solid fa-plus"></i> Agregar</button>
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
                <button class="btn btn-outline-danger" @click="quitarElementos(data)"><i class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Elementos recogidos -->

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
            <select name="" id="" class="form-select" v-model="form_data.ingreso_elemento_r">
              <option value="Torre">Torre</option>
              <option value="Diadema">Diadema</option>
              <option value="Monitor">Monitor</option>
              <option value="Minitorre">Minitorre</option>
            </select>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_elemento_r" class="form-control"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_elemento_r" class="form-control"/>
          </td>
          <td>
            <input type="text" placeholder="Ingrese las observaciones" v-model="form_data.observaciones_elemento_r" @keyup.enter="agregarRecogido" class="form-control"/>
          </td>
          <td>
            <button class="btn btn-outline-danger" @click="agregarRecogido"><i class="fa-solid fa-plus"></i> Agregar</button>
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
            <tr v-for="data in form_data.data_elemento_r" :key="data.id">
              <td scope="col">{{data.ingreso_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.serial_elemento.toUpperCase()}}</td>
              <td scope="col">{{data.activo_elemento.toUpperCase()}}</td>
              <td scope="col">
                <button class="btn btn-outline-danger" @click="quitarRecogido(data)"><i class="fa-solid fa-trash"></i></button>
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
      <hr>
      <div class="container firmas">
        <Firma ref="signaturePad" firma_d="Firma de quien entrega" class="mb-3"></Firma>
        <Firma ref="signaturePad2" firma_d="Firma de quien recibe" class="mb-3"></Firma>
      </div>
      <table>
        <tr>
          <td>
            <p>
              Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_persona.toUpperCase()}}</b>
            </p>
          </td>
          <td>
            <p>Gestor de Soluciones Tecnológica</p>
            <p>
              Nombre:
              <b>{{form_data.nombre_gestor.toUpperCase()}}</b>
            </p>
          </td>
        </tr>
      </table>
    </div>
    <div class="container-fluid b-finales">
      <button class="btn btn-outline-danger mt-2 b-anchof" @click="generarPDFGestor"><span :class="[cargar]"></span>  Generar PDF</button>
      <button class="btn btn-outline-danger mt-2 b-anchof" @click="limpiarTodo"><span class="fa-solid fa-eraser"/>  Limpiar Formulario</button>
    </div>

    <a href="" download="" id="enlace"></a>
    <br>
    <div class="container-fluid" align="center">

      <p style="font-size:12px">Derechos reservados MaxJP 2024 1.0</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import Firma from './Firma.vue';
export default {

  name: "formulario-gestor",
  components:{
    Firma,
  },
  data(){
    return {
      form_data:{
        // Datos basicos
        nombre_persona:'',
        numero_caso:'',
        documento_persona:'',
        correo_persona:'',
        // Nombre gestor
        nombre_gestor:'',
        // Motivos
        motivo_solicitud:'',
        op_solicitante:'',
        observaciones:'',
        // Nombre de quien entrega e elemento
        nombre_deEntrega:'',
        // Datos de elemento
        data_elemento:[],
        data_elemento_r:[],
        // Firmas de quien entrega y de quien recibe
        firma1:null,
        firma2:null,
      },
      // Mostrar un spinner para señalar la carga de la respuesta.
      cargar:'fa-solid fa-file-pdf',
      lista_gestores:[],
      lista_camps:[],
      // Cargar las campañas
      cargar1:'',
      // Cargar gestores
      cargar2:'',
    }
  },
  methods: {
    generarPDFGestor: async function(){
      this.cargar = 'spinner-border spinner-border-sm';
      if(this.validarInformacion()){
        this.notificacion(4);
      }else{
        // Generar la alerta
        this.notificacion(1);
  
        // Asignar firmas a laravel
        this.form_data.firma1 = this.$refs.signaturePad.getSignatureDataUrl();
        this.form_data.firma2 = this.$refs.signaturePad2.getSignatureDataUrl();
  
        await axios.post('/PDF_G',this.form_data,{
          responseType:'blob'
        })
        .then((res)=>{
          if(res.status == 200){
            var enlace = document.getElementById('enlace');
            enlace.download = (new Date().getDate().toLocaleString() +'_'+ (new Date().getMonth()+1).toString() +'_'+ (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + '_GESTOR_' + this.form_data.nombre_gestor.toUpperCase() + '.pdf';
            enlace.href = URL.createObjectURL(res.data);
            enlace.click();
            URL.revokeObjectURL(enlace.href);
          }else{
            this.notificacion(2);
          }
        }).catch((err)=>{
          this.notificacion(2);
        })
      }
      this.cargar = 'fa-solid fa-file-pdf';
    },
    agregarElementos(){
      try{
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
          this.form_data.observaciones_elemento = 'N/A';
        }
      }catch(err){
        this.notificacion(3);
      }
    },
    agregarRecogido(){
      try{
        if(this.form_data.serial_elemento_r != '' && this.form_data.activo_elemento_r != ''){
          this.form_data.data_elemento_r.unshift(
            {
              // Datos de elementos y observaciones
              ingreso_elemento:this.form_data.ingreso_elemento_r.toUpperCase(),
              serial_elemento:this.form_data.serial_elemento_r.toUpperCase(),
              activo_elemento:this.form_data.activo_elemento_r.toUpperCase(),
              observaciones_elemento:this.form_data.observaciones_elemento,
            }  
          );
          this.form_data.ingreso_elemento_r = '';
          this.form_data.serial_elemento_r = '';
          this.form_data.activo_elemento_r = '';
          this.form_data.observaciones_elemento_r = 'N/A';
        }
      }catch(err){
        this.notificacion(3);
      }
    },
    quitarElementos(elemento){
      for(let elem in this.form_data.data_elemento){
        if(elemento.serial_elemento === this.form_data.data_elemento[elem].serial_elemento){
          this.form_data.data_elemento.splice(elem,1);
        }
      }
    },
    quitarRecogido(elemento){
      for(let elem in this.form_data.data_elemento_r){
        if(elemento.serial_elemento === this.form_data.data_elemento_r[elem].serial_elemento){
          this.form_data.data_elemento_r.splice(elem,1);
        }
      }
    },
    limpiarTodo(){
      this.form_data = {
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
        data_elemento_r:[],

        // Firmas de quien entrega y de quien recibe
        firma1:null,
        firma2:null,
        observaciones_elemento:'N/A',
        observaciones_elemento_r:'N/A'
      }
    },
    validarInformacion(){
      if(this.form_data.correo_persona == '' 
        || this.form_data.nombre_persona == '' || this.form_data.op_solicitante == '' || this.form_data.documento_persona == ''
        || this.form_data.nombre_gestor == ''
      ){
        return true
      }
      return false
    },
    // alertas de sweetalert2 
    notificacion(contexto){
          let datos = {};
          switch (contexto) {
            case 1: // Generar alerta del pdf
              datos = {
                title:'¡Generando PDF!',
                timer:2000,
                imageUrl: 'https://play-lh.googleusercontent.com/9XKD5S7rwQ6FiPXSyp9SzLXfIue88ntf9sJ9K250IuHTL7pmn2-ZB0sngAX4A2Bw4w',
                imageHeight: 180,
              };
              break;
            case 2: // Generar alerta de error
              datos = {
                title:'¡Oops!',
                text:'Ha ocurrido un error al generar el pdf',
                icon:'error',
              };
              break;
            case 3: // Generar alerta de error al no completar los seriales
              datos = {
                text:'Llene los campos de serial y activo',
                icon:'error',
                showConfirmButton: false,
                timer:1000,
              };
            break;
            case 4: // Generar alerta de error al no llenar los campos del formulario
              datos = {
                title:'¡Oops!',
                text:'¡Valide los campos del formulario!',
                icon:'warning',
              };
            break;
            
          }
          Swal.fire(datos);
    },
    // Mostrar a todos los gestores.
    mostrarGestores(){
      this.cargar1 = 'spinner-border spinner-border-sm';
      axios.get('/Actas_de_responsabilidad/Gestores')
      .then((gestores)=>{
        this.lista_gestores = gestores.data;
      })
      .catch((error)=>{
        console.log(error);
      })
      this.cargar1 = '';
    },
    // Mostrar campañas
    mostrarCamps(){
      this.cargar2 = 'spinner-border spinner-border-sm';
      axios.get('/Actas_de_responsabilidad/Campanas')
      .then((cam)=>{
        this.lista_camps = cam.data;
      })
      .catch((error)=>{
        console.log(error);
      })
      this.cargar2 = '';
    }

  },
  mounted(){
    this.form_data.observaciones_elemento = 'N/A';
    this.form_data.observaciones_elemento_r = 'N/A';
  },
};
</script>

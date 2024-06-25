<template>
    <div>
        <div id="operaciones">
      <p>Señor <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_encargado"></p>
      <p>CC. <input type="number" class="form-control" placeholder="Ingrese el número de CC" v-model.number="form_data.documento_encargado"></p>
      <p>Correo: <input type="email" placeholder="Ingrese el correo" v-model="form_data.correo_encargado"></p>
      <p>Respetada Señor/a <b>{{form_data.nombre_encargado.toUpperCase()}}</b></p>
      <p>El presente formato se tiene con fin de entregar la responsabilidad del activo solicitado a la operación retirando el activo anterior según el caso: <input type="text" placeholder="Ingrese el caso" v-model="form_data.n_caso"></p>
      <p>Definiciones:</p>
      <ul>
        <li>Motivo de Solicitud <input type="text" placeholder="Ingrese el motivo" v-model="form_data.motivo_solicitud"></li>
        <li>Operación Solicitante 
          <!-- Lista que permite escribir las opciones -->
          <input type="text" list="lista" class="form-control"  v-model="form_data.op_solicitante">
          
          <datalist id="lista">
            <option value="ANM AGENCIA NACIONAL DE MINERÍA">ANM AGENCIA NACIONAL DE MINERÍA</option>
            <option value="BANCAMIACOBRANZAS">BANCAMIACOBRANZAS</option>
            <option value="BANCAMIASAC">BANCAMIASAC</option>
            <option value="BIENESTAR IPS">BIENESTAR IPS</option>
            <option value="CAFAM">CAFAM</option>
            <option value="CARVAJAL EBUSINESS">CARVAJAL EBUSINESS</option>
            <option value="CARVAJAL IDC">CARVAJAL IDC</option>
            <option value="CARVAJAL S.A LINEA 25000">CARVAJAL S.A LINEA 25000</option>
            <option value="CARVAJAL TECNOLOGÍA Y SERVICIOS S.A.S">CARVAJAL TECNOLOGÍA Y SERVICIOS S.A.S</option>
            <option value="CHILCO">CHILCO</option>
            <option value="CODENSA">CODENSA</option>
            <option value="COMFAMA CARVAJAL">COMFAMA CARVAJAL</option>
            <option value="COMFANDI">COMFANDI</option>
            <option value="COMPENSAR">COMPENSAR</option>
            <option value="CREDIBANCO S.A">CREDIBANCO S.A</option>
            <option value="CREDIVALORES">CREDIVALORES</option>
            <option value="CRUZ ROJA">CRUZ ROJA</option>
            <option value="DERCO">DERCO</option>
            <option value="ECOPETROL S.A">ECOPETROL S.A</option>
            <option value="ENDESA">ENDESA</option>
            <option value="ETBCOBRANZAS">ETBCOBRANZAS</option>
            <option value="ETBRETENCIONES">ETBRETENCIONES</option>
            <option value="EXPERIAN">EXPERIAN</option>
            <option value="FACTURA ELECTRONICA">FACTURA ELECTRONICA</option>
            <option value="FAMISANAR">FAMISANAR</option>
            <option value="FISCALIA">FISCALIA</option>
            <option value="GERENCIA COMERCIAL">GERENCIA COMERCIAL</option>
            <option value="GERENCIA FINANCIERA Y ADMINISTRATIVA">GERENCIA FINANCIERA Y ADMINISTRATIVA</option>
            <option value="GERENCIA GENERAL">GERENCIA GENERAL</option>
            <option value="GERENCIA GESTIÓN HUMANA">GERENCIA GESTIÓN HUMANA</option>
            <option value="GERENCIA GESTIÓN HUMANA DESARROLLO Y CULTURA">GERENCIA GESTIÓN HUMANA DESARROLLO Y CULTURA</option>
            <option value="GERENCIA GESTIÓN HUMANA FORMACIÓN">GERENCIA GESTIÓN HUMANA FORMACIÓN</option>
            <option value="GERENCIA GESTIÓN HUMANA NOMINA">GERENCIA GESTIÓN HUMANA NOMINA</option>
            <option value="GERENCIA TECNOLOGÍA">GERENCIA TECNOLOGÍA</option>
            <option value="GERENCIA TECNOLOGÍASEGURIDAD DE LA INFORMACIÓN">GERENCIA TECNOLOGÍASEGURIDAD DE LA INFORMACIÓN</option>
            <option value="GERENCIA TRANSFORMACIÓN DIGITAL Y DISEÑO DEL SERVICIO">GERENCIA TRANSFORMACIÓN DIGITAL Y DISEÑO DEL SERVICIO</option>
            <option value="GERENCIA UNIDAD DE DESARROLLO DE NUEVOS NEGOCIOS">GERENCIA UNIDAD DE DESARROLLO DE NUEVOS NEGOCIOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT">GERENCIA WORKFORCE MANAGEMENT</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT CIENCIA DE DATOS">GERENCIA WORKFORCE MANAGEMENT CIENCIA DE DATOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT EXPERIENCIA AL CLIENTE">GERENCIA WORKFORCE MANAGEMENT EXPERIENCIA AL CLIENTE</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT INTELIGENCIA DE NEGOCIOS">GERENCIA WORKFORCE MANAGEMENT INTELIGENCIA DE NEGOCIOS</option>
            <option value="GERENCIA WORKFORCE MANAGEMENT WFM">GERENCIA WORKFORCE MANAGEMENTWFM</option>
            <option value="GRUPO AVAL">GRUPO AVAL</option>
            <option value="GRUPO AVALBANCO DE BOGOTÁCOBRANZAS">GRUPO AVALBANCO DE BOGOTÁ COBRANZAS</option>
            <option value="GRUPO AVALBANCO DE BOGOTÁSAC">GRUPO AVALBANCO DE BOGOTÁ SAC</option>
            <option value="GRUPO AVALBANCO DE OCCIDENTE">GRUPO AVALBANCO DE OCCIDENTE</option>
            <option value="GRUPO AVALBANCO POPULAR">GRUPO AVALBANCO POPULAR</option>
            <option value="HERO MOTOCORP">HERO MOTOCORP</option>
            <option value="HP HEWLETT PACKARD">HP HEWLETT PACKARD</option>
            <option value="ICETEX">ICETEX</option>
            <option value="ILANS">ILANS</option>
            <option value="ITAU">ITAU</option>
            <option value="ITAU COBRANZAS">ITAUCOBRANZAS</option>
            <option value="JAVESALUD">JAVESALUD</option>
            <option value="MEDERI">MEDERI</option>
            <option value="MINISTERIO DE CULTURA">MINISTERIO DE CULTURA</option>
            <option value="MINISTERIO DE SALUD Y PROTECCIÓN SOCIAL">MINISTERIO DE SALUD Y PROTECCIÓN SOCIAL</option>
            <option value="MINISTERIO DEL TRABAJO">MINISTERIO DEL TRABAJO</option>
            <option value="MULTICAMPAÑAS">MULTICAMPAÑAS</option>
            <option value="NUEVA EPS">NUEVA EPS</option>
            <option value="NUEVA EPSCLIENTE NUEVA EPS">NUEVA EPSCLIENTE NUEVA EPS</option>
            <option value="POSITIVA">POSITIVA</option>
            <option value="PROCERASEO SAS">PROCERASEO SAS</option>
            <option value="QCL AUDITORES SERVISALUD">QCL AUDITORES SERVISALUD</option>
            <option value="QNT">QNT</option>
            <option value="RED DE PAGOS">RED DE PAGOS</option>
            <option value="SECRETARIA DE HACIENDA">SECRETARIA DE HACIENDA</option>
            <option value="SEGUROS EQUIDAD">SEGUROS EQUIDAD</option>
            <option value="SERVINFORMBACKOFFICE">SERVINFORM BACKOFFICE</option>
            <option value="SERVINFORMPOWEN">SERVINFORM POWEN</option>
            <option value="SODEXO">SODEXO</option>
            <option value="SOS EPS">SOS EPS</option>
            <option value="SUPERINTENDENCIA DE TRANSPORTE">SUPERINTENDENCIA DE TRANSPORTE</option>
            <option value="SUPERSALUD SUPERINTENDENCIA NACIONAL DE SALUD">SUPERSALUD SUPERINTENDENCIA NACIONAL DE SALUD</option>
            <option value="UGPP NORMALIZACIÓN">UGPP NORMALIZACIÓN</option>
            <option value="UGPP UT">UGPP UT</option>
            <option value="UPRESS">UPRESS</option>
            <option value="VERTIV">VERTIV</option>
            <option value="WOM">WOM</option>

          </datalist>
        </li>
        <li>Estado de Entrega del Nuevo Activo
           <select class="form-select mt-2 mb-2" v-model="form_data.est_entrega_nuevoActivo">
             <option value="EN REPARACION">EN REPARACION</option>
             <option value="DAÑADO">DAÑADO</option>
             <option value="OPERATIVO">OPERATIVO</option>
            </select>
          </li>
          <li>Estado de Recibido del Activo Recogido 
            <select class="form-select mt-2 mb-2" v-model="form_data.est_recibido_activo">
              <option value="EN REPARACION">EN REPARACION</option>
              <option value="DAÑADO">DAÑADO</option>
              <option value="OPERATIVO">OPERATIVO</option>
           </select>
        </li>
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
          <td>
            <select name="" id="" class="form-select" v-model="form_data.elemento_recogido">
              <option value="Torre">Torre</option>
              <option value="Diadema">Diadema</option>
              <option value="Monitor">Monitor</option>
              <option value="Minitorre">Minitorre</option>
            </select>
          </td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_recogido"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_recogido" :disabled="form_data.elemento_recogido === 'Diadema'" :enabled="form_data.elemento_recogido !== 'Diadema' ? form_data.activo_recogido : form_data.activo_recogido = 'No tiene'"></td>
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
          <td>
            <select name="" id="" class="form-select" v-model="form_data.elemento_entregado">
              <option value="Torre">Torre</option>
              <option value="Diadema">Diadema</option>
              <option value="Monitor">Monitor</option>
              <option value="Minitorre">Minitorre</option>
            </select>
          </td>
          <td><input type="text" placeholder="Ingrese el serial" v-model="form_data.serial_entregado"></td>
          <td><input type="text" placeholder="Ingrese el activo" v-model="form_data.activo_entregado" :disabled="form_data.elemento_entregado === 'Diadema'" :enabled="form_data.elemento_entregado !== 'Diadema' ? form_data.activo_entregado : form_data.activo_entregado = 'No tiene'"></td>
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
      <!-- Componente firmas -->
      <div class="container firmas">
        <Firma ref="signaturePad" firma_d="Firma de quien entrega" class="mb-3"></Firma>
        <Firma ref="signaturePad2" firma_d="Firma Operacion" class="mb-3"></Firma>
      </div>
      <table>
        <tr>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <td>
              <p>Gestor de Soluciones Tecnológica</p>
              <p>Nombre Gestor: <input type="text" placeholder="Ingrese el nombre" v-model="form_data.nombre_gestor"></p>
            </td>
          <td>
            <p>Cargo: 
              <select class="form-select" v-model="form_data.cargo_operacion" required>
                <option value="Administrador">Administrador</option>
              </select>
            </p>
            <p>Nombre: <b>{{form_data.nombre_encargado.toUpperCase()}}</b></p>
          </td>
        </tr>
      </table>
      <div class="container-fluid b-finales">
        <!-- Llamar a la funcion para generar el pdf -->
        <button class="btn btn-danger b-anchof" @click="generarPDF">Generar PDF</button>
        <button class="btn btn-danger b-anchof" @click="limpiarTodo">Limpiar formulario</button>
      </div>
    </div>
  <a href="#" download="" id="link"></a>
  <br>
  <div class="container-fluid" align="center">

    <p style="font-size:12px">Derechos reservados MaxJP 2024</p>
  </div>
  </div>
</template>


<script>
import axios from 'axios'

import Swal from 'sweetalert2'
import Firma from './Firma.vue'


export default{
    components:{
      Firma
    },
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
                // Firmas
                firma1:null,
                firma2:null,
            },
            // Si escogen diadema cambia el estado de la entrada del activo
            opcion_diadema:""
        }
    },
    mounted() {
      this.form_data.observaciones_recogido = 'N/A'
      this.form_data.observaciones_entregado = 'N/A'
    },
    methods: {
        generarPDF: async function(){
          if(this.validarInformacion()){
            this.notificacion(4);
          }else{
            // Generar la alerta
            this.notificacion(1);
            const firma1 = this.$refs.signaturePad.getSignatureDataUrl();
            const firma2 = this.$refs.signaturePad2.getSignatureDataUrl();
            // Recoger las firmas para laravel
            this.form_data.firma1 = firma1;
            this.form_data.firma2 = firma2;

            await axios.post('/PDF_OP',this.form_data,{
                responseType:'blob'
            })
            .then((res)=>{
                if(res.status == 200){
                  // Descargar el pdf desde laravel
                  var link = document.getElementById('link');
                  link.download = (new Date().getDate().toLocaleString() +'_'+ (new Date().getMonth()+1).toString() +'_'+ (new Date().getFullYear()).toString() + '_' + new Date().getTime().toString()) + 'OPERACION_'+ this.form_data.op_solicitante.toUpperCase() +'.pdf';
                  link.href = URL.createObjectURL(res.data);
                  link.click();

                  URL.revokeObjectURL(link.href);

                }else{
                  this.notificacion(2);
                }
            })
            .catch((err)=>{
              this.notificacion(2);
            });
          }
            
        },
        // Agregar los elementos recogidos de la operacion
        agregarRecogidos(){
          try{
            // Validar que los cmapos no esten vacios
            if(this.form_data.serial_recogido != '' && this.form_data.activo_recogido != ''){
              this.form_data.data_recogido.unshift({
                  elemento_recogido:this.form_data.elemento_recogido.toUpperCase(),
                  serial_recogido:this.form_data.serial_recogido.toUpperCase(),
                  activo_recogido:this.form_data.activo_recogido.toUpperCase(),
                  observaciones_recogido:this.form_data.observaciones_recogido
              });
              this.form_data.elemento_recogido = '';
              this.form_data.serial_recogido = '';
              this.form_data.activo_recogido = '';
              this.form_data.observaciones_recogido = 'N/A';
            }else{
              this.notificacion(3);
            }
          }catch(err){
            this.notificacion(3);
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
        try{
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
            this.form_data.observaciones_entregado = 'N/A';
          }else{
            this.notificacion(3);
          }

        }catch(err){
          this.notificacion(3);
        }
        },
        // Quitar elementos entregados
        quitarEntregados(elemento){
          for(let ind in this.form_data.data_entregado){
            if(elemento.serial_entregado === this.form_data.data_entregado[ind].serial_entregado){
              this.form_data.data_entregado.splice(ind,1);
            }
          }
        },
        // Limpiar todos los campos
        limpiarTodo(){
          this.form_data = {
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
                // Firmas
                firma1:null,
                firma2:null,
            }
            this.form_data.observaciones_recogido = 'N/A'
            this.form_data.observaciones_entregado = 'N/A'
          },
        // Retornar un valor booleano para indicar que se puede generar el PDF.
        validarInformacion(){
          if(this.form_data.correo_encargado=='' || this.form_data.documento_encargado == '' || this.form_data.n_caso == '' || 
            this.form_data.est_entrega_nuevoActivo == '' || this.form_data.est_recibido_activo == '' || this.form_data.fecha_entrega == ''
            || this.form_data.op_solicitante == '' || this.form_data.data_entregado == [] || this.form_data.data_recogido == []
          ){
            return true;
          }
          return false;
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
                position:"top-end",
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

        }
    },
}
</script>